@extends('layouts.master')

@section('title', 'Update Section: ' . $section->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sections.index') }}">Sections</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sections.show', ['section' => $section]) }}">Show Section</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Section</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Update Section <small>{{ $section->name }}</small></h1>
            </div>
            @include('sections.shared.sectionForm', ['type' => 'update'])
        </div>
    </div>
@endsection