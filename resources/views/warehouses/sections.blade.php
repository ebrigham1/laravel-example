@extends('layouts.master')

@section('title', 'Warehouse Locations: ' . $warehouse->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('warehouses.index') }}">Warehouses</a></li>
                <li class="breadcrumb-item"><a href="{{ route('warehouses.show', ['warehouse' => $warehouse]) }}">Show Warehouse</a></li>
                <li class="breadcrumb-item active" aria-current="page">Warehouse Locations</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Sections for warehouse: <small>{{ $warehouse->name }}</small></h1>
            </div>
            <br>
            @if ($sections->isNotEmpty())
                <div class="list-group">
                    @foreach ($sections as $section)
                        <a class="list-group-item list-group-item-action" href="{{ route('sections.show', ['section' => $section]) }}" style="width: 94%;">
                            {{ $section->name }}
                        </a>
                    @endforeach
                </div>
            @else
                No Sections Found
            @endif
        </div>
    </div>
@endsection