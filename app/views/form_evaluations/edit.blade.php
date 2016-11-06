@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('form_evaluations/title.edit') ::
@parent
@stop


{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form_evaluations/title.edit')
    <div class="pull-right">
        <a href="{{ route('form_evaluations') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
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
            <h4 class="heading">@lang('form_evaluations/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">

                    <div class="form-group">
            {{ Form::label('task', 'Task:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('task', Input::old('task'), array('class'=>'form-control', 'placeholder'=>'Task')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('due_date', 'Due_date:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('due_date', Input::old('due_date'), array('class'=>'form-control', 'placeholder'=>'Due_date')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('target', 'Target:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('target', Input::old('target'), array('class'=>'form-control', 'placeholder'=>'Target')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('achieved', 'Achieved:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('achieved', Input::old('achieved'), array('class'=>'form-control', 'placeholder'=>'Achieved')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('remark', 'Remark:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('remark', Input::old('remark'), array('class'=>'form-control', 'placeholder'=>'Remark')) }}
            </div>
        </div>


            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('form_evaluations') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>
        </div>
    </div>
</form>
@stop