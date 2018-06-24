@extends('layouts.master')

@section('title', 'Product Locations: ' . $product->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.show', ['product' => $product]) }}">Show Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Locations</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Locations for product: <small>{{ $product->name }}</small></h1>
            </div>
            <br>
            @if ($productLocations)
                @foreach ($productLocations as $productLocation)
                @endforeach
            @else
                No Location Found
            @endif
        </div>
    </div>
@endsection