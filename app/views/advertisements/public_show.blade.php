@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('advertisements/title.Show_Advertisement') ::
@parent
@stop

{{-- Update the Meta Title --}}
@section('meta_title')

@parent
@stop

{{-- Update the Meta Description --}}
@section('meta_description')

@parent
@stop

{{-- Update the Meta Keywords --}}
@section('meta_keywords')

@parent
@stop

{{-- Page content --}}
@section('content')
@if($advertisement)
<div class="col-sm-12 col-md-12 col-lg-12" style="background-color: #fff; padding: 10px;margin-top: 20px">
    <div class="col-sm-12" align="center">
        <h4 class="strong">
            {{{ $advertisement->name }}}
        </h4>
        <p>Vanue: {{{ $advertisement->location }}}</p>
        <p>{{{ date( 'd-m-Y', strtotime( $advertisement->start )) }}} {{Lang::get('form/title.To')}} {{{ date( 'd-m-Y', strtotime( $advertisement->end )) }}}</p>
        <div>
            <p>{{ $advertisement->advert }}</p>
        </div>
        <img alt="" src="{{asset($advertisement->attachment->url('original'))}}" >
    </div>
</div>

@else
<p>
    Requested Page not found!
</p>
@endif
@stop


