<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Apply category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Apply brand filter
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        $products = $query->with(['category', 'brand'])->paginate(12);
        $categories = Category::all();
        $brands = Brand::all();

        return view('products.index', compact('products', 'categories', 'brands'));
    }

    public function detail($id)
    {
        $product = Product::with(['category', 'brand'])->findOrFail($id);
        return view('products.detail', compact('product'));
    }
}
