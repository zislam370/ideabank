@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('media/title.edit') ::
@parent
@stop


{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('media/title.edit')
    <div class="pull-right">
        <a href="{{ route('media') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
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
            <h4 class="heading">@lang('media/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">

                    <div class="form-group">
            {{ Form::label('title', Lang::get('form/title.Title'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('title', Input::old('title'), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.Title'))) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('body', Lang::get('form/title.Body'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('body', Input::old('body'), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.Body'))) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('publish', Lang::get('form/title.Publish'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::checkbox('publish') }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('user_id', Lang::get('form/title.User_id'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'user_id', Input::old('user_id'), array('class'=>'form-control')) }}
            </div>
        </div>


            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('media') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>
        </div>
    </div>
</form>
@stop