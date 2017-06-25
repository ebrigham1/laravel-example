@extends('layouts.master')

@section('title', 'Roles Index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Roles</li>
            </ol>
            <div class="page-header">
                <h1>Roles</h1>
            </div>
            <a class="btn btn-primary" href="{{ route('roles.create') }}">Create a new role</a><br><br>
            @if ($roles)
                <div class="list-group">
                    @foreach ($roles as $role)
                        <a class="list-group-item" href="{{ route('roles.show', ['role' => $role]) }}">
                            <h4 class="list-group-item-heading{{ $role->description ? '' : ' no-desc' }}">{{ $role->display_name }}</h4>
                            @if ($role->description)
                                <p class="list-group-item-text">{{ $role->description }}</p>
                            @endif
                        </a>
                    @endforeach
                </div>
                {{ $roles->links() }}
            @else
                No Roles Found
            @endif
        </div>
    </div>
@endsection