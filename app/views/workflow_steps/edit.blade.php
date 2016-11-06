@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('workflow_steps/title.edit') ::
@parent
@stop


{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('workflow_steps/title.edit')
    <div class="pull-right">
        <a href="{{ route('list/workflow_step', $workflow_step->workflow_id) }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
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
            <h4 class="heading">@lang('workflow_step_activities/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">

            <input type="hidden" name="workflow_id" value="{{ Input::old('workflow_id', $workflow_step->workflow_id) }}" />


            <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <label for="name" class="col-md-2 control-label">@lang('form/title.name')<span class="text-danger">*</span></label>
                <div class="col-sm-10">
                  {{ Form::text('name', Input::old('name', $workflow_step->name), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.name'))) }}
                    {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('description', Lang::get('form/title.description'), array('class'=>'col-md-2 control-label')) }}
                <div class="col-sm-10">
                  {{ Form::textarea('description', Input::old('description', $workflow_step->description), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.description'))) }}
                </div>
            </div>

            <div class="form-group {{ $errors->first('step_no', 'has-error') }}">
                <label for="step_no" class="col-md-2 control-label">@lang('form/title.Step No')<span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    {{ Form::input('number', 'step_no', Input::old('step_no', $workflow_step->step_no), array('class'=>'form-control')) }}
                    {{ $errors->first('step_no', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <div class="form-group">
                <label for="next_step" class="col-md-2 control-label">@lang('form/title.Next_step')</label>
                <div class="col-sm-10">
                    {{ Form::select('next_step[]', $steps , Input::old('next_step', explode(',',$workflow_step->next_step)), array('id'=>'next_step','multiple'=>'multiple','style'=>'width:100%;')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('groups', Lang::get('form/title.role'), array('class'=>'col-md-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::select('groups[]', $groups , Input::old('groups',explode(',',$workflow_step->groups)), array('id'=>'groups','multiple'=>'multiple','style'=>'width:100%;')) }}
                </div>
            </div>



            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('workflow_steps') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>
        </div>
    </div>
</form>
@stop

@section('body_bottom')
<script>
    $(function(){
        $('#next_step').select2();
        $("#groups").select2();
    });
</script>
@stop