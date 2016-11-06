@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
@if($page)
{{ $page->title }} ::
@else
    Invalid Page Request ::
@endif

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
@if($page)
<h3 class="idbnk-header">{{ $page->title }}</h3>
<div class="idbnk-detail col-sm-12 col-md-12 col-lg-12">

    {{ $page->body }}
</div>

@else
<p>
    Requested Page not found!
</p>
@endif
@stop


