@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('advertisements/title.Show_Advertisement') ::
@parent
@stop


{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('advertisements/title.Show_Advertisement')
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
                    {{{ $advertisement->name }}}
                </h4>
                <p>{{{ $advertisement->location }}}</p>
                <p>{{{ date( 'd-m-Y', strtotime( $advertisement->start )) }}} {{Lang::get('form/title.To')}} {{{ date( 'd-m-Y', strtotime( $advertisement->end )) }}}</p>
                <div>
                    <p>{{ $advertisement->advert }}</p>
                </div>
                <img alt="" src="{{asset($advertisement->attachment->url('original'))}}" >
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

