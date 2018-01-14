@extends('layouts.master')

@section('title', 'Activity Log')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Activity Log</li>
            </ol>
            <div class="page-header">
                <h1>Activity Log</h1>
            </div>
            @if (!$activityLogs->isEmpty())
                <div class="list-group">
                    @foreach ($activityLogs as $activityLog)
                        <div class="list-group-item">
                            <h4 class="list-group-item-heading">{{ $activityLog->user->name }}<span class="list-group-item-date">{{ $activityLog->created_at->diffForHumans() }}</span></h4>
                            <p class="list-group-item-text">{{ $activityLog->description }}</p>
                        </div>
                    @endforeach
                </div>
                {{ $activityLogs->links() }}
            @else
                No Activities Found
            @endif
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{ mix('/js/activityLog.js') }}"></script>
@endsection