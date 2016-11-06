@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Create a Form_lookup_datum ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form_lookup_data/title.create')

    <div class="pull-right">
        <a href="{{ route('form_lookup_data') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
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
            <h4 class="heading">@lang('form_lookup_data/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">



                    <div class="form-group">
            {{ Form::label('form_lookup_id', Lang::get('form/title.Form_Field'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::select('form_lookup_id', $form_lookups , Input::old('form_lookup_id')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->first('name', 'has-error') }}">
            <label for="name" class="col-md-2 control-label">@lang('form/title.name')<span class="text-danger">*</span></label>
            <div class="col-sm-10">
              {{ Form::text('name', Input::old('name'), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.name'))) }}
                {{ $errors->first('name', '<span class="help-block">:message</span>') }}
            </div>
        </div>


            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('form_lookup_data') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>

        </div>
    </div>
</form>
@stop


