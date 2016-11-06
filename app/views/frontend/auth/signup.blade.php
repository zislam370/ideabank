@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('account/title.signup') ::
@parent
@stop

{{-- Page content --}}
@section('content')
@include('frontend/notifications')
<br/>
<div class="col-lg-12">
    <div class="well bs-component">
        <h2 align="left" class="form-signin-heading">@lang('account/title.signup')</h2>
    <form class="form-horizontal" style="margin: 0px auto;" method="post" action="{{ route('signup') }}" class="form-horizontal" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />


        <div class="login-wrap">
<!--            <p align="center">@lang('account/title.Enter_your_personal_details_below')</p>-->
            <p align="center"></p>
              <div class="form-group">
                 <label class="col-lg-2 control-label" for="first_name">@lang('account/form.type')</label>
                 <div class="col-lg-6">
                    {{Form::select('user_type', array('Individual'=>'বাক্তি', 'Organization'=>'প্রতিষ্ঠান'),Input::old('user_type'), array('id'=>'user_type','class'=>'form-control'));}}

                 </div>
             </div>

            <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                <label class="col-lg-2 control-label" for="first_name">@lang('form/title.name') <span style="color: red">*</span></label>
                <div class="col-lg-6">
                    <input type="text" name="first_name" id="first_name" placeholder="{{Lang::get('form/title.name')}}" class="form-control" value="{{ Input::old('first_name') }}" autofocus>
                    {{ $errors->first('first_name', '<label for="first_name" class="control-label">:message</label>') }}
                </div>
            </div>

            <div class="form-group">
                 <label class="col-lg-2 control-label" for="gender">@lang('form/title.gender')</label>
                 <div class="col-lg-6">
                    {{Form::select('gender', array('Male'=>'পুরুষ', 'Female'=>'মহিলা'),Input::old('gender'), array('id'=>'gender','class'=>'form-control'));}}
                 </div>
             </div>

<!--             <div class="form-group {{ $errors->first('birthyear', 'has-error') }}">-->
<!--                 <label class="col-lg-2 control-label" for="birthyear">@lang('form/title.birthyear')</label>-->
<!--                 <div class="col-lg-6">-->
<!--                     {{Form::selectYear('birthyear',2010, 1950,Input::old('birthyear'), array('id'=>'birthyear','class'=>'form-control'));}}-->
<!--                     {{ $errors->first('birthyear', '<label for="birthyear" class="control-label">:message</label>') }}-->
<!--                 </div>-->
<!--             </div>-->

            <div class="form-group {{ $errors->first('mobile', 'has-error') }}">
                <label class="col-lg-2 control-label" for="mobile">@lang('account/form.mobile') <span style="color: red">*</span></label>
                <div class="col-lg-6">
                    <input type="text" id="mobile"name="mobile" placeholder="01770000000" class="form-control" value="{{ Input::old('mobile') }}" autofocus>
                    {{ $errors->first('mobile', '<label for="mobile" class="control-label">:message</label>') }}
                </div>
            </div>
            <div class="form-group {{ $errors->first('email', 'has-error') }}">
                <label class="col-lg-2 control-label" for="email">@lang('account/form.email')</label>
                <div class="col-lg-6">
                    <input type="text" id="email"name="email" placeholder="email@domain.com" class="form-control" value="{{ Input::old('email') }}" autofocus>
                    {{ $errors->first('email', '<label for="email" class="control-label">:message</label>') }}
                </div>
            </div>
            <div class="form-group {{ $errors->first('password', 'has-error') }}">
                <label class="col-lg-2 control-label" for="password">@lang('account/form.password') <span style="color: red">*</span></label>
                <div class="col-lg-6">
                    <input type="password" id="password"name="password" class="form-control" placeholder="{{Lang::get('account/form.password')}}"  value="{{ Input::old('password') }}" autofocus>
                    {{ $errors->first('password', '<label for="password" class="control-label">:message</label>') }}
                </div>
            </div>
            <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                <label class="col-lg-2 control-label" for="password_confirm">@lang('account/form.re_password') <span style="color: red">*</span></label>
                <div class="col-lg-6">
                    <input type="password" id="password_confirm"name="password_confirm" class="form-control" placeholder="{{Lang::get('account/form.re_password')}}"  value="{{ Input::old('password_confirm') }}" autofocus>
                    {{ $errors->first('password_confirm', '<label for="password_confirm" class="control-label">:message</label>') }}
                </div>
            </div>

            <div id="organization-info">
<!--                <div class="form-group {{ $errors->first('organization_type', 'has-error') }}">-->
<!--                    <label class="col-lg-2 control-label" for="organization_type">@lang('account/form.organization_type')</label>-->
<!--                    <div class="col-lg-6">-->
<!--                        {{ Form::select('organization_type', $heads, null, array('class'=>'form-control') ) }}-->
<!--                        {{ $errors->first('organization_type', '<label for="organization_type" class="control-label">:message</label>') }}-->
<!--                    </div>-->
<!--                </div>-->
                <div class="form-group {{ $errors->first('office_name', 'has-error') }}">
                    <label class="col-lg-2 control-label" for="office_name">@lang('account/form.office_name')</label>
                    <div class="col-lg-6">
                        <input type="text" id="office_name"name="office_name" placeholder="{{Lang::get('account/form.office_name')}}" class="form-control" value="{{ Input::old('office_name') }}" autofocus>
                        {{ $errors->first('office_name', '<label for="office_name" class="control-label">:message</label>') }}
                    </div>
                </div>
                <div class="form-group {{ $errors->first('representative_name', 'has-error') }}">
                    <label class="col-lg-2 control-label" for="representative_name">@lang('account/form.representative_name')</label>
                    <div class="col-lg-6">
                        <input type="text" id="representative_name"name="representative_name" placeholder="{{Lang::get('account/form.representative_name')}}" class="form-control" value="{{ Input::old('representative_name') }}" autofocus>
                        {{ $errors->first('representative_name', '<label for="representative_name" class="control-label">:message</label>') }}
                    </div>
                </div>
                <div class="form-group {{ $errors->first('contact_number', 'has-error') }}">
                    <label class="col-lg-2 control-label" for="contact_number">@lang('account/form.contact_number')</label>
                    <div class="col-lg-6">
                        <input type="text" id="contact_number"name="contact_number" placeholder="{{Lang::get('account/form.contact_number')}}" class="form-control" value="{{ Input::old('contact_number') }}" autofocus>
                        {{ $errors->first('contact_number', '<label for="contact_number" class="control-label">:message</label>') }}
                    </div>
                </div>
                <div class="form-group {{ $errors->first('office_web_url', 'has-error') }}">
                    <label class="col-lg-2 control-label" for="office_web_url">@lang('account/form.office_web_url')</label>
                    <div class="col-lg-6">
                        <input type="text" id="office_web_url"name="office_web_url" placeholder="{{Lang::get('account/form.office_web_url')}}" class="form-control" value="{{ Input::old('office_web_url') }}" autofocus>
                        {{ $errors->first('office_web_url', '<label for="office_web_url" class="control-label">:message</label>') }}
                    </div>
                </div>
            </div>

            <div class="form-group {{ $errors->first('captcha', 'has-error') }}">
                <div class="col-lg-12 col-lg-offset-2">
                    <label for="captcha">@lang('account/form.Captcha')</label>
                    <div>
                        {{ HTML::image(Captcha::img(), 'Captcha image') }}
                        {{ Form::text('captcha') }}
                        {{ $errors->first('captcha', '<label for="captcha" class="control-label">:message</label>') }}
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="col-lg-12 col-lg-offset-2">
                    <button class="btn btn-info" type="submit">@lang('button.signup')</button>
                </div>
            </div>


        </div>

    </form>

</div>
</div>

@stop
@section('page_scripts')
<script>
    $(function(){
        if($('#user_type').val()=="Individual"){
            $("#organization-info").hide();
        }
        $("#user_type").on("change", function(){
            $("#organization-info").toggle();
        });
    });
</script>

@stop
