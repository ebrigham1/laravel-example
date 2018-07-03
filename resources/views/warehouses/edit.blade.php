@extends('layouts.master')

@section('title', 'Update Warehouse: ' . $warehouse->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('warehouses.index') }}">Warehouses</a></li>
                <li class="breadcrumb-item"><a href="{{ route('warehouses.show', ['warehouse' => $warehouse]) }}">Show Warehouse</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Warehouse</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Update Warehouse <small>{{ $warehouse->name }}</small></h1>
            </div>
            @include('warehouses.shared.warehouseForm', ['type' => 'update'])
        </div>
    </div>
@endsection