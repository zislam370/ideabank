@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Create a Idea_step_activity_attachment ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('idea_step_activity_attachments/title.create')

    <div class="pull-right">
        <a href="{{ route('idea_step_activity_attachments') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
    </div>
</h1>
@stop


{{-- Page content --}}
@section('content')

<form autocomplete="off" method="post" class="form-horizontal margin-none" novalidate="novalidate" enctype="multipart/form-data">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Widget -->
    <div class="widget">

        <!-- Widget heading -->
        <div class="widget-head">
            <h4 class="heading">@lang('idea_step_activity_attachments/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">



                    <div class="form-group">
            {{ Form::label('idea_step_activity_id', Lang::get('form/title.Idea_step_activity_id'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'idea_step_activity_id', Input::old('idea_step_activity_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('head_id', Lang::get('form/title.Head_id'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'head_id', Input::old('head_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('comment', Lang::get('form/title.comment'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('comment', Input::old('comment'), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.comment'))) }}
            </div>
        </div>

            <div class="form-group {{ $errors->first('attachment', 'has-error') }}">
                <label for="attachment" class="">@lang('idea_step_activities/form.attachment')</label>
                {{ Form::file('attachment', Input::old('attachment'), array('class'=>'form-control')) }}
                {{ $errors->first('attachment', '<span class="help-block">:message</span>') }}
            </div>

            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('idea_step_activity_attachments') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>

        </div>
    </div>
</form>
@stop


