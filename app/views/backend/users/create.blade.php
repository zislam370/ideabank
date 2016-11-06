@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/users/form.Create_User') ::
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="well">
    <header class="panel-heading">
        @lang('admin/users/title.create')
        <div class="pull-right">
            <a href="{{ route('users') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
        </div>
    </header>
    <div class="panel-body">
        <div class=" form">


            <form class="apply-nolazy form-horizontal" role="form" method="post" action="">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />



                        <!-- First Name -->
                        <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                            <label for="first_name" class="col-sm-2 control-label">@lang('form/title.name') <span class="text-danger">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="{{Lang::get('form/title.name')}}" value="{{{ Input::old('first_name') }}}">
                                    {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
                                </div>

                        </div>
                        <!-- Email -->
                        <div class="form-group {{ $errors->first('email', 'has-error') }}">
                            <label for="email" class="col-sm-2 control-label">@lang('admin/users/form.email')<span class="text-danger">*</span></label>
                                <div class="col-sm-5">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="{{Lang::get('admin/users/form.email')}}" value="{{{ Input::old('email') }}}">
                                    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                                </div>

                        </div>

                        <!-- Password -->
                        <div class="form-group {{ $errors->first('password', 'has-error') }}">
                            <label for="password" class="col-sm-2 control-label">@lang('admin/users/form.password')<span class="text-danger">*</span></label>
                                <div class="col-sm-5">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="{{Lang::get('admin/users/form.password')}}"  value="{{{ Input::old('password') }}}">
                                    {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                                </div>

                        </div>

                        <!-- Password Confirm -->
                        <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                            <label for="password_confirm" class="col-sm-2 control-label">@lang('admin/users/form.confirmpassword')<span class="text-danger">*</span></label>
                                <div class="col-sm-5">
                                    <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="{{Lang::get('admin/users/form.confirmpassword')}}"  value="{{{ Input::old('password') }}}">
                                    {{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
                                </div>

                        </div>

                        <!-- Activation Status -->
                        <div class="form-group {{ $errors->first('activated', 'has-error') }}">
                            <label for="activated" class="col-sm-2 control-label">@lang('admin/users/form.activated')</label>
                                <div class="col-sm-5">
                                    <select name="activated" id="activated">
                                    <option value="1"{{ (Input::old('activated', 0) === 1 ? ' selected="selected"' : '') }}>@lang('form/title.Yes')</option>
                                    <option value="0"{{ (Input::old('activated', 0) === 0 ? ' selected="selected"' : '') }}>@lang('form/title.No')</option>
                                </select>
                                </div>
                                <div class="col-sm-4">
                                    {{ $errors->first('activated', '<span class="help-block">:message</span>') }}
                                </div>
                        </div>

                        <!-- Groups -->
                        <div class="form-group {{ $errors->first('groups', 'has-error') }}">
                            <label for="groups" class="col-sm-2 control-label">@lang('admin/users/form.groups')</label>
                                <div class="col-sm-5">
                                    <select name="groups[]" id="groups[]" multiple="multiple">
                                    @foreach ($groups as $group)
                                    <option value="{{{ $group->id }}}"{{ (in_array($group->id, $selectedGroups) ? ' selected="selected"' : '') }}>{{ $group->name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">@lang('admin/users/form.grouphelp')</span>
                                </div>
                                <div class="col-sm-4">
                                    {{ $errors->first('groups', '<span class="help-block">:message</span>') }}
                                </div>
                        </div>

                <!-- Address -->
                <div class="form-group {{ $errors->first('address', 'has-error') }}">
                    <label for="address" class="col-sm-2 control-label">@lang('account/form.address')</label>
                    <div class="col-sm-5">
                        <textarea  id="address" name="address" class="form-control" placeholder="{{Lang::get('account/form.address')}}">{{{ Input::old('address') }}}</textarea>
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('address', '<span class="help-block">:message</span>') }}
                    </div>
                </div>
                <!-- Mobile -->
                <div class="form-group {{ $errors->first('mobile', 'has-error') }}">
                    <label  for="mobile" class="col-sm-2 control-label">@lang('account/form.mobile')<span class="text-danger">*</span></label>
                    <div class="col-sm-5">
                        <input type="text" id="mobile" name="mobile" class="form-control" data-mask="99999999999" value="{{{ Input::old('mobile') }}}">
                        <span class="help-inline">(01700008888)</span>
                        {{ $errors->first('mobile', '<span class="help-block">:message</span>') }}
                    </div>

                </div>

                <div class="form-group last">
                    <label class="control-label col-md-2">@lang('account/form.Image_Upload')</label>
                    <div class="col-md-9">
                        <div data-provides="fileupload" class="fileupload fileupload-new">
                            <div>
                                {{ Form::file('avatar', Input::old('avatar'), array('class'=>'form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-lg-offset-2">
                        <label><h5>@lang('form/title.File_Type')gif, jpg,png,pdf,doc,docx,xls,xlsx,ppt,pptx</h5></label>
                    </div>
                </div>

                <hr/>
                <!-- Form Actions -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                        <a class="btn btn-link" href="{{ route('users') }}">@lang('button.cancel')</a>
                        <button type="submit" class="btn btn-default">@lang('button.save')</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>
@stop
