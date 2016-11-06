@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Create a Form_visit ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form_visits/title.create')

    <div class="pull-right">
        <a href="{{ route('form_visits') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
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
            <h4 class="heading">@lang('form_visits/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">



                    <div class="form-group">
            {{ Form::label('location', 'Location:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('location', Input::old('location'), array('class'=>'form-control', 'placeholder'=>'Location')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('purpose', 'Purpose:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('purpose', Input::old('purpose'), array('class'=>'form-control', 'placeholder'=>'Purpose')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('start', 'Start:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('start', Input::old('start'), array('class'=>'form-control', 'placeholder'=>'Start')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('end', 'End:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('end', Input::old('end'), array('class'=>'form-control', 'placeholder'=>'End')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('outcome', 'Outcome:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('outcome', Input::old('outcome'), array('class'=>'form-control', 'placeholder'=>'Outcome')) }}
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
                <a class="btn btn-link" href="{{ route('form_visits') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>

        </div>
    </div>
</form>
@stop


