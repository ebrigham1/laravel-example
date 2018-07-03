@extends('layouts.master')

@section('title', 'Create Warehouse')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('warehouses.index') }}">Warehouses</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Warehouse</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Create Warehouse</h1>
            </div>
            @include('warehouses.shared.warehouseForm', ['type' => 'create'])
        </div>
    </div>
@endsection