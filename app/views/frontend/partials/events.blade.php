<style>
    .events{
        border-bottom: 1px solid #eee;
        padding: 0;
        float: none;
        display: table;
    }
    .events .image{
        margin-right: 10px;
    }
    .events .detail h4{
        font-size: 1.5em;
    }
    .events .detail h4 span{
        color: #666;
        font-size: .8em;
        margin-left: 10px;
    }
    .events .venue{
        color: #888;
        font-size: .8em;
    }
    .events .date{
        width: 70px;
        height: 70px;
        text-align: center;
        color: #fff;
        margin: 10px;
        padding: 2px;
        display: inline-block;
        border-radius: 5px;
    }
    .event-row:nth-child(odd) .date{
        background-color: #8dc641;
    }
    .event-row:nth-child(even) .date{
        background-color: #8f52a0;
    }
    .events .date .day{
        font-size: 1.2em;
    }
</style>
@foreach($events as $event)

<div class="event-row row">
    <div class="events col-lg-8 center-block">
        <div class="date  pull-left">
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

@endforeach
<div class="row" style="margin-top: 10px">
    <div class="col-lg-8 center-block" style="float: none;">
        <!-- Controls -->
        <div class="controls pull-right">
            <a class="fa btn btn-sm btn-info btn-ass" href="{{route('all_events')}}">@lang('form/title.show_all')</a>
        </div>
    </div>
</div>

