@extends('layouts.master')

@section('title', 'Show Label: ' . $label->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Label</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Show Label <small>{{ $label->id }}</small></h1>
            </div>
            <dl class="dl-horizontal">
                <dt>{{ ucfirst($label->labelable_type) }}:</dt>
                <dd>{{ $label->name }}</dd>
                @if ($label->location)
                    <dt>Location:</dt>
                    <dd>{{ $label->location->name }}</dd>
                @endif
            </dl>
            <br><br>
            <button id="moveLabel" class="btn btn-primary" data-toggle="modal" data-target="#moveLabelModal">Move</button>
            @include('shared.deleteButton', ['name' => 'label', 'route' => route('labels.destroy', ['label' => $label])])
            <div class="modal fade" id="moveLabelModal" role="dialog" aria-labelledby="moveLabelModalLabel" aria-hidden="{{ $errors->has('location') ? 'false' : 'true' }}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="moveLabelModalLabel">Move Label</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('labels.move', ['label' => $label]) }}">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="location" class="col-form-label{{ $errors->has('location') ? ' text-danger' : '' }}" data-toggle="tooltip" data-placement="left" title="Location where the labels will be created">*Location:</label>
                                    <select id="location" data-current-location-id="{{ $label->location->id }}" name="location" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" data-toggle="remoteLocationSelect2" data-placeholder="Please type the name of the location" data-ajax--url="{{ route('locations.index.ajax') }}" required style="width: 100%;">
                                    </select>
                                    @if ($errors->has('location'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="Move">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection