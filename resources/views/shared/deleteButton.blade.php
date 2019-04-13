<button id="delete-{{ $id }}-button" class="btn{{ isset($size) ? '-' . $size : '' }} btn-danger" data-form-id="delete-{{ $id }}-form"
        data-toggle="deleteConfirmation" data-title="Are you sure you wish to delete this {{ $name }}?">
    @isset($deleteIcon)
        <i class="fa {{ $deleteIcon }}" aria-hidden="true"></i>
    @else
        {{ $deleteText or "Delete" }}
    @endisset
</button>
<form id="delete-{{ $id }}-form" role="form" method="POST" action="{{ $route }}">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
</form>