@extends('layouts.master')

@section('title', 'Ledger')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('financeHome') }}">Finance</a></li>
                <li class="active">Ledger</li>
            </ol>
            <div class="page-header">
                <h1>Ledger</h1>
            </div>
            Ledger stuff here
        </div>
    </div>
@endsection