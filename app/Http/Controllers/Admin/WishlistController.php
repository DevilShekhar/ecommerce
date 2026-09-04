<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WishlistController extends Controller
{
    /**
     * Customer Wishlist
     */
    public function index()
    {
        $user = Auth::user();

        $wishlistItems = Wishlist::with('product')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(12);

        $wishlistCount = Wishlist::query()->where('user_id', $user->id)->count();

        $categories = ProductCategory::query()->where('status', 1)
            ->latest()
            ->get();

        return view('customer.wishlist', compact(
            'user',
            'wishlistItems',
            'wishlistCount',
            'categories'
        ));
    }

    public function filter(Request $request)
    {
        $query = Product::query()->where('status', 1);

        // Category filter
        if ($request->has('rec_category') && ! empty($request->rec_category)) {
            $category = ProductCategory::query()->where('slug', $request->rec_category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Price filter (using selling_price for filtering)
        if ($request->has('rec_min_price') && ! empty($request->rec_min_price)) {
            $query->where('selling_price', '>=', (float) $request->rec_min_price);
        }
        if ($request->has('rec_max_price') && ! empty($request->rec_max_price)) {
            $query->where('selling_price', '<=', (float) $request->rec_max_price);
        }

        // Sort
        if ($request->has('rec_sort')) {
            switch ($request->rec_sort) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('selling_price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('selling_price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        $products = $query->take(8)->get();

        // Generate HTML for each product
        $html = '';

        if ($products->count() > 0) {
            foreach ($products as $product) {
                // Get images
                $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                $firstImage = $images[0] ?? null;

                if ($firstImage) {
                    $firstImage = preg_replace('#^storage/#', '', $firstImage);
                    $imgUrl = asset($firstImage);
                } else {
                    $imgUrl = null;
                }

                // =============================================
                // GET SELLING PRICE AND ORIGINAL PRICE
                // =============================================

                // Selling price (from product's selling_price field)
                $sellingPrice = (float) ($product->selling_price ?? $product->price ?? 0);

                // Original price (from product's price field)
                $originalPrice = (float) ($product->price ?? 0);

                // Check if there's a discount
                $hasDiscount = $originalPrice > $sellingPrice && $sellingPrice > 0;

                // Calculate discount percentage
                $discountPercent = $hasDiscount ? round((($originalPrice - $sellingPrice) / $originalPrice) * 100) : 0;

                // =============================================
                // ACTIVE OFFER (from offers table)
                // =============================================

                $activeOffer = $product->active_offer ?? null;

                // If active offer exists, it overrides the selling price
                if ($activeOffer) {
                    if ($activeOffer->discount_type === 'percentage') {
                        $sellingPrice = $originalPrice - ($originalPrice * $activeOffer->discount_value / 100);
                    } else {
                        $sellingPrice = max(0, $originalPrice - $activeOffer->discount_value);
                    }
                    // Recalculate discount
                    $hasDiscount = $originalPrice > $sellingPrice && $sellingPrice > 0;
                    $discountPercent = $hasDiscount ? round((($originalPrice - $sellingPrice) / $originalPrice) * 100) : 0;
                }

                $isFutured = isset($product->is_futured) && $product->is_futured == 1;
                $isNew = isset($product->is_futured) && $product->is_futured == 2;
                $isOutOfStock = $product->stock !== null && $product->stock <= 0;

                // Build product card HTML with both prices
                $html .= '
            <div>
                <div class="jewel-product-card product-details-trigger" data-product-id="'.$product->id.'">
                    <div class="jewel-product-image">
                        '.($imgUrl ? '<img src="'.$imgUrl.'" alt="'.$product->name.'" loading="lazy" onerror="this.src=\''.asset('images/placeholder.png').'\'">' : '<div class="jewel-no-image"><i class="bi bi-image"></i></div>').'

                        '.($activeOffer || $hasDiscount ? '<span class="jewel-badge offer">'.($activeOffer ? ($activeOffer->discount_type === 'percentage' ? rtrim(rtrim(number_format($activeOffer->discount_value, 2), '0'), '.').'% OFF' : '₹'.number_format($activeOffer->discount_value, 0).' OFF') : $discountPercent.'% OFF').'</span>' : '').'
                        '.($isFutured ? '<span class="jewel-badge featured"><i class="bi bi-stars"></i> Featured</span>' : '').'
                        '.($isNew ? '<span class="jewel-badge new">New</span>' : '').'

                        <button type="button" class="jewel-heart wishlist-btn" data-product-id="'.$product->id.'" onclick="event.preventDefault(); event.stopPropagation(); toggleWishlist(this)">
                            <i class="bi bi-heart"></i>
                        </button>

                        '.($product->stock !== null ? '<span class="jewel-stock '.($isOutOfStock ? 'out-stock' : 'in-stock').'">'.($isOutOfStock ? 'Out of Stock' : 'In Stock').'</span>' : '').'
                    </div>

                    <div class="jewel-product-info">
                        <div class="jewel-category">'.($product->category->name ?? 'Product').'</div>
                        <div class="jewel-product-name" title="'.$product->name.'">'.Str::limit($product->name, 25).'</div>

                        <div class="jewel-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <span>4.8</span>
                        </div>

                        <!-- ============================================= -->
                        <!-- PRICE ROW WITH BOTH PRICES                    -->
                        <!-- ============================================= -->
                        <div class="jewel-price-row">
                            <span class="jewel-price" style="color:#198754;font-weight:700;font-size:15px;">
                                ₹'.number_format($sellingPrice, 0).'
                            </span>
                            '.($hasDiscount ? '
                                <span class="jewel-old-price" style="color:#94a3b8;text-decoration:line-through;text-decoration-thickness:1px;font-size:12px;">
                                    ₹'.number_format($originalPrice, 0).'
                                </span>
                                <span style="background:#fef2f2;color:#ef4444;font-size:9px;font-weight:700;padding:2px 8px;border-radius:3px;margin-left:4px;">
                                    '.$discountPercent.'% OFF
                                </span>
                            ' : '').'
                            '.($activeOffer && $hasDiscount ? '
                                <span style="background:#f0fdf4;color:#16a34a;font-size:8px;font-weight:600;padding:2px 8px;border-radius:3px;margin-left:4px;border:1px solid #bbf7d0;">
                                    <i class="bi bi-tag-fill"></i>
                                    '.($activeOffer->discount_type === 'percentage' ? rtrim(rtrim(number_format($activeOffer->discount_value, 2), '0'), '.').'% OFF' : '₹'.number_format($activeOffer->discount_value, 0).' OFF').'
                                </span>
                            ' : '').'
                        </div>

                        '.($isFutured ? '
                            <button type="button" class="jewel-cart-btn notify notify-me-btn" data-product-id="'.$product->id.'" onclick="event.preventDefault(); event.stopPropagation();">
                                <i class="bi bi-bell"></i> Notify Me
                            </button>
                        ' : ($isOutOfStock ? '
                            <button type="button" class="jewel-cart-btn" disabled>
                                <i class="bi bi-x-circle"></i> Out of Stock
                            </button>
                        ' : '
                            <form action="'.route('cart.add', $product->id).'" method="POST" onclick="event.stopPropagation();">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <button type="submit" class="jewel-cart-btn">
                                    <i class="bi bi-bag-plus"></i> Add to Cart
                                </button>
                            </form>
                        ')).'
                    </div>
                </div>
            </div>';
            }
        } else {
            // No products found
            $html = '
        <div class="no-products-found" style="grid-column:1/-1;text-align:center;padding:40px 20px;background:#fff;border:1px solid var(--s-border);border-radius:8px;">
            <i class="bi bi-box" style="font-size:38px;color:#d5cfc5;display:block;margin-bottom:10px;"></i>
            <p style="color:#77736d;font-size:11px;margin:0;">No products found matching your filters.</p>
            <a href="#" onclick="resetRecommendedFilters(); return false;" class="shop-now-btn" style="display:inline-flex;align-items:center;gap:7px;background:#3b82f6;color:#fff;text-decoration:none;border-radius:5px;padding:9px 17px;font-size:10px;font-weight:700;margin-top:12px;">
                <i class="bi bi-arrow-counterclockwise"></i> Reset Filters
            </a>
        </div>';
        }

        return response()->json([
            'success' => true,
            'html' => $html,
            'count' => $products->count(),
        ]);
    }

    /**
     * Add / Remove product from wishlist
     */
    public function toggle(Request $request, $productId)
    {
        // Check product
        $product = Product::query()->where('id', $productId)
            ->where('status', 1)
            ->first();

        if (! $product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        $userId = Auth::id();

        // Check existing wishlist
        $existing = Wishlist::query()->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existing) {

            // Remove
            $existing->delete();

            $isInWishlist = false;
            $message = 'Removed from wishlist';

        } else {

            // Add
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);

            $isInWishlist = true;
            $message = 'Added to wishlist';
        }

        // Updated count
        $wishlistCount = Wishlist::query()->where('user_id', $userId)->count();

        return response()->json([
            'success' => true,
            'is_in_wishlist' => $isInWishlist,
            'message' => $message,
            'wishlist_count' => $wishlistCount,
            'product_id' => $productId,
        ]);
    }

    /**
     * Remove wishlist item
     */
    public function destroy($id)
    {
        $wishlist = Wishlist::query()->where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if (! $wishlist) {
            return response()->json([
                'success' => false,
                'message' => 'Wishlist item not found',
            ], 404);
        }

        $wishlist->delete();

        return redirect()
            ->route('customer.wishlist')
            ->with('success', 'Product removed from wishlist.');
    }

    public function remove($id)
    {
        $wishlist = Wishlist::query()->where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if (! $wishlist) {
            return response()->json([
                'success' => false,
                'message' => 'Wishlist item not found',
            ], 404);
        }

        $wishlist->delete();

        return redirect()
            ->route('customer.wishlist')
            ->with('success', 'Product removed from wishlist.');
    }
}
