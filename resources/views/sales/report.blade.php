@extends('layouts.master')

@section('title', 'Sales Report')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('salesHome') }}">Sales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Report</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Sales Report</h1>
            </div>
            Sales report here
        </div>
    </div>
@endsection