<div class="col-lg-6" >
    <div class="well bs-component" style="height: 400px">
        <form class="form-horizontal" role="form" method="post" action="{{ route('signin') }}">

            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <fieldset>
                <h2 align="center" class="form-signin-heading">@lang('account/title.signin')</h2>

                <div class="form-group {{ $errors->first('general', 'has-error') }}">
                    <div class="col-lg-12">
                        {{ $errors->first('general', '<label for="general" class="control-label">:message</label>') }}
                    </div>
                </div>
                <div class="form-group {{ $errors->first('mobile', 'has-error') }}">
                    <label class="col-lg-3 control-label" for="inputEmail">@lang('account/title.Mobile') <span style="color: red">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" id="mobile" name="mobile" placeholder="0177000000" class="form-control" value="{{ Input::old('mobile') }}" autofocus>
                        {{ $errors->first('mobile', '<label for="mobile" class="control-label">:message</label>') }}
                    </div>
                </div>

                <div class="form-group {{ $errors->first('password', 'has-error') }}">
                    <label class="col-lg-3 control-label" for="inputPassword">@lang('account/title.Password') <span style="color: red">*</span></label>
                    <div class="col-lg-9">
                        <input type="password" name="password" placeholder="{{Lang::get('account/title.Password')}}" id="inputPassword" class="form-control">
                        {{ $errors->first('password', '<label for="inputError" class="control-label">:message</label>') }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label" for="inputPassword"></label>
                    <div class="col-lg-10">
<!--                        <div class="checkbox">-->
<!--                            <label>-->
<!--                                <input type="checkbox" name="remember-me" id="remember-me" value="1" /> @lang('button.rememberme')-->
<!--                            </label>-->
<!--                        </div>-->
                        <a href="{{ route('forgot-password') }}" class="btn btn-link">@lang('button.forgotpassword')</a>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button class="btn btn-info" type="submit">@lang('button.signin')</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<div class="col-lg-6">
    <div class="well bs-component" style="height: 400px;line-height: 400px;text-align: center;">
        <span style="display: inline-block;line-height: normal;">
        @lang('account/title.registration_msg')
            </span>
    </div>
</div>

