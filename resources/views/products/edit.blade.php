@extends('layouts.master')

@section('title', 'Update Product: ' . $product->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.show', ['product' => $product]) }}">Show Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Product</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Update Product <small>{{ $product->name }}</small></h1>
            </div>
            @include('products.shared.productForm', ['type' => 'update'])
        </div>
    </div>
@endsection