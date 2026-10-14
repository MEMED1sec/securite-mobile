<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Page d'accueil
Route::get('/', function () {
    return view('home');
});

// Liste des produits (Blade)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Détail produit (Blade)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
