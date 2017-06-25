@extends('layouts.master')

@section('title', 'Web Report')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Warehouse</li>
            </ol>
            <div class="page-header">
                <h1>Warehouse Form</h1>
            </div>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('warehouseFormSubmit') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('pickList') ? ' has-error' : '' }}">
                    <label for="pickList" class="col-md-4 control-label" data-toggle="tooltip" data-placement="left" title="Unique id for the pick list">*Pick List:</label>
                    <div class="col-md-6">
                        <input id="pickList" type="text" class="form-control" name="pickList" value="{{ old('pickList') }}" required autofocus>
                        @if ($errors->has('pickList'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pickList') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection