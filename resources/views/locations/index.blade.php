@extends('layouts.master')

@section('title', 'Locations Index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Locations</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Locations</h1>
            </div>
            <a class="btn btn-primary" href="{{ route('locations.create') }}">Create a new location</a><br><br>
            @if ($locations)
                <div class="list-group">
                    @foreach ($locations as $location)
                        <a class="list-group-item list-group-item-action" href="{{ route('locations.show', ['location' => $location]) }}">
                            {{ $location->name }}
                        </a>
                    @endforeach
                </div>
                {{ $locations->links() }}
            @else
                No Locations Found
            @endif
        </div>
    </div>
@endsection