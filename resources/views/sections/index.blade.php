@extends('layouts.master')

@section('title', 'Sections Index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sections</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Sections</h1>
            </div>
            <a class="btn btn-primary" href="{{ route('sections.create') }}">Create a new section</a><br><br>
            @if ($sections)
                <div class="list-group">
                    @foreach ($sections as $section)
                        <a class="list-group-item list-group-item-action" href="{{ route('sections.show', ['section' => $section]) }}">
                            {{ $section->name }}
                        </a>
                    @endforeach
                </div>
                {{ $sections->links() }}
            @else
                No Sections Found
            @endif
        </div>
    </div>
@endsection