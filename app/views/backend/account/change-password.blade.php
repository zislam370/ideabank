@extends($layout.'/layouts/account')

{{-- Page title --}}
@section('title')
@lang('account/title.changepasswordsubtitle') ::
@parent
@stop

{{-- Account page content --}}
@section('account-content')
<section class="well">
    <h3 class="panel-heading">
        @lang('account/title.changepasswordsubtitle')
    </h3>
    <div class="panel-body">
        <div class=" form">
            <form class="apply-nolazy form-horizontal" role="form" method="post" action="" autocomplete="off">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <!-- Old Password -->
                <div class="form-group {{ $errors->first('old_password', 'has-error') }}">
                    <label for="old_password" class="col-sm-3 control-label">@lang('account/form.oldpassword')<span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="password" id="old_password" name="old_password" class="form-control" placeholder="{{Lang::get('account/form.oldpassword')}}">
                            {{ $errors->first('old_password', '<span class="help-block">:message</span>') }}
                        </div>

                </div>

                <!-- New Password -->
                <div class="form-group {{ $errors->first('password', 'has-error') }}">
                    <label for="password" class="col-sm-3 control-label">@lang('account/form.newpassword')<span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="password" id="password" name="password" class="form-control" placeholder="{{Lang::get('account/form.newpassword')}}">
                            {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                        </div>

                </div>

                <!-- Confirm New Password  -->
                <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                    <label for="password_confirm" class="col-sm-3 control-label">@lang('account/form.confirmpassword')<span class="text-danger">*</span></label>
                    <div class="col-sm-5">
                        <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="{{Lang::get('account/form.confirmpassword')}}">
                        {{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
                    </div>

                </div>

                <hr>

                <!-- Form actions -->
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-default">@lang('button.update')</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@stop
