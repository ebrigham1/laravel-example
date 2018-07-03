@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Home</h1>
            </div>
            <div class="list-group">
                @role('root')
                    <a class="list-group-item list-group-item-action" href="{{ route('roles.index') }}">Roles</a>
                    <a class="list-group-item list-group-item-action" href="{{ route('products.index') }}">Products</a>
                    <a class="list-group-item list-group-item-action" href="{{ route('warehouses.index') }}">Warehouses</a>
                    <a class="list-group-item list-group-item-action" href="{{ route('sections.index') }}">Sections</a>
                    <a class="list-group-item list-group-item-action" href="{{ route('locations.index') }}">Locations</a>
                @endrole
                @role(['root', 'web_project_manager', 'web_developer'])
                    <a class="list-group-item list-group-item-action" href="{{ route('webHome') }}">Web</a>
                @endrole
                @role(['root', 'sales_manager', 'sales_associate'])
                    <a class="list-group-item list-group-item-action" href="{{ route('salesHome') }}">Sales</a>
                @endrole
                @role(['root', 'finance_manager', 'finance_associate'])
                    <a class="list-group-item list-group-item-action" href="{{ route('financeHome') }}">Finance</a>
                @endrole
                <a class="list-group-item list-group-item-action" href="{{ route('mostRecentActivities') }}">Most Recent Activities</a>
            </div>
        </div>
    </div>
@endsection
