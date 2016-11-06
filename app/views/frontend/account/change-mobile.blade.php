@extends($layout.'/layouts/account')

{{-- Page title --}}
@section('title')
@lang('account/title.changemobilesubtitle') ::
@parent
@stop

{{-- Account page content --}}
@section('account-content')
<section class="well">
    <h3>
        @lang('account/title.changemobilesubtitle')
    </h3>
    <div class="panel-body">
        <div class=" form">

<form class="form-horizontal" role="form" method="post" action="" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Form type -->
    <input type="hidden" name="formType" value="change-mobile" />

    <!-- New Mobile -->
    <div class="form-group {{ $errors->first('mobile', 'has-error') }}">
        <label for="mobile" class="col-sm-3 control-label">@lang('account/form.newmobile')<span class="text-danger">*</span></label>
            <div class="col-sm-5">
                <input type="mobile" id="mobile" name="mobile" class="form-control" placeholder="{{Lang::get('account/form.newmobile')}}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('mobile', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <!-- Confirm Mobile -->
    <div class="form-group {{ $errors->first('mobile_confirm', 'has-error') }}">
        <label for="mobile_confirm" class="col-sm-3 control-label">@lang('account/form.confirmmobile')<span class="text-danger">*</span></label>
            <div class="col-sm-5">
                <input type="mobile_confirm" id="moblie_confirm" name="mobile_confirm" class="form-control" placeholder="{{Lang::get('account/form.confirmmobile')}}">
            </div>
            <div class="col-sm-4">
                {{ $errors->first('mobile_confirm', '<span class="help-block">:message</span>') }}
            </div>
    </div>

    <!-- Confirm Password -->
    <div class="form-group {{ $errors->first('current_password', 'has-error') }}">
        <label for="email" class="col-sm-3 control-label">@lang('account/form.oldpassword')<span class="text-danger">*</span></label>
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
        </div>
    </div>
</form>
        </div>
    </div>
</section>
@stop
