@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Contact us ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>@lang('account/title.Contact_us')</h3>
</div>

<form class="form-horizontal" role="form" method="post" action="">
<!-- CSRF Token -->
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="widget-body innerAll inner-2x">

        <div class="form-group">
            {{ Form::label('name', Lang::get('form/title.name'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::input('text', 'name', Input::old('name'), array('class'=>'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('email', Lang::get('form/title.email'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::input('text', 'email', Input::old('email'), array('class'=>'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('subject', Lang::get('form/title.subject'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::input('text', 'subject', Input::old('subject'), array('class'=>'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('body', Lang::get('form/title.message'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::textarea('body', Input::old('body'), array('id'=>'ck_body', 'class'=>'form-control')) }}
            </div>
        </div>
        <div class="separator"></div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">@lang('button.send')</button>
        </div>
    </div>

</form>
@stop
