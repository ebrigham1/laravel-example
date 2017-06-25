@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @forelse ($permissions as $permission)
                    <a href="{{ route('permissions.show', ['permission' => $permission]) }}">{{ $permission->display_name }}</a><br>
                @empty
                    No Permissions Found
                @endforelse
            </div>
        </div>
    </div>
@endsection