@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('announcements/title.Create_Announcement') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('announcements/title.create')

    <div class="pull-right">
        <a href="{{ route('announcements') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
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
            <h4 class="heading">@lang('announcements/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

    <div class="widget-body innerAll inner-2x">

       <div class="form-group">
           {{ Form::label('title', Lang::get('form/title.title'), array('class'=>'col-md-2 control-label')) }}
           <div class="col-sm-10">
             {{ Form::input('text', 'title', Input::old('title'), array('class'=>'form-control')) }}
           </div>
       </div>
        <div class="form-group">
            {{ Form::label('body', Lang::get('form/title.Body'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('body', Input::old('body'), array('id'=>'ck_body', 'class'=>'form-control ckeditor', 'placeholder'=>Lang::get('form/title.Body'))) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('publish', Lang::get('form/title.Publish'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::checkbox('publish') }}
            </div>
        </div>
            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('announcements') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>

    </div>
  </div>
</form>
<script>

    $(document).ready(function(){
        $( '#ck_body' ).ckeditor();
        var editor = $('#ck_body').ckeditorGet();
        editor.on( 'key', function( evt ){

                    //evt.preventDefault();
                    //console.debug(evt.editor.getData());
                    var editorContent = $(editor.getData());
                                    var plainEditorContent = editorContent.text().trim();
                                    //console.log(plainEditorContent);
                                    console.log("Length: "+plainEditorContent.length);
                    if(plainEditorContent.length>10){
                        evt.cancel();
                    }
                }, editor.element.$ );

    });
</script>
@stop



