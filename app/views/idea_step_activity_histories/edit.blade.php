@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('idea_step_activity_histories/title.edit') ::
@parent
@stop


{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('idea_step_activity_histories/title.edit')
    <div class="pull-right">
        <a href="{{ route('idea_step_activity_histories') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
    </div>
</h1>
@stop


{{-- Page content --}}
@section('content')

<form autocomplete="off" method="post" class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Widget -->
    <div class="widget">

        <!-- Widget heading -->
        <div class="widget-head">
            <h4 class="heading">@lang('idea_step_activity_histories/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">

                    <div class="form-group">
            {{ Form::label('idea_step_id', 'Idea_step_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'idea_step_id', Input::old('idea_step_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('workflow_activity_id', 'Workflow_activity_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'workflow_activity_id', Input::old('workflow_activity_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('status', Lang::get('form/title.Status'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'status', Input::old('status'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('due_date', Lang::get('form/title.Due_date'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('due_date', Input::old('due_date'), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.Due_date'))) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('initiate_date', Lang::get('form/title.Initiate_date'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('initiate_date', Input::old('initiate_date'), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.Initiate_date'))) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('next_activity', Lang::get('form/title.Next_activity'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'next_activity', Input::old('next_activity'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('num_of_activities', Lang::get('form/title.Num_of_activities'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'num_of_activities', Input::old('num_of_activities'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label(' activity_form_ids', Lang::get('form/title.Activity_form_ids'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text(' activity_form_ids', Input::old(' activity_form_ids'), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.Activity_form_ids'))) }}
            </div>
        </div>


            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('idea_step_activity_histories') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>
        </div>
    </div>
</form>
@stop