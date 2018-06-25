@extends('layouts.master')

@section('title', 'Show Location: ' . $location->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('locations.index') }}">Locations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Location</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Show Location <small>{{ $location->name }}</small></h1>
            </div>
            <dl class="dl-horizontal">
                <dt>Name:</dt>
                <dd>{{ $location->name }}</dd>
            </dl>
            <a class="btn btn-primary" href="{{ route('locations.print', ['location' => $location]) }}">Print</a><br><br>
            <a class="btn btn-primary" href="{{ route('locations.edit', ['location' => $location]) }}">Edit</a>
            @include('shared.deleteButton', ['name' => 'location', 'route' => route('locations.destroy', ['location' => $location])])
        </div>
    </div>
@endsection