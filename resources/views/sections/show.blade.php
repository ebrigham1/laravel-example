@extends('layouts.master')

@section('title', 'Show Section: ' . $section->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sections.index') }}">Sections</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Section</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Show Section <small>{{ $section->name }}</small></h1>
            </div>
            <dl class="dl-horizontal">
                <dt>Warehouse:</dt>
                <dd>{{ $section->warehouse->name }}</dd>
                <dt>Name:</dt>
                <dd>{{ $section->name }}</dd>
            </dl>
            <a class="btn btn-info" href="{{ route('sections.locations', ['section'  => $section]) }}">Locations</a>
            <br><br>
            <a class="btn btn-primary" href="{{ route('sections.print', ['section' => $section]) }}">Print</a>
            <br><br>
            <a class="btn btn-primary" href="{{ route('sections.edit', ['section' => $section]) }}">Edit</a>
            @include('shared.deleteButton', ['name' => 'section', 'route' => route('sections.destroy', ['section' => $section])])
        </div>
    </div>
@endsection