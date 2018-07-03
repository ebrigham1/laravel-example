@if($type == 'update')
    <form class="form-horizontal" location="form" method="POST" action="{{ route('sections.update', ['section' => $section]) }}">
    {{ method_field('PUT') }}
@elseif($type == 'create')
    <form class="form-horizontal" location="form" method="POST" action="{{ route('sections.store') }}">
@endif
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label" data-toggle="tooltip" data-placement="left" title="Unique id for the section">*Name:</label>
        <div class="col-md-6">
            @if($type == 'update')
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $section->name) }}" required autofocus>
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
        <label for="warehouse_id" class="col-md-4 col-form-label{{ $errors->has('warehouse_id') ? ' text-danger' : '' }}" data-toggle="tooltip" data-placement="left" title="Warehouse where this section is located">*Warehouse:</label>
        <div class="col-md-6">
            <select id="warehouse_id" name="warehouse_id" class="form-control{{ $errors->has('warehouse_id') ? ' is-invalid' : '' }}" data-toggle="remoteWarehouseSelect2" data-placeholder="Please type the name of the warehouse" data-ajax--url="{{ route('warehouses.index.ajax') }}" required style="width: 100%;">
                @if (isset($section))
                    <option value="{{ $section->warehouse->id }}">{{ $section->warehouse->name }}</option>
                @endif
            </select>
            @if ($errors->has('warehouse_id'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('warehouse_id') }}</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                @if($type == 'update')
                    Update Section
                @elseif($type == 'create')
                    Create Section
                @endif
            </button>
        </div>
    </div>
</form>