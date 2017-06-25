@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <a href="{{ route('roles.index') }}">Roles/Permissions</a><br>
                    <a href="{{ route('financeHome') }}">Finance</a><br>
                    <a href="{{ route('webHome') }}">Web</a><br>
                    <a href="{{ route('salesHome') }}">Sales</a><br>
                    <a href="{{ route('warehouseForm') }}">Warehouse</a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
