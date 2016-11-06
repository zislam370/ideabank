@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
@lang('ideas/title.mymessages') ::
@parent
@stop


{{-- Account page content --}}
@section('account-content')
<h3>
    @lang('account/title.mymessages')
</h3>
<div class="well">
</div>
@stop