@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/posts/title.edit') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('admin/posts/title.edit')

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
                            <input type="text" id="title" name="title" class="form-control" value="{{{ Input::old('title', $post->title) }}}">
                            {{ $errors->first('title', '<span class="help-block">:message</span>') }}
                        </div>

                    </div>

                    <!-- Post Slug -->
                    <div class="form-group">
                        <label for="slug" class="col-sm-2 control-label">@lang('admin/posts/form.slug')</label>
                        <div class="col-sm-10">
                            <input type="text" id="slug" name="slug" class="form-control" value="{{{ Input::old('slug', $post->slug) }}}">
                        </div>

                    </div>

                    <!-- Image Attachment -->
                    <div class="form-group {{ $errors->first('img', 'has-error') }}">
                        <label for="img" class="col-sm-2">@lang('form/title.image')</label>
                        <div class="col-sm-10">
                            <div data-provides="fileupload" class="fileupload fileupload-new">
                                <div class="fileupload-new thumbnail">
                                    <img src="{{ asset($post->img->url('original')) }}">
                                </div>
                                <div>
                                    {{ Form::file('img', Input::old('img'), array('class'=>'form-control')) }}
                                </div>
                                <div><label><h5>@lang('form/title.File_Type')gif, jpg,png,pdf,doc,docx,xls,xlsx,ppt,pptx</h5></label></div>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->

                    <div class="form-group {{ $errors->first('short_description', 'has-error') }}">
                            <label for="short_description" class="col-sm-2 control-label">@lang('admin/posts/form.short_description')<span class="text-danger">*</span></label>
                            <div class="col-sm-10">

                            <textarea rows="4" id="short_description" name="short_description" class="form-control">{{{ Input::old('short_description', $post->short_description) }}}</textarea>
                            {{ $errors->first('short_description', '<span class="help-block">:message</span>') }}
                            </div>
                    </div>

                    <div class="form-group {{ $errors->first('content', 'has-error') }}">
                            <label for="content_" class="col-sm-2 control-label">@lang('admin/posts/form.content')<span class="text-danger">*</span></label>
                            <div class="col-sm-10">

                            <textarea rows="4" id="content_" name="content" class="form-control ckeditor">{{{ Input::old('content', $post->content) }}}</textarea>
                            {{ $errors->first('content', '<span class="help-block">:message</span>') }}
                            </div>
                    </div>

                </div>

                <!-- Meta Data tab -->
                <div class="tab-pane" id="tab-meta-data">
                    <br>
                    <!-- Meta Title -->
                    <div class="form-group {{ $errors->first('meta_title', 'has-error') }}">
                        <label for="meta_title" class="col-sm-3 control-label">@lang('admin/posts/form.metatitle')</label>
                        <div class="col-sm-9">
                            <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{{ Input::old('meta_title', $post->meta_title) }}}">
                            {{ $errors->first('meta_title', '<span class="help-block">:message</span>') }}
                        </div>

                    </div>

                    <!-- Meta Description -->
                    <div class="form-group {{ $errors->first('meta_description', 'has-error') }}">
                        <label for="meta_description" class="col-sm-3 control-label">@lang('admin/posts/form.metadescription')</label>
                        <div class="col-sm-9">
                            <input type="text" id="meta_description" name="meta_description" class="form-control" value="{{{ Input::old('meta_description', $post->meta_description) }}}">
                            {{ $errors->first('meta_description', '<span class="help-block">:message</span>') }}
                        </div>

                    </div>

                    <!-- Meta Keywords -->
                    <div class="form-group {{ $errors->first('meta_keywords', 'has-error') }}">
                        <label for="meta_keywords" class="col-sm-3 control-label">@lang('admin/posts/form.metakeywords')</label>
                        <div class="col-sm-9">
                            <input type="text" id="meta_keywords" name="meta_keywords" class="form-control" value="{{{ Input::old('meta_keywords', $post->meta_keywords) }}}">
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
            filebrowserUploadUrl : '{{URL::action("Ck_fileController@postUpload")}}?csrf_token='+csrf
        });
    });
</script>
@stop
