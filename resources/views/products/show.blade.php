@extends('layouts.master')

@section('title', 'Show Product: ' . $product->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Product</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Show Product <small>{{ $product->name }}</small></h1>
            </div>
            <dl class="dl-horizontal">
                <dt>Name:</dt>
                <dd>{{ $product->name }}</dd>
            </dl>
            <br><br>
            <a class="btn btn-primary" href="{{ route('products.edit', ['product' => $product]) }}">Edit</a>
            @include('shared.deleteButton', ['name' => 'product', 'route' => route('products.destroy', ['product' => $product])])
        </div>
    </div>
@endsection