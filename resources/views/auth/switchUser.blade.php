@extends('layouts.master')

@section('title', 'Switch User')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Switch User</li>
            </ol>
            <div class="page-header">
                <h1>Switch User</h1>
            </div>
            <form class="form-horizontal" role="form"  method="POST" action="{{ route('auth.switchUserSwitch') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label" for="user" data-toggle="tooltip" data-placement="left" title="The user you wish to login as">User</label>
                    <div class="col-md-6">
                        <select id="user" name="user" class="form-control" data-toggle="remoteUserSelect2" data-placeholder="Please type the name of user you wish to switch to" data-ajax--url="{{ route('users.getUsers.ajax') }}" required style="width: 100%;">
                        </select>
                        @if ($errors->has('user'))
                            <span class="help-block">
                                <strong>{{ $errors->first('user') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button class="btn btn-primary">
                                Switch User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection