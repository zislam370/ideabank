@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('account/title.signin') ::
@parent
@stop

{{-- Page content --}}
@section('content')
@include('frontend/notifications')
<br/>
@include('frontend.auth.login')
@stop
