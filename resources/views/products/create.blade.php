@extends('layouts.master')

@section('title', 'Create Product')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Product</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Create Product</h1>
            </div>
            @include('products.shared.productForm', ['type' => 'create'])
        </div>
    </div>
@endsection