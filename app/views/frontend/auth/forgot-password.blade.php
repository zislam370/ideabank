@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('account/title.forgotpassword') ::
@parent
@stop

{{-- Page content --}}
@section('content')
@include('frontend/notifications')
<div class="container">
    <div id="content">
        <div class="page-header well">
            <h3>@lang('account/title.forgotpassword')</h3>
        </div>
        <form method="post" action="" class="form-horizontal well">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <!-- Email -->
            <div class="form-group {{ $errors->first('mobile', 'has-error') }}">
                    <label for="mobile" class="col-sm-2 control-label">@lang('account/form.mobile')</label>
                    <div class="col-sm-4">
                        <input type="mobile" class="form-control" name="mobile" id="mobile" placeholder="{{Lang::get('account/form.mobile')}}"   value="{{ Input::old('mobile') }}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('mobile', '<span class="help-block">:message</span>') }}
                    </div>
                </div>

            <!-- Form actions -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a class="btn btn-default" href="{{ route('signin') }}">@lang('button.cancel')</a>
                  <button type="submit" class="btn btn-info">@lang('button.submit')</button>
                </div>
            </div>

        </form>
    </div>
</div>
@stop
