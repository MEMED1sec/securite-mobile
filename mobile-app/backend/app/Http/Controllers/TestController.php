<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Méthode de test pour vérifier la connexion API
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function test()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Connexion à l\'API réussie !',
            'timestamp' => now()->toDateTimeString()
        ]);
    }
}