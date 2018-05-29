@extends('layouts.master')

@section('title', 'Create Role')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Role</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Create Role</h1>
            </div>
            @include('roles.shared.roleForm', ['type' => 'create'])
        </div>
    </div>
@endsection