<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /*************
     * WEB METHODS
     *************/
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('reviews.user');
        return view('products.show', compact('product'));
    }

    /*************
     * API METHODS
     *************/
    public function apiIndex(Request $request)
    {
        $query = Product::with(['reviews.user', 'additives']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }
        if ($request->has('nutriscore')) {
            $query->whereIn('nutriscore_grade', explode(',', $request->nutriscore));
        }
        $perPage = $request->per_page ?? 20;
        $products = $query->paginate($perPage);
        return response()->json([
            'success' => true,
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'last_page' => $products->lastPage(),
            ]
        ]);
    }

    public function apiShow($barcode)
    {
        $product = Product::with(['reviews.user', 'additives'])
            ->where('barcode', $barcode)
            ->first();
        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }
        return response()->json([
            'product' => $product
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'brand' => 'nullable|string',
            'barcode' => 'required|string|unique:products',
            'nutriscore_grade' => 'nullable|in:A,B,C,D,E',
            'image_url' => 'nullable|url',
            'serving_size' => 'nullable|string',
            'ingredients' => 'required|array',
            'ingredients.*' => 'string',
            'allergens' => 'nullable|array',
            'allergens.*' => 'string',
            'additives' => 'nullable|array',
            'additives.*' => 'string|exists:additives,e_number'
        ]);
        $product = Product::create([
            'name' => $data['name'],
            'brand' => $data['brand'] ?? null,
            'barcode' => $data['barcode'],
            'nutriscore_grade' => $data['nutriscore_grade'] ?? null,
            'image_url' => $data['image_url'] ?? null,
            'serving_size' => $data['serving_size'] ?? null,
            'ingredients' => json_encode($data['ingredients']),
            'allergens' => isset($data['allergens']) ? json_encode($data['allergens']) : null,
        ]);
        if (isset($data['additives'])) {
            $additiveIds = \App\Models\Additive::whereIn('e_number', $data['additives'])->pluck('id')->toArray();
            $product->additives()->sync($additiveIds);
        }
        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté avec succès',
            'data' => $product->load('additives')
        ]);
    }
}
