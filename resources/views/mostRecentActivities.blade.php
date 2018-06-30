@extends('layouts.master')

@section('title', 'Most Recent Activities')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @breadcrumbs
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Most Recent Activities</li>
            @endbreadcrumbs
            <div class="page-header">
                <h1>Most Recent Activities</h1>
            </div>
            <div data-last-page-index="{{ $activityLogs->lastPage() }}" data-has-more-pages="{{ $activityLogs->hasMorePages() }}" data-last-page="" data-base-ajax-url="{{ route('mostRecentActivitiesAjax') }}" id="activityLogs" class="list-group">
                @foreach ($activityLogs as $activityLog)
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h4 class="mb-1">{{ $activityLog->user->name }}</h4>
                            <span class="text-muted">{{ $activityLog->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mb-1">{{ $activityLog->description }}</p>
                    </div>
                @endforeach
            </div>
            @if ($activityLogs->isEmpty())
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