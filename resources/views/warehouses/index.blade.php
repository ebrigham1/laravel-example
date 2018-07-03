@extends('layouts.master')

@section('title', 'Warehouses Index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Warehouses</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Warehouses</h1>
            </div>
            <a class="btn btn-primary" href="{{ route('warehouses.create') }}">Create a new warehouse</a><br><br>
            @if ($warehouses)
                <div class="list-group">
                    @foreach ($warehouses as $warehouse)
                        <a class="list-group-item list-group-item-action" href="{{ route('warehouses.show', ['warehouse' => $warehouse]) }}">
                            {{ $warehouse->name }}
                        </a>
                    @endforeach
                </div>
                {{ $warehouses->links() }}
            @else
                No Warehouses Found
            @endif
        </div>
    </div>
@endsection