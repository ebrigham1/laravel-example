@extends('layouts.master')

@section('title', 'Finance Home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Finance</li>
            </ol>
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