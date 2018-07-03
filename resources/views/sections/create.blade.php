@extends('layouts.master')

@section('title', 'Create Section')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sections.index') }}">Sections</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Section</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Create Section</h1>
            </div>
            @include('sections.shared.sectionForm', ['type' => 'create'])
        </div>
    </div>
@endsection