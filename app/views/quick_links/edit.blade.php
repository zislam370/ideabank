@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('quick_links/title.edit') ::
@parent
@stop


{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('quick_links/title.edit')
    <div class="pull-right">
        <a href="{{ route('quick_links') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
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
            <h4 class="heading">@lang('quick_links/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">

                    <div class="form-group {{ $errors->first('title', 'has-error') }}">
                        <label for="title" class="col-md-2 control-label">@lang('form/title.title')<span class="text-danger">*</span></label>
            <div class="col-sm-10">
              {{ Form::text('title', Input::old('title',$quick_link->title), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.title'))) }}
                {{ $errors->first('title', '<span class="help-block">:message</span>') }}
            </div>

        </div>

            <div class="form-group {{ $errors->first('link', 'has-error') }}">
            <label for="link" class="col-md-2 control-label">@lang('form/title.link')<span class="text-danger">*</span></label>
            <div class="col-sm-10">
              {{ Form::text('link', Input::old('link',$quick_link->link), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.link'))) }}
                {{ $errors->first('link', '<span class="help-block">:message</span>') }}
            </div>

        </div>


            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('quick_links') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>
        </div>
    </div>
</form>
@stop