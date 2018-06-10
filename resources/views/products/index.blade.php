@extends('layouts.master')

@section('title', 'Products Index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Products</h1>
            </div>
            <a class="btn btn-primary" href="{{ route('products.create') }}">Create a new product</a><br><br>
            @if ($products)
                <div class="list-group">
                    @foreach ($products as $product)
                        <a class="list-group-item" href="{{ route('products.show', ['product' => $product]) }}">
                            <h4 class="list-group-item-heading no-desc' }}">{{ $product->name }}</h4>
                        </a>
                    @endforeach
                </div>
                {{ $products->links() }}
            @else
                No Products Found
            @endif
        </div>
    </div>
@endsection