@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('form_richtexts/title.edit') ::
@parent
@stop


{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form_richtexts/title.edit')
    <div class="pull-right">
        <a href="{{ route('show/idea_step_activity',$activity->id) }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back to activity</a>
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
            <h4 class="heading">@lang('form_richtexts/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">
            {{ Form::hidden( 'idea_id', Input::old('idea_id',$activity->idea_id), array('class'=>'form-control')) }}
            {{ Form::hidden( 'step_id', Input::old('step_id',$activity->idea_step_id), array('class'=>'form-control')) }}
            {{ Form::hidden( 'activity_id', Input::old('step_id',$activity->id), array('class'=>'form-control')) }}

        <div class="form-group">
            {{ Form::label('body', 'Content:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('body', Input::old('body',$form_richtext->concept), array('class'=>'ckeditor form-control', 'placeholder'=>'Content')) }}
            </div>
        </div>


            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('form_richtexts') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>
        </div>
    </div>
</form>
@stop