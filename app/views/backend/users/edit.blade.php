@extends('backend/layouts/account')

{{-- Page title --}}
@section('title')
@lang('account/title.editprofilesubtitle') ::
@parent
@stop

{{-- Account page content --}}
@section('account-content')
<section class="well">
    <header class="panel-heading">
        @lang('admin/users/title.edit')
        <div class="pull-right">
            <a href="{{ route('editprofile',$user->id) }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
        </div>
    </header>
    <div class="panel-body">
        <div class=" form">

            <form class="apply-nolazy form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />


                <!-- Activation Status -->
                <div class="form-group {{ $errors->first('activated', 'has-error') }}">
                    <label for="activated" class="col-sm-2 control-label">@lang('admin/users/form.activated')</label>
                        <div class="col-sm-5">
                            <select{{ ($user->id === Sentry::getId() ? ' disabled="disabled"' : '') }} name="activated" id="activated">
                            <option value="1"{{ ($user->isActivated() ? ' selected="selected"' : '') }}>@lang('form/title.Yes')</option>
                            <option value="0"{{ ( ! $user->isActivated() ? ' selected="selected"' : '') }}>@lang('form/title.No')</option>
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
                            <select name="groups[]" id="groups[]" multiple>
                            @foreach ($groups as $group)
                            <option value="{{{ $group->id }}}"{{ (array_key_exists($group->id, $userGroups) ? ' selected="selected"' : '') }}>{{ $group->name }}</option>
                            @endforeach
                        </select>
                        <span class="help-block">@lang('admin/users/form.grouphelp')</span>
                        </div>
                        <div class="col-sm-4">
                            {{ $errors->first('groups', '<span class="help-block">:message</span>') }}
                        </div>
                </div>



                <hr/>
                <!-- Form actions -->
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
