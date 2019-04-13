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
                        <select tabindex="1" id="users" name="users[]" multiple="multiple" class="form-control" data-toggle="remoteUserSelect2" data-placeholder="Please type the name(s) of users you wish to add to this role" data-ajax--url="{{ route('roles.usersNotInRole.ajax', ['role' => $role]) }}" required style="width: 96%;">
                        </select>
                        <div class="input-group-append">
                            <button tabindex="2" type="submit" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    @if ($errors->has('users'))
                        <span class="help-block">
                            <strong>{{ $errors->first('users') }}</strong>
                        </span>
                    @endif
                </div>
            </form><br>
            @if ($users->isNotEmpty())
                <div class="list-group">
                    @foreach ($users as $user)
                        <div class="input-group">
                            <a class="list-group-item list-group-item-action" href="{{ route('users.show', ['user' => $user]) }}" style="width: 94%;">
                                {{ $user->name }}
                            </a>
                            <div class="input-group-append">
                                <span class="input-group-btn">
                                    @include('shared.deleteButton', ['size' => 'lg', 'id' => 'user' . $user->id, 'name' => 'user', 'route' => route('roles.users.destroy', ['role' => $role, 'user' => $user]), 'deleteIcon' => 'fa-user-times'])
                                </span>
                            </div>
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