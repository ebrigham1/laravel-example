@extends('layouts.master')

@section('title', 'Most Recent Activities')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Most Recent Activities</li>
            </ol>
            <div class="page-header">
                <h1>Most Recent Activites</h1>
            </div>
            <div id="activityLogs" class="list-group">
                @foreach ($activityLogs as $activityLog)
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">{{ $activityLog->user->name }}<span class="list-group-item-date">{{ $activityLog->created_at->diffForHumans() }}</span></h4>
                        <p class="list-group-item-text">{{ $activityLog->description }}</p>
                    </div>
                @endforeach
            </div>
            @if (!$activityLogs->isEmpty())
                {{ $activityLogs->links() }}
            @else
                <div id="noActivities">
                    No Activities Found
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="https://{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    <script src="{{ mix('/js/activityLog.js') }}"></script>
@endsection