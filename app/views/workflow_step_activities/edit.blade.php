@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('workflow_step_activities/title.edit') ::
@parent
@stop


{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('workflow_step_activities/title.edit')
    <div class="pull-right">
        <a href="{{ route('list/workflow_step_activity', array($workflow_step_activity->workflow_id,$workflow_step_activity->workflow_step_id)) }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
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

            <input type="hidden" name="workflow_id" value="{{ Input::old('workflow_id', $workflow_step_activity->workflow_id) }}" />
            <input type="hidden" name="workflow_step_id" value="{{ Input::old('workflow_step_id',$workflow_step_activity->workflow_step_id) }}" />

            <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <label for="name" class="col-md-2 control-label">@lang('form/title.name')<span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    {{ Form::text('name', Input::old('name',$workflow_step_activity->name), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.name'))) }}
                    {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('description', Lang::get('form/title.description'), array('class'=>'col-md-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::textarea('description', Input::old('description',$workflow_step_activity->description), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.description'))) }}
                </div>
            </div>

            <div class="form-group {{ $errors->first('activity_no', 'has-error') }}">
                <label for="activity_no" class="col-md-2 control-label">@lang('form/title.Activity_no')<span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    {{ Form::input('number', 'activity_no', Input::old('activity_no',$workflow_step_activity->activity_no), array('class'=>'form-control')) }}
                    {{ $errors->first('activity_no', '<span class="help-block">:message</span>') }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('next_activity', Lang::get('form/title.Next_activity'), array('class'=>'col-md-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::select('next_activity[]', $activities , Input::old('next_activity',explode(',',$workflow_step_activity->next_activity)), array('id'=>'next_activity','multiple'=>'multiple','style'=>'width:100%;')) }}
                </div>
            </div>

<!--            <div class="form-group">-->
<!--                {{ Form::label('forms', 'Forms:', array('class'=>'col-md-2 control-label')) }}-->
<!--                <div class="col-sm-10">-->
<!--                    {{ Form::select('forms[]', $forms , Input::old('forms',explode(',',$workflow_step_activity->forms)), array('id'=>'forms', 'multiple'=>'multiple','style'=>'width:100%;')) }}-->
<!--                </div>-->
<!--            </div>-->


            <div class="form-group">
                {{ Form::label('groups', Lang::get('form/title.role'), array('class'=>'col-md-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::select('groups[]', $groups , Input::old('groups',explode(',',$workflow_step_activity->groups)), array('id'=>'groups','multiple'=>'multiple','style'=>'width:100%;')) }}
                </div>
            </div>


            <div class="form-group">
                {{ Form::label('forms', Lang::get('form/title.forms'), array('class'=>'col-md-2 control-label')) }}
                <div class="col-sm-10">
                    <table id="tbl-form-init" class="hidden" style="display:hidden">
                        <tr id="0">
                            <td>
                                {{ Form::select('form_init[0][id]', $forms , Input::old('forms'), array("class"=>"form-id  form-control")) }}
                            </td><td>
                                <input type="text" value="" name="form_init[0][title]" class="form-title  form-control">
                            </td><td>
                                <a class="btn btn-link" onclick="remove_forms_row(this);" href="javascript:;">@lang('workflow_step_activities/title.remove')</a>
                            </td>
                        </tr>
                    </table>
                    <table id="tbl-forms" class="col-sm-12">
                        <thead>
                            <tr>
                                <th class=" col-sm-3">@lang('workflow_step_activities/title.form_name')</th>
                                <th class=" col-sm-3">@lang('workflow_step_activities/title.form_title')</th>
                                <th class=" col-sm-4">@lang('form/title.role')</th>
                                <th class=" col-sm-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;?>
                        @foreach ($selected_forms as $form)
                        <tr id="{{$i}}">
                            <td>
                                {{ Form::select('forms['.$i.'][id]', $forms , Input::old('forms',$form->id), array("class"=>"form-id form-control")) }}
                            </td><td>
                                <input type="text" value="{{{$form->title}}}" name="forms[{{{$i}}}][title]" class="form-title form-control">
                            </td><td>
                                <input name="forms[{{{$i}}}][groups]" class="form-groups form-control" value="{{{isset($form->groups)?$form->groups:''}}}" />
                            </td><td>
                                <a class="btn btn-link" onclick="remove_forms_row(this);" href="javascript:;">@lang('workflow_step_activities/title.remove')</a>
                            </td>
                        </tr>
                        <?php $i++;?>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-sm-12"><a class="btn btn-link" onclick="add_forms_row();" href="javascript:;">@lang('workflow_step_activities/title.add')</a></div>
                </div>
            </div>

            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('workflow_step_activities') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>
        </div>
    </div>
</form>
@stop

@section('body_bottom')
<!--<script data-id="App.Scripts">-->
<!--    $script.ready(['core', 'plugins_dependency', 'plugins'], function() {-->
<!--        $('#next_activity').select2();-->
<!--        $('#forms').select2();-->
<!--    });-->
<!--</script>-->


<script>
    function init_forms_row(){
        var $cln = $("#tbl-form-init > tbody > tr:last");

        return $cln;
    }
    function add_forms_row(){
        var $cln = $("#tbl-forms > tbody > tr:last");

        if(jQuery.isEmptyObject($cln.attr("id"))){
            $cln = init_forms_row();
        }

        var cnt = $cln.attr("id");
        cnt = parseInt(cnt)+1;

        var $new = $cln.clone();
        $new.attr("id",cnt);

        var $new_input = $new.find("select.form-id");
        $new_input.attr("name","forms["+cnt+"][id]");

        $new_input = $new.find("input.form-title");
        $new_input.attr("name","forms["+cnt+"][title]");
        $new_input.val("");

        $new_input = $new.find("input.form-groups");
        $new_input.attr("name","forms["+cnt+"][group]");
        $new_input.val("");

        $("#tbl-forms").append($new);
    }
    function remove_forms_row(t){
        var $tr = $(t).closest('tr');
        $tr.remove();
    }
    $(document).ready(function(){
        $('#next_activity').select2();
        $("#groups").select2();
        //$('#forms').select2();
    });
</script>
@stop