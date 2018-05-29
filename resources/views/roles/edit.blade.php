@extends('layouts.master')

@section('title', 'Update Role: ' . $role->display_name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.show', ['role' => $role]) }}">Show Role</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Role</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Update Role <small>{{ $role->display_name }}</small></h1>
            </div>
            @include('roles.shared.roleForm', ['type' => 'update'])
        </div>
    </div>
@endsection