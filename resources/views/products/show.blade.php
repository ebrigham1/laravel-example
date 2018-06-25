@extends('layouts.master')

@section('title', 'Show Product: ' . $product->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Product</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Show Product <small>{{ $product->name }}</small></h1>
            </div>
            <dl class="dl-horizontal">
                <dt>Name:</dt>
                <dd>{{ $product->name }}</dd>
            </dl>
            <button id="createProductLabels" class="btn btn-primary" data-toggle="modal" data-target="#createLabelsModal">Create Labels</button>
            <br><br>
            <a class="btn btn-info" href="{{ route('products.locations', ['product'  => $product]) }}">Locations</a>
            <br><br>
            <a class="btn btn-primary" href="{{ route('products.edit', ['product' => $product]) }}">Edit</a>
            @include('shared.deleteButton', ['name' => 'product', 'route' => route('products.destroy', ['product' => $product])])
            <div class="modal fade" id="createLabelsModal" role="dialog" aria-labelledby="createLabelsModalLabel" aria-hidden="{{ $errors->has('location') || $errors->has('number') ? 'false' : 'true' }}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createLabelsModalLabel">Create labels for {{ $product->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('products.productLabels.store', ['product' => $product]) }}">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="location" class="col-form-label{{ $errors->has('location') ? ' text-danger' : '' }}" data-toggle="tooltip" data-placement="left" title="Location where the labels will be created">*Location:</label>
                                    <select id="location" name="location" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" data-toggle="remoteLocationSelect2" data-placeholder="Please type the name of the location" data-ajax--url="{{ route('locations.index.ajax') }}" required style="width: 100%;">
                                    </select>
                                    @if ($errors->has('location'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="number" class="col-form-label{{ $errors->has('number') ? ' text-danger' : '' }}" data-toggle="tooltip" data-placement="left" title="Number of labels to create">*# Labels:</label>
                                    <input type="number" name="number" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" id="number" required value="{{ old('number', 1) }}">
                                    @if ($errors->has('number'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('number') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="Create">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection