@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li class="active">Home</li>
            </ol>
            <div class="page-header">
                <h1>Home</h1>
            </div>
            <div class="list-group">
                @role('root')
                    <a class="list-group-item" href="{{ route('roles.index') }}">Roles</a>
                @endrole
                @role(['root', 'web_project_manager', 'web_developer'])
                    <a class="list-group-item" href="{{ route('webHome') }}">Web</a>
                @endrole
                @role(['root', 'sales_manager', 'sales_associate'])
                    <a class="list-group-item" href="{{ route('salesHome') }}">Sales</a>
                @endrole
                @role(['root', 'finance_manager', 'finance_associate'])
                    <a class="list-group-item" href="{{ route('financeHome') }}">Finance</a>
                @endrole
                @role(['root', 'warehouse_manager', 'warehouse_associate'])
                    <a class="list-group-item" href="{{ route('warehouseForm') }}">Warehouse</a>
                @endrole
                <a class="list-group-item" href="{{ route('mostRecentActivities') }}">Most Recent Activities</a>
            </div>
        </div>
    </div>
@endsection
