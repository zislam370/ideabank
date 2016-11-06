@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
@lang('account/title.Create_Idea') ::
@parent
@stop

{{-- Account content --}}
@section('account-content')
<form action="{{ route('update/idea',$idea->id) }}" autocomplete="off" method="POST" class="apply-nolazy form-horizontal margin-none" novalidate="novalidate"
       enctype="multipart/form-data">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <!-- Widget -->
    <div class="well">

        <!-- Widget heading -->
        <div class="widget-head">
            <h4 class="heading">@lang('ideas/title.edit')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">

                <!-- Idea Name -->
                <div class="form-group {{ $errors->first('name', 'has-error') }}">
                    <label for="name" class="col-sm-3 control-label">@lang('ideas/form.name')</label>

                    <div class="col-sm-5">
                        <input id="idea_name" type="text" name="name" placeholder="{{{Lang::get('ideas/form.name')}}}" class="form-control" value="{{{Input::old('name',$idea->name)}}}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                    </div>
                </div>

                <!-- Short Description -->
                <div class="form-group {{ $errors->first('short_desc', 'has-error') }}">
                    <label for="short_desc" class="col-sm-3 control-label">@lang('ideas/form.short_desc')</label>
                    <div class="col-sm-5">
                        <input id="short_desc" type="text" name="short_desc" placeholder="{{{Lang::get('ideas/form.short_desc')}}}" class="form-control" value="{{{Input::old('short_desc',$idea->short_desc)}}}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('short_desc', '<span class="help-block">:message</span>') }}
                    </div>
                </div>



            <!-- Dependecies -->
            <div class="form-group {{ $errors->first('dependencies', 'has-error') }}">
                <label for="dependencies" class="col-sm-3 control-label">@lang('ideas/form.dependencies')</label>
                <div class="col-sm-5">
                    <div id="cnt_dependencies"></div>
                    {{ Form::textarea('dependencies', Input::old('dependencies',$idea->dependencies), array('id'=>'dependencies','class'=>'ckeditor form-control')) }}
                </div>
                <div class="col-sm-4">
                    {{ $errors->first('dependencies', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <!-- Beneficaries -->
            <div class="form-group {{ $errors->first('beneficaries', 'has-error') }}">
                <label for="beneficaries" class="col-sm-3 control-label">@lang('ideas/form.beneficaries')</label>
                <div class="col-sm-5">
                    <div id="cnt_beneficaries"></div>
                    {{ Form::textarea('beneficaries', Input::old('beneficaries',$idea->beneficaries), array('id'=>'beneficaries','class'=>'ckeditor form-control')) }}
                </div>
                <div class="col-sm-4">
                    {{ $errors->first('beneficaries', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <!-- Duration -->
            <div class="form-group {{ $errors->first('duration', 'has-error') }}">
                <label for="duration" class="col-sm-3 control-label">@lang('ideas/form.duration')</label>
                <div class="col-sm-5">
                    <input id="duration" type="text" name="duration" placeholder="{{{Lang::get('ideas/form.duration')}}}" class="form-control" value="{{{Input::old('duration',$idea->duration)}}}">
                </div>
                <div class="col-sm-4">
                    {{ $errors->first('duration', '<span class="help-block">:message</span>') }}
                </div>
            </div>
                <!-- Problem Statement -->
                <div class="form-group {{ $errors->first('prob_stmnt', 'has-error') }}">
                    <label for="prob_stmnt" class="col-sm-3 control-label">@lang('ideas/form.prob_stmnt')</label>
                    <div class="col-sm-5">
                        {{ Form::textarea('prob_stmnt', Input::old('prob_stmnt', $idea->prob_stmnt), array('class'=>'ckeditor form-control')) }}
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('prob_stmnt', '<span class="help-block">:message</span>') }}
                    </div>
                </div>


                <!-- Problem Attachment -->
                <div class="form-group {{ $errors->first('prob_file', 'has-error') }}">
                    <label for="prob_file" class="col-sm-3 control-label">@lang('ideas/form.prob_file')</label>
                    <div class="col-sm-5">
                        <div class="">
                            <a href="{{ asset($idea->prob_file->url('original')) }}">{{ $idea->prob_file->originalFilename()?"Download":""}}</a>
                        </div>

                        {{ Form::file('prob_file', Input::old('prob_file'), array('class'=>'form-control')) }}
                        <div>@lang('general.all_file_size_type')</div>
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('prob_file', '<span class="help-block">:message</span>') }}
                    </div>
                </div>

                <!-- Solution Statement -->
                <div class="form-group {{ $errors->first('sol_stmnt', 'has-error') }}">
                    <label for="sol_stmnt" class="col-sm-3 control-label">@lang('ideas/form.sol_stmnt')</label>
                    <div class="col-sm-5">
                        {{ Form::textarea('sol_stmnt', Input::old('sol_stmnt', $idea->sol_stmnt), array('class'=>'ckeditor form-control')) }}
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('sol_stmnt', '<span class="help-block">:message</span>') }}
                    </div>
                </div>

                <!-- Solution Attachment -->
                <div class="form-group {{ $errors->first('sol_file', 'has-error') }}">
                    <label for="sol_file" class="col-sm-3 control-label">@lang('ideas/form.sol_file')</label>
                    <div class="col-sm-5">
                        <div class="">
                            <a href="{{ asset($idea->sol_file->url('original')) }}">{{ $idea->sol_file->originalFilename()?"Download":""}}</a>
                        </div>

                        {{ Form::file('sol_file', Input::old('sol_file'), array('class'=>'form-control')) }}
                        <div>@lang('general.all_file_size_type')</div>
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('sol_file', '<span class="help-block">:message</span>') }}
                    </div>
                </div>

            <div class="form-group {{ $errors->first('sectors', 'has-error') }}">
                <label for="sectors" class="col-md-3 control-label">@lang('form/title.sectors')</label>
                <div class="col-sm-5">
                    <input name="sectors" id="sectors" style="width: 100%;" value="{{ $idea->sectors}}" />
                </div>
                <div class="col-sm-4">
                    {{ $errors->first('sectors', '<span class="help-block">:message</span>') }}
                </div>
            </div>

<!--                <div class="form-group">-->
<!--                    {{ Form::label('attachments', 'Attachments:', array('class'=>'col-md-2 control-label')) }}-->
<!--                    <div class="col-sm-10">-->
<!--                      {{ Form::textarea('attachments', Input::old('attachments'), array('class'=>'form-control', 'placeholder'=>'Attachments')) }}-->
<!--                    </div>-->
<!--                </div>-->


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
</form>
@stop

@section('page_scripts')
<script>
    $(document).ready(function(){
        $("#sectors").select2({tags:[<?php  echo $sectors?>]});
        $( '.ckeditor' ).ckeditor();
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
