@extends('layouts.master')

@section('title', 'Web Home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Web</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Web Home</h1>
            </div>
            <div class="list-group">
                @role(['root', 'web_project_manager'])
                    <a class="list-group-item" href="{{ route('webReport') }}">Report</a>
                @endrole
            </div>
            Other stuff that web devs can see
        </div>
    </div>
@endsection