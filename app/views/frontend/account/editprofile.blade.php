@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
@lang('account/title.editprofilesubtitle') ::
@parent
@stop

{{-- Account page content --}}
@section('account-content')
<section class="well">
    <h3>
        @lang('account/title.editprofile')
    </h3>
    <div class="panel-body">
        <div class=" form">
            <form class="form-horizontal" role="form" method="post" action="" autocomplete="off" enctype="multipart/form-data">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <!-- First Name -->
                <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                    <label for="first_name" class="col-sm-3 control-label">@lang('form/title.name') <span style="color: red">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="{{Lang::get('form/title.name')}}" value="{{{ Input::old('first_name', $user->first_name) }}}">
                        </div>
                        <div class="col-sm-4">
                            {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
                        </div>
                </div>
                <!-- Address -->
                <div class="form-group {{ $errors->first('address', 'has-error') }}">
                    <label for="address" class="col-sm-3 control-label">@lang('account/form.address')</label>
                        <div class="col-sm-5">
                            <textarea  id="address" name="address" class="form-control" placeholder="{{Lang::get('account/form.address')}}">{{{ Input::old('address', $user->address) }}}</textarea>
                        </div>
                        <div class="col-sm-4">
                            {{ $errors->first('address', '<span class="help-block">:message</span>') }}
                        </div>
                </div>
                <!-- Mobile -->
                <div class="form-group {{ $errors->first('email', 'has-error') }}">
                    <label for="email" class="col-sm-3 control-label">@lang('account/form.email')</label>
                    <div class="col-sm-5">
                        <input type="email" id="email" name="email" value="{{{ Input::old('email', $user->email) }}}" class="form-control" placeholder="{{Lang::get('account/form.email')}}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                    </div>
                </div>
                @if ($user->user_type=="Organization")
                <div id="organization-info">
                    <div class="form-group {{ $errors->first('office_name', 'has-error') }}">
                        <label class="col-sm-3 control-label" for="office_name">@lang('account/form.office_name')</label>
                        <div class="col-lg-5">
                            <input type="text" id="office_name"name="office_name" placeholder="{{Lang::get('account/form.office_name')}}" class="form-control" value="{{ Input::old('office_name', $user->office_name) }}" autofocus>
                        </div>
                        <div class="col-sm-4">
                            {{ $errors->first('office_name', '<label for="office_name" class="control-label">:message</label>') }}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->first('representative_name', 'has-error') }}">
                        <label class="col-lg-3 control-label" for="representative_name">@lang('account/form.representative_name')</label>
                        <div class="col-lg-5">
                            <input type="text" id="representative_name"name="representative_name" placeholder="{{Lang::get('account/form.representative_name')}}" class="form-control" value="{{ Input::old('representative_name', $user->representative_name) }}" autofocus>
                        </div>
                        <div class="col-sm-4">
                            {{ $errors->first('representative_name', '<label for="representative_name" class="control-label">:message</label>') }}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->first('contact_number', 'has-error') }}">
                        <label class="col-lg-3 control-label" for="contact_number">@lang('account/form.contact_number')</label>
                        <div class="col-lg-5">
                            <input type="text" id="contact_number"name="contact_number" placeholder="{{Lang::get('account/form.contact_number')}}" class="form-control" value="{{ Input::old('contact_number', $user->contact_number) }}" autofocus>
                        </div>
                        <div class="col-sm-4">
                            {{ $errors->first('contact_number', '<label for="contact_number" class="control-label">:message</label>') }}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->first('office_web_url', 'has-error') }}">
                        <label class="col-lg-3 control-label" for="office_web_url">@lang('account/form.office_web_url')</label>
                        <div class="col-lg-5">
                            <input type="text" id="office_web_url"name="office_web_url" placeholder="{{Lang::get('account/form.office_web_url')}}" class="form-control" value="{{ Input::old('office_web_url', $user->office_web_url) }}" autofocus>
                        </div>
                        <div class="col-sm-4">
                            {{ $errors->first('office_web_url', '<label for="office_web_url" class="control-label">:message</label>') }}
                        </div>
                    </div>
                </div>
                @endif
                <div class="form-group last {{ $errors->first('avatar', 'has-error') }}">
                    <label class="control-label col-md-3">@lang('account/form.Image_Upload')</label>
                    <div class="col-md-5">
                        <div data-provides="fileupload" class="fileupload fileupload-new">
                            <div class="fileupload-new thumbnail">
                                <img src="{{ asset($user->avatar->url('original')) }}">
                            </div>

                            <div>
                                {{ Form::file('avatar', Input::old('avatar'), array('class'=>'form-control')) }}
                            </div>
                            <div><label><h5>@lang('form/title.File_Type')gif, jpg,png,pdf,doc,docx,xls,xlsx,ppt,pptx</h5></label></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('avatar', '<label for="avatar" class="control-label">:message</label>') }}
                    </div>
                </div>



                <hr>

                <!-- Form actions -->
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-default">@lang('button.Update_your_Profile')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </section>
@stop
@section('body_bottom')
<script type="text/javascript" src="{{ asset('backend_assets/assets/bootstrap-inputmask/bootstrap-inputmask.min.js') }}"></script>

<script src="{{ asset('backend_assets/js/form-component.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend_assets/assets/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>

@stop