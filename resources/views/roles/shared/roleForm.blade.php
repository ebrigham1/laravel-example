@if($type == 'update')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('roles.update', ['role' => $role]) }}">
    {{ method_field('PUT') }}
@elseif($type == 'create')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('roles.store') }}">
@endif
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label" data-toggle="tooltip" data-placement="left" title="Unique id for the role">*Name:</label>
        <div class="col-md-6">
            @if($type == 'update')
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $role->name) }}" required autofocus>
            @elseif($type == 'create')
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
            @endif
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
        <label for="display_name" class="col-md-4 control-label" data-toggle="tooltip" data-placement="left" title="Human readable name for the role">Display Name:</label>
        <div class="col-md-6">
            @if($type == 'update')
                <input id="display_name" type="text" class="form-control" name="display_name" value="{{ old('display_name', $role->display_name) }}">
            @elseif($type == 'create')
                <input id="display_name" type="text" class="form-control" name="display_name" value="{{ old('display_name') }}">
            @endif
            @if ($errors->has('display_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('display_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="col-md-4 control-label" data-toggle="tooltip" data-placement="left" title="Description of the role">Description:</label>
        <div class="col-md-6">
            @if($type == 'update')
                <input id="description" type="text" class="form-control" name="description" value="{{ old('description', $role->description) }}">
            @elseif($type == 'create')
                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}">
            @endif
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                @if($type == 'update')
                    Update Role
                @elseif($type == 'create')
                    Create Role
                @endif
            </button>
        </div>
    </div>
</form>