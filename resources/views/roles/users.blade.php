@extends('layouts.master')

@section('title', 'Users with role: ' . $role->display_name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index', ['role' => $role]) }}">Roles</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.show', ['role' => $role]) }}">Show Role</a></li>
                <li class="breadcrumb-item active" aria-current="page">Roles</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Users with role: <small>{{ $role->display_name }}</small></h1>
            </div>
            <form method="POST" action="{{ route('roles.users.store', ['role' => $role]) }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('users') ? ' has-error' : '' }}">
                    <label class="sr-only" for="users">Users</label>
                    <div class="input-group">
                        <select tabindex="1" id="users" name="users[]" multiple="multiple" class="form-control" data-toggle="remoteUserSelect2" data-placeholder="Please type the name(s) of users you wish to add to this role" data-ajax--url="{{ route('roles.usersNotInRole.ajax', ['role' => $role]) }}" required style="width: 100%;">
                        </select>
                        <span class="input-group-btn">
                            <button tabindex="2" type="submit" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
                        </span>
                    </div>
                    @if ($errors->has('users'))
                        <span class="help-block">
                            <strong>{{ $errors->first('users') }}</strong>
                        </span>
                    @endif
                </div>
            </form><br>
            @if ($users)
                <div class="list-group">
                    @foreach ($users as $user)
                        <div class="input-group">
                            <a class="list-group-item" href="{{ route('users.show', ['user' => $user]) }}">
                                {{ $user->name }}
                            </a>
                            <span class="input-group-btn">
                                @include('shared.deleteButton', ['name' => 'user' . $user->id, 'route' => route('roles.users.destroy', ['role' => $role, 'user' => $user]), 'deleteIcon' => 'fa-user-times'])
                            </span>
                        </div>
                    @endforeach
                </div>
                {{ $users->links() }}
            @else
                No Users Found
            @endif
        </div>
    </div>
@endsection