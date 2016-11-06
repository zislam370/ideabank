@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')
<h3 class="idbnk-header">@lang('form/title.all_events')</h3>
<div class="idbnk-detail">
    @if (count($events))
    @foreach($events as $event)

    <div class="row">
        <div class="event-row">
            <div class="events col-lg-12">
                <div class="date pull-left">
                    <div class="day">{{date('d', strtotime($event->start))}}</div>
                    <div class="month">{{date('M', strtotime($event->start))}}</div>
                    <div class="year">{{date('Y', strtotime($event->start))}}</div>
                </div>
                <div class="detail">
                    <h4><a href="{{ URL::route('show-event',$event->id) }}">{{ $event->link_title }}</a></h4>
                    <div class="venue">
                        Vanue: {{ $event->location }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endforeach
</div>
{{ $events->links() }}

@else
<h1>Oops. That page number is invalid.</h1>
@endif
@stop
