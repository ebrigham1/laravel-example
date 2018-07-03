@if($type == 'update')
    <form class="form-horizontal" location="form" method="POST" action="{{ route('warehouses.update', ['warehouse' => $warehouse]) }}">
    {{ method_field('PUT') }}
@elseif($type == 'create')
    <form class="form-horizontal" location="form" method="POST" action="{{ route('warehouses.store') }}">
@endif
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label" data-toggle="tooltip" data-placement="left" title="Unique id for the warehouse">*Name:</label>
        <div class="col-md-6">
            @if($type == 'update')
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $warehouse->name) }}" required autofocus>
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
    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                @if($type == 'update')
                    Update Warehouse
                @elseif($type == 'create')
                    Create Warehouse
                @endif
            </button>
        </div>
    </div>
</form>