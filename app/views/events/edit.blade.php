@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('events/title.edit') ::
@parent
@stop


{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('events/title.edit')
    <div class="pull-right">
        <a href="{{ route('events') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
    </div>
</h1>
@stop


{{-- Page content --}}
@section('content')

<form autocomplete="off" method="post" class="form-horizontal margin-none" novalidate="novalidate"
      enctype="multipart/form-data">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Widget -->
    <div class="widget">

        <!-- Widget heading -->
        <div class="widget-head">
            <h4 class="heading">@lang('events/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">

            <!-- Workflow Category -->
            <div class="form-group">
                <label for="workflow_category_id" class="col-sm-2 control-label">@lang('ideas/form.wrokflow_category')</label>
                <div class="col-sm-10">
                    {{ Form::select('workflow_category_id', $workflow_categories , Input::old('workflow_category_id', $event->workflow_category_id), array('class'=>'form-control')) }}
                </div>
            </div>

            <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <label for="name" class="col-md-2 control-label">@lang('events/form.name')<span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    {{ Form::text('name', Input::old('name',$event->name), array('class'=>'form-control', 'placeholder'=>Lang::get('events/form.name'))) }}
                    {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                </div>
            </div>


        <div class="form-group {{ $errors->first('link_title', 'has-error') }}">
            <label for="link_title" class="col-md-2 control-label">@lang('events/form.Link_title')<span class="text-danger">*</span></label>
            <div class="col-sm-10">
              {{ Form::text('link_title', Input::old('link_title',$event->link_title), array('class'=>'form-control', 'placeholder'=>Lang::get('events/form.Link_title'))) }}
                {{ $errors->first('link_title', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <div class="form-group {{ $errors->first('start', 'has-error') }}">
            <label for="start" class="col-md-2 control-label">@lang('events/form.Start')<span class="text-danger">*</span></label>
            <div class="col-sm-10">
              {{ Form::text('start', Input::old('start',date( 'd-m-Y', strtotime( $event->start ))), array('class'=>'datepicker1 form-control', 'placeholder'=>'dd/mm/yyyy')) }}
                {{ $errors->first('start', '<span class="help-block">:message</span>') }}
            </div>
        </div>

        <div class="form-group {{ $errors->first('end', 'has-error') }}">
            <label for="end" class="col-md-2 control-label">@lang('events/form.End')<span class="text-danger">*</span></label>
            <div class="col-sm-10">
              {{ Form::text('end', Input::old('end',date( 'd-m-Y', strtotime( $event->end ))), array('class'=>'datepicker1 form-control', 'placeholder'=>'dd/mm/yyyy')) }}
                {{ $errors->first('end', '<span class="help-block">:message</span>') }}
            </div>
        </div>

            <div class="form-group {{ $errors->first('advert', 'has-error') }}">
                <label for="advert" class="col-md-2 control-label">@lang('events/form.Advert')</label>
                <div class="col-sm-10">
                    {{ Form::textarea('advert', Input::old('advert',$event->advert), array('class'=>'ckeditor form-control', 'placeholder'=>Lang::get('events/form.Advert'))) }}
                    {{ $errors->first('advert', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('priority', Lang::get('form/title.priority'), array('class'=>'col-md-2 control-label')) }}
                <div class="col-sm-10">
                    {{ Form::select('priority', array('1', '2','3','4') , Input::old('priority',$event->priority), array('class'=>'form-control')) }}
                </div>
            </div>
            <!-- Problem Attachment -->
            <div class="form-group {{ $errors->first('attachment', 'has-error') }}">
                <label for="attachment" class="col-sm-2 control-label">@lang('form/title.Attachments')</label>
                <div class="col-sm-10">
                    <div class="">
                        <a href="{{ asset($event->attachment->url('original')) }}">{{ $event->attachment->originalFilename()?$event->attachment->originalFilename():""}}</a>
                    </div>
                    {{ Form::file('attachment', Input::old('attachment'), array('class'=>'form-control')) }}
                    {{ $errors->first('attachment', '<span class="help-block">:message</span>') }}
                </div>
                <div class="col-lg-12 col-lg-offset-2">
                    <label><h5>@lang('form/title.File_Type')gif, jpg,png,pdf,doc,docx,xls,xlsx,ppt,pptx</h5></label>
                </div>

            </div>

            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('events') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>
        </div>
    </div>
</form>
@stop

@section('body_bottom')
<script>
    $(document).ready(function(){
        $( '.ckeditor' ).ckeditor();
    });
</script>
@stop