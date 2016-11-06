@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Create a Front_banner ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('front_banners/title.create')

    <div class="pull-right">
        <a href="{{ route('front_banners') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
    </div>
</h1>
@stop


{{-- Page content --}}
@section('content')

<form autocomplete="off" method="post" class="form-horizontal margin-none" novalidate="novalidate" enctype="multipart/form-data">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Widget -->
    <div class="widget">

        <!-- Widget heading -->
        <div class="widget-head">
            <h4 class="heading">@lang('front_banners/title.create.sub')</h4>
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
                {{ Form::label('slide_title', Lang::get('form/title.slide_title'), array('class'=>'col-md-2 control-label')) }}
                <div class="col-sm-10">
                  {{ Form::input('text', 'slide_title', Input::old('slide_title'), array('class'=>'form-control')) }}
                </div>
            </div>
             <div class="form-group {{ $errors->first('img', 'has-error') }}">

                 {{ Form::label('img', Lang::get('form/title.img'), array('class'=>'col-md-2 control-label')) }}
                 <div class="col-sm-10">
                     {{ Form::file('img', Input::old('img'), array('class'=>'form-control')) }}
                     {{ $errors->first('img', '<span class="help-block">:message</span>') }}
                 </div>
             </div>


            <!--
             <div class="form-group">
                {{ Form::label('is_btn', Lang::get('form/title.is_btn'), array('class'=>'col-md-2 control-label')) }}
                <div class="col-sm-10">
                  {{ Form::checkbox('is_btn',Input::old('is_btn'), false) }}
                </div>

            </div>
            <div class="form-group">
                {{ Form::label('btn_title', Lang::get('form/title.btn_title'), array('class'=>'col-md-2 control-label')) }}
                <div class="col-sm-10">
                  {{ Form::input('text', 'btn_title', Input::old('btn_title'), array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('url', Lang::get('form/title.url'), array('class'=>'col-md-2 control-label')) }}
                <div class="col-sm-10">
                  {{ Form::input('text', 'url', Input::old('url'), array('class'=>'form-control')) }}
                </div>
            </div>

-->


            

            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('front_banners') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>

        </div>
    </div>
</form>
@stop


