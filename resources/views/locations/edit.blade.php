@extends('layouts.master')

@section('title', 'Update Location: ' . $location->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('locations.index') }}">Locations</a></li>
                <li class="breadcrumb-item"><a href="{{ route('locations.show', ['location' => $location]) }}">Show Location</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Location</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Update Location <small>{{ $location->name }}</small></h1>
            </div>
            @include('locations.shared.locationForm', ['type' => 'update'])
        </div>
    </div>
@endsection