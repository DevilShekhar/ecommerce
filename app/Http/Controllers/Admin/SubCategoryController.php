<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Show the form for creating a new sub category.
     */
    public function create()
    {
        $categories = Category::all();

        return view('sub_categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $subcategory = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
        ]);

        SubCategory::create($subcategory);

        return redirect()->route('sub_categories.index')
            ->with('success', 'Sub Category created successfully.');
    }
}