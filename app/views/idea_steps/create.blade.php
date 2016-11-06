@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Create a Idea_step ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('idea_steps/title.create')

    <div class="pull-right">
        <a href="{{ route('idea_steps') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
    </div>
</h1>
@stop


{{-- Page content --}}
@section('content')

<form autocomplete="off" method="post" class="apply-nolazy form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Widget -->
    <div class="widget">

        <!-- Widget heading -->
        <div class="widget-head">
            <h4 class="heading">@lang('idea_steps/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">



                    <div class="form-group">
            {{ Form::label('idea_id', Lang::get('form/title.Idea_id'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'idea_id', Input::old('idea_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label(' workflow_step_id', Lang::get('form/title.Workflow_step_id'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', ' workflow_step_id', Input::old(' workflow_step_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('next_step', Lang::get('form/title.Next_step'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'next_step', Input::old('next_step'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('num_of_steps', Lang::get('form/title.Num_of_steps'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'num_of_steps', Input::old('num_of_steps'), array('class'=>'form-control')) }}
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


            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('idea_steps') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>

        </div>
    </div>
</form>
@stop


