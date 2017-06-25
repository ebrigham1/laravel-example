@extends('layouts.master')

@section('title', 'Create Role')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="active">Create Role</li>
            </ol>
            <div class="page-header">
                <h1>Create Role</h1>
            </div>
            @include('roles.shared.roleForm', ['type' => 'create'])
        </div>
    </div>
@endsection