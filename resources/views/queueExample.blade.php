@extends('layouts.master')

@section('title', 'Queue Example')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Queue Example</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Queue Example</h1>
            </div>
            <div class="list-group">
                <a class="list-group-item list-group-item-action" href="{{ route('queueExampleWithoutQueue') }}">Long Task Without Queue</a>
                <a class="list-group-item list-group-item-action" href="{{ route('queueExampleWithQueue') }}">Long Task With Queue</a>
            </div>
        </div>
    </div>
@endsection