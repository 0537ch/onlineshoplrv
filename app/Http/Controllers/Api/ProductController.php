<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->when($request->category_id, function ($query, $category_id) {
                return $query->where('category_id', $category_id);
            })
            ->when($request->brand_id, function ($query, $brand_id) {
                return $query->where('brand_id', $brand_id);
            })
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->with(['category', 'brand'])
            ->paginate($request->per_page ?? 12);

        return response()->json($products);
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand']);
        return response()->json($product);
    }
}
