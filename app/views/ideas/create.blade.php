@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('ideas/title.create') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')

<h1>
    @lang('ideas/title.create')
    <div class="pull-right">
        <a href="{{ route('ideas') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
    </div>
</h1>
@stop

{{-- Page content --}}
@section('content')
<style>
    label{
        display: inline-block;
        font-weight: normal;
        margin-bottom: 5px;
        max-width: 100%;
        width: 27%;
    }
</style>
<form autocomplete="off" method="POST" class="apply-nolazy form-horizontal margin-none" novalidate="novalidate"
       enctype="multipart/form-data">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <!-- Widget -->
    <div class="widget">

        <!-- Widget heading -->
        <div class="widget-head">
            <h4 class="heading">@lang('activity_forms/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->
            <div class="widget-body innerAll inner-2x">
                    <!-- Idea Name -->
                    <div class="form-group {{ $errors->first('name', 'has-error') }}">
                        <label for="name" class="col-sm-4">Name of the Initiative @lang('ideas/form.name') <span style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <input id="idea_name" type="text" name="name" class="form-control" value="{{{Input::old('name')}}}">
                            {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>
                     <!-- Problem Statement -->
                    <div class="form-group {{ $errors->first('prob_stmnt', 'has-error') }}">
                        <label for="prob_stmnt" class="col-sm-4">Problem Statement @lang('ideas/form.prob_stmnt') <span style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <div id="cnt_prob_stmnt"></div>
                            {{ Form::textarea('prob_stmnt', Input::old('prob_stmnt'), array('id'=>'prob_stmnt','class'=>'ckeditor form-control')) }}
                            {{ $errors->first('prob_stmnt', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>
                    <!-- Problem Attachment -->
                    <div class="form-group {{ $errors->first('prob_file', 'has-error') }}">
                        <label for="prob_file" class="col-sm-4">Problem Attachment @lang('ideas/form.prob_file')</label>
                        <div class="col-sm-8">
                            {{ Form::file('prob_file', Input::old('prob_file'), array('class'=>'form-control')) }}
                            {{ $errors->first('prob_file', '<span class="help-block">:message</span>') }}
                            <div>@lang('general.all_file_size_type')</div>
                        </div>
                        <div class="col-sm-5">

                        </div>
                    </div>
                     <!-- Solution Statement -->
                    <div class="form-group {{ $errors->first('sol_stmnt', 'has-error') }}">
                        <label for="sol_stmnt" class="col-sm-4">Solution Statement @lang('ideas/form.sol_stmnt') <span style="color: red">*</span></label>

                        <div class="col-sm-8">
                            <div id="cnt_sol_stmnt"></div>
                            {{ Form::textarea('sol_stmnt', Input::old('sol_stmnt'), array('id'=>'sol_stmnt', 'class'=>'ckeditor form-control')) }}
                            {{ $errors->first('sol_stmnt', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>
                    <!-- Solution Attachment -->
                    <div class="form-group {{ $errors->first('sol_file', 'has-error') }}">
                        <label for="sol_file" class="col-sm-4">Solution Attachment @lang('ideas/form.sol_file')</label>
                        <div class="col-sm-8">
                            {{ Form::file('sol_file', Input::old('sol_file'), array('class'=>'form-control')) }}
                            {{ $errors->first('sol_file', '<span class="help-block">:message</span>') }}
                            <div>@lang('general.all_file_size_type')</div>
                        </div>
                    </div>
                    <!-- Dependecies -->
                    <div class="form-group {{ $errors->first('dependencies', 'has-error') }}">
                        <label for="dependencies" class="col-sm-4">Dependencies @lang('ideas/form.dependencies')</label>
                        <div  class="col-sm-8">
                            <div id="cnt_dependencies"></div>
                            {{ Form::textarea('dependencies', Input::old('dependencies'), array('id'=>'dependencies','class'=>'ckeditor form-control')) }}
                            {{ $errors->first('dependencies', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>
                    <!-- Beneficaries -->
                    <div class="form-group {{ $errors->first('beneficaries', 'has-error') }}">
                        <label for="beneficaries" class="col-sm-4">Beneficiaries @lang('ideas/form.beneficaries')</label>
                        <div class="col-sm-8">
                            <div id="cnt_beneficaries"></div>
                            {{ Form::textarea('beneficaries', Input::old('beneficaries'), array('id'=>'beneficaries','class'=>'ckeditor form-control')) }}
                            {{ $errors->first('beneficaries', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>
                    <!-- Duration -->
                    <div class="form-group {{ $errors->first('duration', 'has-error') }}">
                        <label for="duration" class="col-sm-4">Implementation Time Duration (Month) @lang('ideas/form.duration') <span style="color: red">*</span></label>
                        <div class="col-sm-2">
                            <input id="duration" type="text" onkeypress="return isNumber(event,this)" name="duration" class="form-control" value="{{{Input::old('duration')}}}">
                            {{ $errors->first('duration', '<span class="help-block">:message</span>') }}
                        </div>
                        <div class="col-sm-2">
                            @lang('ideas/form.only_number')
                        </div>
                    </div>
                    <!-- Sectors -->
                    <div class="form-group {{ $errors->first('sectors', 'has-error') }}">
                        <label for="sectors" class="col-sm-4">Sectors @lang('form/title.sector')</label>
                        <div class="col-sm-8">
                            <input name="sectors" id="sectors" style="width: 100%;" value="" />
                            {{ $errors->first('sectors', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>
                    <!-- Area -->
                    <div class="form-group {{ $errors->first('area_id', 'has-error') }}">
                        {{ Form::hidden('area_id', '',array('id'=>'area_id')); }}
                        <label for="area_id" class="col-sm-4">Location @lang('form/title.area')</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input class="form-control" id="area_id_txt" style="width: 100%;" value="" />
                                <div class="input-group-btn btn-group dropup">
                                    <a href="javascript:;" class="btn btn-default" onclick="clearDomainSelection_area_id('#area_id'); return false;"><i class="fa fa-fw icon-delete-symbol"></i></a>
                                </div>
                                <div class="input-group-btn btn-group dropup">
                                    <a href="javascript:;" class="btn btn-default" onclick="OpenModalAreaSel('area_id'); return false;"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            {{ $errors->first('area_id', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>
                    <!-- Office -->
                    <div class="form-group {{ $errors->first('office_id', 'has-error') }}">
                        {{ Form::hidden('office_id', '',array('id'=>'office_id')); }}
                            <label for="office_id" class="col-sm-4">Office @lang('form/title.office')</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input class="form-control" id="office_id_txt" style="width: 100%;" value="" />
                                <div class="input-group-btn btn-group dropup">
                                    <a href="javascript:;" class="btn btn-default" onclick="clearDomainSelection_office_id('#office_id'); return false;"><i class="fa fa-fw icon-delete-symbol"></i></a>
                                </div>
                                <div class="input-group-btn btn-group dropup">
                                    <a href="javascript:;" class="btn btn-default" onclick="OpenModalOfficeSel('office_id'); return false;"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            {{ $errors->first('office_id', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>


                <div class="separator"></div>
                <!-- Form actions -->
                <div class="control-group">
                    <div class="controls">
                        <button name="is_draft" value="0" type="submit" class="btn btn-success">@lang('button.submit')</button>
                        <button name="is_draft" value="1" type="submit" class="btn btn-success">@lang('button.draft_exit')</button>
                        <button name="is_draft" value="2" type="submit" class="btn btn-primary">@lang('button.draft')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@include('partials.area_office_selector')

@stop
@section('body_bottom')
<script src="{{ asset('public_assets/js/domain_selector.js') }}"></script>
@include('partials.area_office_selector_js')
<script>

      function isNumber(evt,t) {
           evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
           if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                  return false;
               }
          console.debug($(t).val().length);
          if($(t).val().length > 10){
              return false;
          }
           return true;
      }
    $(document).ready(function(){

        $("#sectors").select2({tags:[<?php  echo $sectors?>]});

//        $( '.ckeditor' ).ckeditor();
        load_basic_ckeditor('prob_stmnt');
        load_basic_ckeditor('sol_stmnt');
        load_basic_ckeditor('beneficaries');
        load_basic_ckeditor('dependencies');

        // using id and custom settings
        $('#idea_name').jqEasyCounter({
            'maxChars': 300,
            'maxCharsWarning': 300,
            'msgFontSize': '12px',
            'msgFontColor': '#000',
            'msgFontFamily': 'Arial',
            'msgTextAlign': 'left',
            'msgWarningColor': '#F00',
            'msgAppendMethod': 'insertBefore'
        });
        $('#short_desc').jqEasyCounter({
            'maxChars': 300,
            'maxCharsWarning': 300,
            'msgFontSize': '12px',
            'msgFontColor': '#000',
            'msgFontFamily': 'Arial',
            'msgTextAlign': 'left',
            'msgWarningColor': '#F00',
            'msgAppendMethod': 'insertBefore'
        });
        var dependencies = $('#dependencies').ckeditorGet();
        dependencies.on( 'key', function( evt ){
            var editorContent = $(dependencies.getData());
            var plainEditorContent = editorContent.text().trim();
            $("#cnt_dependencies").html("Characters: "+plainEditorContent.length+"/1200");
            if(plainEditorContent.length>1199){
                var k = evt.data.keyCode;
                if (k == 46 || k == 8 || k == 9) {
                    $("#cnt_dependencies").css('color','#000')
                }else{
                    $("#cnt_dependencies").css('color','red')
                    evt.cancel();
                }
            }
        }, dependencies.element.$ );
        dependencies.on( 'focus', function( evt ){
            $("#cnt_dependencies").show();
        }, dependencies.element.$ );
        dependencies.on( 'blur', function( evt ){
            $("#cnt_dependencies").hide();
        }, dependencies.element.$ );

        var beneficaries = $('#beneficaries').ckeditorGet();
        beneficaries.on( 'key', function( evt ){
            var editorContent = $(beneficaries.getData());
            var plainEditorContent = editorContent.text().trim();
            $("#cnt_beneficaries").html("Characters: "+plainEditorContent.length+"/1200");
            if(plainEditorContent.length>1199){
                var k = evt.data.keyCode;
                if (k == 46 || k == 8 || k == 9) {
                    $("#cnt_beneficaries").css('color','#000')
                }else{
                    $("#cnt_beneficaries").css('color','red')
                    evt.cancel();
                }
            }
        }, beneficaries.element.$ );
        beneficaries.on( 'focus', function( evt ){
            $("#cnt_beneficaries").show();
        }, beneficaries.element.$ );
        beneficaries.on( 'blur', function( evt ){
            $("#cnt_beneficaries").hide();
        }, beneficaries.element.$ );

        var prob_stmnt = $('#prob_stmnt').ckeditorGet();
        prob_stmnt.on( 'key', function( evt ){
            var editorContent = $(prob_stmnt.getData());
            var plainEditorContent = editorContent.text().trim();
            $("#cnt_prob_stmnt").html("Characters: "+plainEditorContent.length+"/1500");
            if(plainEditorContent.length>1499){
                var k = evt.data.keyCode;
                if (k == 46 || k == 8 || k == 9) {
                    $("#cnt_prob_stmnt").css('color','#000')
                }else{
                    $("#cnt_prob_stmnt").css('color','red')
                    evt.cancel();
                }
            }
        }, prob_stmnt.element.$ );
        prob_stmnt.on( 'focus', function( evt ){
            $("#cnt_prob_stmnt").show();
        }, prob_stmnt.element.$ );
        prob_stmnt.on( 'blur', function( evt ){
            $("#cnt_prob_stmnt").hide();
        }, prob_stmnt.element.$ );

        var sol_stmnt = $('#sol_stmnt').ckeditorGet();
        sol_stmnt.on( 'key', function( evt ){
            var editorContent = $(sol_stmnt.getData());
            var plainEditorContent = editorContent.text().trim();
            $("#cnt_sol_stmnt").html("Characters: "+plainEditorContent.length+"/1800");
            if(plainEditorContent.length>1799){
                var k = evt.data.keyCode;
                if (k == 46 || k == 8 || k == 9) {
                    // let it happen, don't do anything
                    $("#cnt_sol_stmnt").css('color','#000')
                }else{
                    $("#cnt_sol_stmnt").css('color','red')
                    evt.cancel();
                }
            }
        }, sol_stmnt.element.$ );
        sol_stmnt.on( 'focus', function( evt ){
            $("#cnt_sol_stmnt").show();
        }, sol_stmnt.element.$ );
        sol_stmnt.on( 'blur', function( evt ){
            $("#cnt_sol_stmnt").hide();
        }, sol_stmnt.element.$ );
    });
</script>
@stop

