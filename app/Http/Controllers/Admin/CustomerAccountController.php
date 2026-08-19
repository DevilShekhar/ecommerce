<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;

class CustomerAccountController extends Controller
{
    /**
     * Show Account Settings Page
     */
    public function index()
    {
        return $this->accountSettings();
    }

    /**
     * Account Settings
     */
    public function accountSettings()
    {
        $user = Auth::user();

        $categories = ProductCategory::query()
            ->where('status', 1)
            ->get();

        $addresses = $this->getAddresses($user);

        return view(
            'customer.account-settings',
            compact('user', 'categories', 'addresses')
        );
    }

    /**
     * Get user addresses safely.
     *
     * User model has address => array cast.
     * This method also handles old JSON-string data.
     */
    private function getAddresses($user): array
    {
        $addresses = $user->address;

        // Normally Laravel cast gives us an array.
        if (is_array($addresses)) {
            return $addresses;
        }

        // Backward compatibility if old data is still JSON string.
        if (is_string($addresses) && !empty($addresses)) {
            $decoded = json_decode($addresses, true);

            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    /**
     * Update Account Settings
     */
    public function updateAccountSettings(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        /*
        |--------------------------------------------------------------------------
        | Avatar Upload
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('avatar')) {

            // Delete old avatar
            if (!empty($user->avatar)) {
                $oldAvatar = $user->avatar;

                if (Storage::disk('public')->exists($oldAvatar)) {
                    Storage::disk('public')->delete($oldAvatar);
                }
            }

            $data['avatar'] = $request->file('avatar')->store(
                'avatars',
                'public'
            );
        }

        $user->update($data);

        return redirect()
            ->route('account.settings')
            ->with('success', 'Account settings updated successfully.');
    }

    /**
     * Store New Address
     */
    public function storeAddress(Request $request)
    {
        $request->validate([
            'address_type' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'pincode' => 'required|string|max:20',
        ]);

        $user = Auth::user();

        $addresses = $this->getAddresses($user);
        $existingIds = [];

        foreach ($addresses as $address) {
            if (isset($address['id'])) {
                $existingIds[] = (int) $address['id'];
            }
        }

        $nextId = !empty($existingIds)
            ? max($existingIds) + 1
            : 1;

        $isFirstAddress = empty($addresses);

        if ($request->boolean('is_default') || $isFirstAddress) {

            foreach ($addresses as &$address) {
                $address['is_default'] = false;
            }

            unset($address);
        }

        $addresses[] = [
            'id' => $nextId,
            'type' => $request->address_type,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'pincode' => $request->pincode,
            'is_default' => $isFirstAddress
                ? true
                : $request->boolean('is_default'),
        ];

        $user->address = $addresses;
        $user->save();

        return back()->with(
            'success',
            'Address added successfully.'
        );
    }

    /**
     * Delete Address
     */
    public function deleteAddress($addressId)
    {
        $user = Auth::user();

        $addresses = $this->getAddresses($user);

        $deletedWasDefault = false;
        $addressFound = false;

        foreach ($addresses as $address) {

            if (
                isset($address['id']) &&
                (int) $address['id'] === (int) $addressId
            ) {
                $addressFound = true;
                $deletedWasDefault = !empty($address['is_default']);

                break;
            }
        }

        if (!$addressFound) {
            return back()->withErrors([
                'address' => 'Address not found.',
            ]);
        }
        $addresses = array_values(
            array_filter(
                $addresses,
                function ($address) use ($addressId) {

                    return !isset($address['id']) ||
                        (int) $address['id'] !== (int) $addressId;
                }
            )
        );

        if ($deletedWasDefault && !empty($addresses)) {

            foreach ($addresses as &$address) {
                $address['is_default'] = false;
            }

            $addresses[0]['is_default'] = true;

            unset($address);
        }

        $user->address = $addresses;
        $user->save();

        return back()->with(
            'success',
            'Address deleted successfully.'
        );
    }

    /**
     * Set Address As Default
     */
    public function setDefaultAddress($addressId)
    {
        $user = Auth::user();

        $addresses = $this->getAddresses($user);

        $addressFound = false;
        foreach ($addresses as &$address) {

            if (
                isset($address['id']) &&
                (int) $address['id'] === (int) $addressId
            ) {
                $address['is_default'] = true;
                $addressFound = true;
            } else {
                $address['is_default'] = false;
            }
        }

        unset($address);
        if (!$addressFound) {
            return back()->withErrors([
                'address' => 'Address not found.',
            ]);
        }

        $user->address = $addresses;
        $user->save();

        return back()->with(
            'success',
            'Default address updated successfully.'
        );
    }

    /**
     * Update Address
     */
    public function updateAddress(Request $request, $addressId)
    {
        $request->validate([
            'address_type' => 'nullable|string|max:50',
            'name' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();

        $addresses = $this->getAddresses($user);

        $addressFound = false;

        foreach ($addresses as &$address) {

            if (
                isset($address['id']) &&
                (int) $address['id'] === (int) $addressId
            ) {

                $addressFound = true;

                if ($request->filled('address_type')) {
                    $address['type'] = $request->address_type;
                }

                if ($request->filled('name')) {
                    $address['name'] = $request->name;
                }

                if ($request->filled('mobile')) {
                    $address['mobile'] = $request->mobile;
                }

                if ($request->filled('address')) {
                    $address['address'] = $request->address;
                }

                if ($request->filled('city')) {
                    $address['city'] = $request->city;
                }

                if ($request->filled('state')) {
                    $address['state'] = $request->state;
                }

                if ($request->filled('country')) {
                    $address['country'] = $request->country;
                }

                if ($request->filled('pincode')) {
                    $address['pincode'] = $request->pincode;
                }

                break;
            }
        }

        unset($address);

        if (!$addressFound) {
            return back()->withErrors([
                'address' => 'Address not found.',
            ]);
        }

        $user->address = $addresses;
        $user->save();

        return back()->with(
            'success',
            'Address updated successfully.'
        );
    }

    /**
     * Update Profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'mobile' => 'nullable|string|max:20',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);

        return back()->with(
            'success',
            'Profile updated successfully.'
        );
    }

    /**
     * Update Password
     */
   /**
 * Update Password
 */
public function updatePassword(Request $request)
{
    $request->validate([
        'password' => [
            'required',
            'string',
            'confirmed',
            'min:8',
        ],
    ]);

    $user = Auth::user();

    $user->password = Hash::make($request->password);
    $user->save();

    return back()->with(
        'success',
        'Password created successfully. You can now log in using your email and this password.'
    );
}
}
