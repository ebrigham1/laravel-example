@extends('layouts.master')

@section('title', 'Update Role: ' . $role->display_name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('roles.index') }}">Roles</a></li>
                <li><a href="{{ route('roles.show', ['role' => $role]) }}">Show Role</a></li>
                <li class="active">Update Role</li>
            </ol>
            <div class="page-header">
                <h1>Update Role <small>{{ $role->display_name }}</small></h1>
            </div>
            @include('roles.shared.roleForm', ['type' => 'update'])
        </div>
    </div>
@endsection