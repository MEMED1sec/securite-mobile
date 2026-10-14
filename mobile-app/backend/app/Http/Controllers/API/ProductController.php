<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /*************
     * WEB METHODS
     *************/

    // Liste des produits pour la page web
    public function index()
    {
        // On récupère les produits avec pagination
        $products = Product::paginate(10);

        return view('products.index', compact('products'));
    }

    // Détail d’un produit pour la page web
    public function show(Product $product)
    {
        // On charge les reviews associées
        $product->load('reviews.user');

        return view('products.show', compact('product'));
    }

    /*************
     * API METHODS
     *************/

    // Liste des produits pour Android (JSON)
    public function apiIndex()
    {
        return Product::with('reviews')->get();
    }

    // Détail d’un produit pour Android (JSON)
    public function apiShow(Product $product)
    {
        return $product->load('reviews.user');
    }

    // Ajouter un produit (API)
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'brand' => 'nullable|string',
            'barcode' => 'required|unique:products',
            'nutriscore' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'allergens' => 'nullable|string',
        ]);

        $product = Product::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté avec succès',
            'data' => $product
        ]);
    }
}
