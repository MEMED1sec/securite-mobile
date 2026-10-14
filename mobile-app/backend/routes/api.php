<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Route de test de connexion
Route::get('/test', function () {
    return 'API Yuka connectée avec succès !';
});

// Routes pour les produits
Route::get('/products', [ProductController::class, 'apiIndex']);
Route::get('/products/{product}', [ProductController::class, 'apiShow']);
Route::post('/products', [ProductController::class, 'store']);