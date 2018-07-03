@extends('layouts.master')

@section('title', 'Section Locations: ' . $section->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sections.index') }}">Sections</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sections.show', ['section' => $section]) }}">Show Section</a></li>
                <li class="breadcrumb-item active" aria-current="page">Section Locations</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Locations for section: <small>{{ $section->name }}</small></h1>
            </div>
            <br>
            @if ($locations->isNotEmpty())
                <div class="list-group">
                    @foreach ($locations as $location)
                        <a class="list-group-item list-group-item-action" href="{{ route('locations.show', ['location' => $location]) }}" style="width: 94%;">
                            {{ $location->name }}
                        </a>
                    @endforeach
                </div>
            @else
                No Locations Found
            @endif
        </div>
    </div>
@endsection