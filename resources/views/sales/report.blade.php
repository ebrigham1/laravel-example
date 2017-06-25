@extends('layouts.master')

@section('title', 'Sales Report')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('salesHome') }}">Sales</a></li>
                <li class="active">Report</li>
            </ol>
            <div class="page-header">
                <h1>Sales Report</h1>
            </div>
            Sales report here
        </div>
    </div>
@endsection