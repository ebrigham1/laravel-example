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
            @if ($productWarehouses->isNotEmpty() && $productLocations->isNotEmpty())
                @foreach ($productWarehouses as $productWarehouse)
                    <div class="card">
                        <a href="#" class="productWarehouse list-group-item-action" data-toggle="collapse" data-target="#productWarehouseCollapse{{ $loop->index }}" aria-expanded="false" aria-controls="productWarehouseCollapse{{ $loop->index }}">
                            <div class="card-header d-flex justify-content-between align-items-center" id="productWarehouseHeading{{ $loop->index }}">
                                {{ $productWarehouse->warehouse->name }}
                                <span class="badge badge-primary badge-pill">{{ $productWarehouse->quantity }}</span>
                            </div>
                        </a>
                        <div id="productWarehouseCollapse{{ $loop->index }}" class="collapse" aria-labelledby="productWarehouseHeading{{ $loop->index }}">
                            <div class="list-group list-group-flush">
                            @foreach ($productSections as $productSection)
                                @if($productSection->section->warehouse_id == $productWarehouse->warehouse_id)
                                    <a href="#" id="productSectionHeading{{ $loop->index }}" class="subProductSection list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#productSectionCollapse{{ $loop->index }}" aria-expanded="false" aria-controls="productSectionCollapse{{ $loop->index }}">
                                        {{ $productSection->section->name }}
                                        <span class="badge badge-primary badge-pill">{{ $productSection->quantity }}</span>
                                    </a>
                                    <div id="productSectionCollapse{{ $loop->index }}" class="collapse" aria-labelledby="productSectionHeading{{ $loop->index }}">
                                        <div class="list-group list-group-flush">
                                            @foreach ($productLocations as $productLocation)
                                                @if($productLocation->location->section_id == $productSection->section_id)
                                                    <a href="#" id="productLocationHeading{{ $loop->index }}" data-ajax-url="{{ route('labels.productLocation.ajax', ['product' => $productLocation->product, 'location' => $productLocation->location]) }}" data-product-id="{{ $productLocation->product_id }}" data-location-id="{{ $productLocation->location_id }}" class="subProductLocation list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#productLocationCollapse{{ $loop->index }}" aria-expanded="false" aria-controls="productLocationCollapse{{ $loop->index }}">
                                                        {{ $productLocation->location->name }}
                                                        <span class="badge badge-primary badge-pill">{{ $productLocation->quantity }}</span>
                                                    </a>
                                                    <div id="productLocationCollapse{{ $loop->index }}" class="collapse" aria-labelledby="productLocationHeading{{ $loop->index }}">
                                                        <div id="productLocation{{ $productLocation->product_id }}-{{ $productLocation->location_id }}" class="card-body">
                                                            <i id="loading{{ $loop->index }}" class="fa fa-spinner fa-pulse fa-fw"></i> Loading...
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach ($productLocations as $productLocation)
                    @if ($productLocation->location->section_id === null)
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
                    @endisset
                @endforeach
            @else
                No Locations Found
            @endif
        </div>
    </div>
@endsection