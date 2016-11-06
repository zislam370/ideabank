@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('pages/title.edit') ::
@parent
@stop


{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('pages/title.edit')
    <div class="pull-right">
        <a href="{{ route('pages') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
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
            <h4 class="heading">@lang('pages/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">

            <div class="form-group {{ $errors->first('slug', 'has-error') }}">
                <label for="slug" class="col-md-2 control-label">@lang('form/title.slug')<span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    {{ Form::text('slug', Input::old('slug',$page->slug), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.slug'))) }}
                    {{ $errors->first('slug', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <div class="form-group {{ $errors->first('title', 'has-error') }}">
                <label for="title" class="col-md-2 control-label">@lang('form/title.title')<span class="text-danger">*</span></label>
                <div class="col-sm-10">
                  {{ Form::text('title', Input::old('title',$page->title), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.title'))) }}
                    {{ $errors->first('title', '<span class="help-block">:message</span>') }}
                </div>

            </div>
        <div class="form-group {{ $errors->first('body', 'has-error') }}">
            <label for="body" class="col-md-2 control-label">@lang('form/title.Body')<span class="text-danger">*</span></label>
            <div class="col-sm-10">
                {{ Form::textarea('body', Input::old('body',$page->body), array('class'=>'ckeditor form-control', 'placeholder'=>Lang::get('form/title.Body'))) }}
                {{ $errors->first('body', '<span class="help-block">:message</span>') }}
            </div>
        </div>
        <div class="form-group {{ $errors->first('meta_title', 'has-error') }}">
            <label for="meta_title" class="col-sm-2 control-label">@lang('admin/posts/form.metatitle')</label>
            <div class="col-sm-10">
                <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{{ Input::old('meta_title',$page->meta_title) }}}">
                {{ $errors->first('meta_title', '<span class="help-block">:message</span>') }}
            </div>

        </div>

        <!-- Meta Description -->
        <div class="form-group {{ $errors->first('meta_description', 'has-error') }}">
            <label for="meta_description" class="col-sm-2 control-label">@lang('admin/posts/form.metadescription')</label>
            <div class="col-sm-10">
                <input type="text" id="meta_description" name="meta_description" class="form-control" value="{{{ Input::old('meta_description',$page->meta_description) }}}">
                {{ $errors->first('meta_description', '<span class="help-block">:message</span>') }}
            </div>

        </div>

        <!-- Meta Keywords -->
        <div class="form-group {{ $errors->first('meta_keywords', 'has-error') }}">
            <label for="meta_keywords" class="col-sm-2 control-label">@lang('admin/posts/form.metakeywords')</label>
            <div class="col-sm-10">
                <input type="text" id="meta_keywords" name="meta_keywords" class="form-control" value="{{{ Input::old('meta_keywords',$page->meta_keywords) }}}">
                {{ $errors->first('meta_keywords', '<span class="help-block">:message</span>') }}
            </div>
        </div>


            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('pages') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>
        </div>
    </div>
</form>
@stop

@section('body_bottom')
<script>
    $(function () {
        var csrf = '{{csrf_token()}}' ;
        $( '.ckeditor' ).ckeditor({
            filebrowserUploadUrl : '{{ route("upload_image") }}?csrf_token='+csrf
        });
    });
</script>
@stop