@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('account/title.question_about_cap_dev') ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>@lang('account/title.question_about_cap_dev')</h3>
</div>

<form class="form-horizontal" role="form" method="post" action="">
<!-- CSRF Token -->
<input type="hidden" name="_token" value="{{ csrf_token() }}" />




    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">@lang('button.submit')</button>
        </div>
    </div>

</form>
@stop
