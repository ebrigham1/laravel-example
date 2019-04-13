@extends('layouts.master')

@section('title', 'Show Warehouse: ' . $warehouse->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('warehouses.index') }}">Warehouses</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Warehouse</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Show Warehouse <small>{{ $warehouse->name }}</small></h1>
            </div>
            <dl class="dl-horizontal">
                <dt>Name:</dt>
                <dd>{{ $warehouse->name }}</dd>
            </dl>
            <a class="btn btn-info" href="{{ route('warehouses.sections', ['warehouse'  => $warehouse]) }}">Sections</a>
            <br><br>
            <a class="btn btn-primary" href="{{ route('warehouses.print', ['warehouse' => $warehouse]) }}">Print</a>
            <br><br>
            <a class="btn btn-primary" href="{{ route('warehouses.edit', ['warehouse' => $warehouse]) }}">Edit</a>
            @include('shared.deleteButton', ['id' => 'warehouse' . $warehouse->id, 'name' => 'warehouse', 'route' => route('warehouses.destroy', ['warehouse' => $warehouse])])
        </div>
    </div>
@endsection