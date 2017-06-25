@extends('layouts.master')

@section('title', 'Web Report')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('webHome') }}">Web</a></li>
                <li class="active">Report</li>
            </ol>
            <div class="page-header">
                <h1>Web Report</h1>
            </div>
            Web report here
        </div>
    </div>
@endsection