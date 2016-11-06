@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('account/form.Forgot_Password') ::
@parent
@stop

{{-- Page content --}}
@section('content')
@include('frontend/notifications')
<div class="container">
    <div id="content">
<div class="page-header well">
    <h3>@lang('account/form.Forgot_Password')</h3>
</div>
<form method="post" action="" class="form-horizontal well">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- New Password -->
    <div class="control-group{{ $errors->first('password', ' error') }}">
        <label class="control-label" for="password">@lang('account/form.newpassword')</label>
        <div class="controls">
            <input type="password" name="password" id="password" placeholder="{{Lang::get('account/form.newpassword')}}"  value="{{ Input::old('password') }}" />
        </div>
            <div class="col-sm-4">
            {{ $errors->first('password', '<span class="help-block">:message</span>') }}
        </div>
    </div>

    <!-- Password Confirm -->
    <div class="control-group{{ $errors->first('password_confirm', ' error') }}">
        <label class="control-label" for="password_confirm">@lang('account/form.Password_Confirmation')</label>
        <div class="controls">
            <input type="password" name="password_confirm" id="password_confirm" placeholder="{{Lang::get('account/form.Password_Confirmation')}}"   value="{{ Input::old('password_confirm') }}" />
        </div>
        <div class="col-sm-4">
            {{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
        </div>
    </div>

    <!-- Form actions -->
    <div class="control-group">
        <div class="controls">
            <a class="btn" href="{{ route('home') }}">@lang('button.cancel')</a>

            <button type="submit" class="btn btn-info">@lang('button.submit')</button>
        </div>
    </div>
</form>
</div>
</div>
@stop
