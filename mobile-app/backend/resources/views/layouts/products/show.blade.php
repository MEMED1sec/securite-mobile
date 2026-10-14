@extends('layouts.app')

@section('content')
<h1>{{ $product->name }}</h1>
<p><strong>Marque:</strong> {{ $product->brand }}</p>
<p><strong>Barcode:</strong> {{ $product->barcode }}</p>
<p><strong>Nutriscore:</strong> {{ $product->nutriscore }}</p>
<p><strong>Ingrédients:</strong> {{ $product->ingredients }}</p>
<p><strong>Allergènes:</strong> {{ $product->allergens }}</p>

<h2>Avis des utilisateurs</h2>
@if($product->reviews->count())
    @foreach($product->reviews as $review)
        <p>{{ $review->user->name ?? 'Utilisateur' }} : {{ $review->comment }}</p>
    @endforeach
@else
    <p>Aucun avis pour le moment.</p>
@endif
@endsection
