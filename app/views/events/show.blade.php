@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('events/title.Show_event') ::
@parent
@stop


{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('events/title.Show_event')
    <div class="pull-right">
        <a href="javascript:;" onclick="window.history.back(); return false;" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
    </div>
</h1>
@stop


{{-- Page content --}}
@section('content')


<!-- Widget -->
<div class="widget">

    <div class="widget-body">
        <!-- 4 Column Grid / One Fourth -->
        <div class="row">
            <!-- Idea Name -->
            <div class="col-sm-12" align="center">
                <h4 class="strong">
                    {{{ $event->name }}}
                </h4>
                <p>{{{ date( 'd-m-Y', strtotime( $event->start )) }}} {{Lang::get('form/title.To')}} {{{ date( 'd-m-Y', strtotime( $event->end )) }}}</p>
                <div>
                    <p>{{ $event->advert }}</p>
                </div>
                <img alt="" src="{{asset($event->attachment->url('original'))}}" >
            </div>
        </div>
        <!-- // 4 Column Grid / One Fourth END -->
    </div>

</div>

@stop

@section('body_bottom')
<script>
    $(document).ready(function(){
    });
</script>
@stop

