@if($type == 'update')
    <form class="form-horizontal" product="form" method="POST" action="{{ route('products.update', ['product' => $product]) }}">
    {{ method_field('PUT') }}
@elseif($type == 'create')
    <form class="form-horizontal" product="form" method="POST" action="{{ route('products.store') }}">
@endif
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label" data-toggle="tooltip" data-placement="left" title="Unique id for the product">*Name:</label>
        <div class="col-md-6">
            @if($type == 'update')
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" required autofocus>
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
                    Update Product
                @elseif($type == 'create')
                    Create Product
                @endif
            </button>
        </div>
    </div>
</form>