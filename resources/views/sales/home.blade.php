@extends('layouts.master')

@section('title', 'Sales Home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Sales</li>
            </ol>
            <div class="page-header">
                <h1>Sales Home</h1>
            </div>
            <div class="list-group">
                @role(['root', 'sales_manager'])
                    <a class="list-group-item" href="{{ route('salesReport') }}">Report</a>
                @endrole
            </div>
            Other stuff that sales associates can see
        </div>
    </div>
@endsection