@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>About</h1>
            </div>
        </div>
    </div>
@endsection