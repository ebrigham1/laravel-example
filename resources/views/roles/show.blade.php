@extends('layouts.master')

@section('title', 'Show Role: ' . $role->display_name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Role</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Show Role <small>{{ $role->display_name }}</small></h1>
            </div>
            <dl class="dl-horizontal">
                <dt>Name:</dt>
                <dd>{{ $role->name }}</dd>
                <dt>Disaplay Name:</dt>
                {{-- Avoid running the accessor --}}
                <dd>{{ $role->getAttributes()['display_name'] or 'N/A' }}</dd>
                <dt>Description:</dt>
                <dd>{{ $role->description or 'N/A' }}</dd>
            </dl>
            <a class="btn btn-info" href="{{ route('roles.users', ['role'  => $role]) }}">Users</a>
            {{-- <a class="btn btn-info" href="{{ route('permissions.index', ['role'  => $role]) }}">Permissions</a> --}}<br><br>
            <a class="btn btn-primary" href="{{ route('roles.edit', ['role' => $role]) }}">Edit</a>
            @include('shared.deleteButton', ['name' => 'role', 'route' => route('roles.destroy', ['role' => $role])])
        </div>
    </div>
@endsection