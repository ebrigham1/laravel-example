@extends('layouts.master')

@section('title', 'Finance Home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Finance</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Finance Home</h1>
            </div>
            <div class="list-group">
                @role(['root', 'finance_manager'])
                    <a class="list-group-item" href="{{ route('ledger') }}">Ledger</a>
                @endrole
            </div>
            Other stuff that finance associates can see
        </div>
    </div>
@endsection