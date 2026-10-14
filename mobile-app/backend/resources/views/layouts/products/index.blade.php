@extends('layouts.app') <!-- si tu as un layout -->

@section('content')
<h1>Liste des produits</h1>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Marque</th>
            <th>Détails</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->brand }}</td>
            <td><a href="{{ route('products.show', $product->id) }}">Voir</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $products->links() }}
@endsection
