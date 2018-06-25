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
            @if ($productLocations->isNotEmpty())
                @foreach ($productLocations as $productLocation)
                    <div class="card">
                        <a href="#" data-ajax-url="{{ route('labels.productLocation.ajax', ['product' => $productLocation->product, 'location' => $productLocation->location]) }}" data-product-id="{{ $productLocation->product_id }}" data-location-id="{{ $productLocation->location_id }}" class="productLocation list-group-item-action" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
                            <div class="card-header d-flex justify-content-between align-items-center" id="heading{{ $loop->index }}">
                                {{ $productLocation->location->name }}
                                <span class="badge badge-primary badge-pill">{{ $productLocation->quantity }}</span>
                            </div>
                        </a>
                        <div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="heading{{ $loop->index }}">
                            <div id="productLocation{{ $productLocation->product_id }}-{{ $productLocation->location_id }}" class="card-body">
                                <i id="loading{{ $loop->index }}" class="fa fa-spinner fa-pulse fa-fw"></i> Loading...
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                No Locations Found
            @endif
        </div>
    </div>
@endsection