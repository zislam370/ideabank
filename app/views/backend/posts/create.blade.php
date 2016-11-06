@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/posts/title.create') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('admin/posts/title.create')

    <div class="pull-right">
        <a href="{{ route('posts') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
    </div>
</h1>
@stop

{{-- Page content --}}
@section('content')
<div class="widget widget-tabs widget-tabs-double-2 widget-tabs-responsive">

    <!-- Tabs Heading -->
    <div class="widget-head">
        <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">@lang('admin/posts/form.general')</a></li>
            <li><a href="#tab-meta-data" data-toggle="tab">@lang('admin/posts/form.metadata')</a></li>
        </ul>
    </div>
    <!-- // Tabs Heading END -->

    <form autocomplete="off" method="post" action="" class="form-horizontal margin-none"
          enctype="multipart/form-data"
          novalidate="novalidate">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="widget-body innerAll inner-2x">
            <!-- Tabs Content -->
            <div class="tab-content">
                <!-- General tab -->
                <div class="tab-pane active" id="tab-general">
                    <br>

                    <!-- Post Title -->
                    <div class="form-group {{ $errors->first('title', 'has-error') }}">
                        <label for="title" class="col-sm-2 control-label">@lang('admin/posts/form.posttitle')<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" id="title" name="title" class="form-control" placeholder="{{Lang::get('admin/posts/form.posttitle')}}" value="{{{ Input::old('title') }}}">
                            {{ $errors->first('title', '<span class="help-block">:message</span>') }}
                        </div>

                    </div>
<!--                    <div class="form-group {{ $errors->first('source', 'has-error') }}">-->
<!--                        <label for="source" class="col-sm-2 control-label">@lang('form/title.source')<span class="text-danger">*</span></label>-->
<!--                        <div class="col-sm-10">-->
<!--                            <input type="text" id="source" name="source" class="form-control" placeholder="{{Lang::get('form/title.source')}}" value="{{{ Input::old('source') }}}">-->
<!--                            {{ $errors->first('source', '<span class="help-block">:message</span>') }}-->
<!--                        </div>-->
<!---->
<!--                    </div>-->

                    <!-- Post Slug -->
                    <div class="form-group">
                        <label for="slug" class="col-sm-2 control-label">@lang('admin/posts/form.slug')</label>
                        <div class="col-sm-10">
                            <input type="text" id="slug" name="slug" class="form-control" placeholder="{{Lang::get('admin/posts/form.post_slug')}}" value="{{{ Input::old('slug') }}}">
                        </div>

                    </div>

                    <!-- Image Attachment -->
                    <div class="form-group {{ $errors->first('img', 'has-error') }}">
                        <label for="img" class="col-sm-2">@lang('form/title.image')</label>
                        <div class="col-sm-10">
                            {{ Form::file('img', Input::old('img'), array('class'=>'form-control')) }}
                            {{ $errors->first('img', '<span class="help-block">:message</span>') }}
                            <div>@lang('general.all_file_size_type')</div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="form-group {{ $errors->first('short_description', 'has-error') }}">
                        <label for="short_description" class="col-sm-2 control-label">@lang('admin/posts/form.short_description')<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <textarea rows="4" id="short_description" name="short_description" class="form-control">{{{ Input::old('short_description') }}}</textarea>
                            {{ $errors->first('short_description', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="form-group {{ $errors->first('content', 'has-error') }}">
                        <label for="content_" class="col-sm-2 control-label">@lang('admin/posts/form.content')<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <textarea rows="4" id="content_" name="content" class="form-control ckeditor">{{{ Input::old('content') }}}</textarea>
                            {{ $errors->first('content', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>
                </div>
                <!-- Meta Data tab -->
                <div class="tab-pane" id="tab-meta-data">
                    <br>
                    <!-- Meta Title -->
                    <div class="form-group {{ $errors->first('meta_title', 'has-error') }}">
                        <label for="meta_title" class="col-sm-2 control-label">@lang('admin/posts/form.metatitle')</label>
                        <div class="col-sm-9">
                            <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{{ Input::old('meta_title') }}}">
                            {{ $errors->first('meta_title', '<span class="help-block">:message</span>') }}
                        </div>

                    </div>

                    <!-- Meta Description -->
                    <div class="form-group {{ $errors->first('meta_description', 'has-error') }}">
                        <label for="meta_description" class="col-sm-2 control-label">@lang('admin/posts/form.metadescription')</label>
                        <div class="col-sm-9">
                            <input type="text" id="meta_description" name="meta_description" class="form-control" value="{{{ Input::old('meta_description') }}}">
                            {{ $errors->first('meta_description', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>

                    <!-- Meta Keywords -->
                    <div class="form-group {{ $errors->first('meta_keywords', 'has-error') }}">
                        <label for="meta_keywords" class="col-sm-2 control-label">@lang('admin/posts/form.metakeywords')</label>
                        <div class="col-sm-9">
                            <input type="text" id="meta_keywords" name="meta_keywords" class="form-control" value="{{{ Input::old('meta_keywords') }}}">
                            {{ $errors->first('meta_keywords', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>

                </div>
            </div>
            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('posts') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>

        </div>

    </form>
</div>





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
