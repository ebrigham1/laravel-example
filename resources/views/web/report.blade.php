@extends('layouts.master')

@section('title', 'Web Report')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('webHome') }}">Web</a></li>
                <li class="breadcrumb-item active" aria-current="page">Report</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Web Report</h1>
            </div>
            Web report here
        </div>
    </div>
@endsection