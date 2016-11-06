@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
@lang('account/title.dashboardtitle') ::
@parent
@stop

{{-- Account page content --}}
@section('account-content')
<div class="page-header">
    <h3>Welcome,
        <small>{{ Sentry::getUser()->first_name }}</small>
    </h3>
</div>
<div class="panel-body">
    <div class="well">
        <a href="{{ route('submit/idea','general') }}" class="btn btn-warning">@lang('button.submitidea')</a>
        @foreach ($adverts as $advert)
        <a href="{{ route('submit/idea',$advert->workflow_category_id) }}" class="btn btn-success">{{{$advert->link_title}}}</a>
        @endforeach
    </div>
    <h4>
        <a href="{{ route('myideas') }}" class="btn btn-link">
            Your total ideas: <span class="badge">{{{$total_ideas}}}</span>
        </a>
    </h4>
</div>
@stop
