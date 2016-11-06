@extends($layout.'/layouts/account')

{{-- Page title --}}
@section('title')
@lang('account/title.changeemailsubtitle') ::
@parent
@stop

{{-- Account page content --}}
@section('account-content')
<section class="panel">
    <header class="panel-heading">
        @lang('account/title.editprofile')
        <small>@lang('account/title.changeemailsubtitle')</small>
    </header>
    <div class="panel-body">
        <div class=" form">

<form class="form-horizontal" role="form" method="post" action="" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Form type -->
    <input type="hidden" name="formType" value="change-email" />

    <!-- New Email -->
    <div class="form-group {{ $errors->first('email', 'has-error') }}">
        <label for="email" class="col-sm-3 control-label">@lang('account/form.newemail')</label>
            <div class="col-sm-5">
                <input type="email" id="email" name="email" class="form-control" placeholder="{{Lang::get('account/form.newemail')}}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('email', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <!-- Confirm Email -->
    <div class="form-group {{ $errors->first('email_confirm', 'has-error') }}">
        <label for="email" class="col-sm-3 control-label">@lang('account/form.confirmemail')</label>
            <div class="col-sm-5">
                <input type="email" id="email_confirm" name="email_confirm" class="form-control" placeholder="{{Lang::get('account/form.confirmemail')}}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <!-- Confirm Password -->
    <div class="form-group {{ $errors->first('current_password', 'has-error') }}">
        <label for="email" class="col-sm-3 control-label">@lang('account/form.oldpassword')</label>
            <div class="col-sm-5">
                <input type="password" id="current_password" name="current_password" class="form-control" placeholder="{{Lang::get('account/form.oldpassword')}}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('current_password', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <hr>

    <!-- Form actions -->
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-default">@lang('button.update')</button>

            <a href="{{ route('forgot-password') }}" class="btn btn-link">@lang('button.forgotpassword')</a>
        </div>
    </div>
</form>
        </div>
    </div>
</section>
@stop
