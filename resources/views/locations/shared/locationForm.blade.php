@if($type == 'update')
    <form class="form-horizontal" location="form" method="POST" action="{{ route('locations.update', ['location' => $location]) }}">
    {{ method_field('PUT') }}
@elseif($type == 'create')
    <form class="form-horizontal" location="form" method="POST" action="{{ route('locations.store') }}">
@endif
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label" data-toggle="tooltip" data-placement="left" title="Unique id for the location">*Name:</label>
        <div class="col-md-6">
            @if($type == 'update')
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $location->name) }}" required autofocus>
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
        <label for="section_id" class="col-md-4 col-form-label{{ $errors->has('section_id') ? ' text-danger' : '' }}" data-toggle="tooltip" data-placement="left" title="Section where this location is located">Section:</label>
        <div class="col-md-6">
            <select id="section_id" name="section_id" class="form-control{{ $errors->has('section_id') ? ' is-invalid' : '' }}" data-toggle="remoteSectionSelect2" data-placeholder="Please type the name of the section" data-ajax--url="{{ route('sections.index.ajax') }}" style="width: 100%;">
                <option value=""></option>
                @if (isset($location) && $location->section instanceof \App\Models\Section)
                    <option value="{{ $location->section->id }}" selected>{{ $location->section->name }}</option>
                @endif
            </select>
            @if ($errors->has('section_id'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('section_id') }}</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                @if($type == 'update')
                    Update Location
                @elseif($type == 'create')
                    Create Location
                @endif
            </button>
        </div>
    </div>
</form>