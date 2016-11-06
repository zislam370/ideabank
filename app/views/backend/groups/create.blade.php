@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('admin/groups/title.create') ::
@parent
{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('admin/groups/title.create')
    <div class="pull-right">
        <a href="{{ route('groups') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
    </div>
</h1>
@stop

{{-- Content --}}
@section('content')
<section class="well">
	<div class="panel-body">
		<div class=" form">
            <!-- Tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-general" data-toggle="tab">@lang('admin/groups/form.general')</a></li>
                <li><a href="#tab-permissions" data-toggle="tab">@lang('admin/groups/form.permissions')</a></li>
            </ul>

            <form class="apply-nolazy form-horizontal" role="form" method="post" action="">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <!-- Tabs Content -->
                <div class="tab-content">
                    <!-- General tab -->
                    <div class="tab-pane active" id="tab-general">
                        <br>
                        <!-- Name -->
                        <div class="form-group {{ $errors->first('name', 'has-error') }}">
                            <label for="title" class="col-sm-2 control-label">@lang('admin/groups/form.name')<span class="text-danger">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="{{Lang::get('admin/groups/form.groups_name')}}" value="{{{ Input::old('name') }}}">
                                    {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                                </div>

                        </div>
                    </div>

                    <!-- Tab Permissions -->
                    <div class="tab-pane" id="tab-permissions">
                        @foreach ($permissions as $area => $permissions)
                        <fieldset>
                            <div class="col-sm-12">
                            <h4>{{{ $area }}}</h4>
                            </div>

                            @foreach ($permissions as $permission)
                             <div class="form-group">
                                <label class="control-label radio-inline col-sm-2">{{{ $permission['label'] }}} </label>
                                <label for="{{{ $permission['permission'] }}}_allow" onclick="" class="radio-inline control-label col-sm-1">
                                    <input type="radio" value="1" id="{{{ $permission['permission'] }}}_allow" name="permissions[{{{ $permission['permission'] }}}]"{{ (array_get($selectedPermissions, $permission['permission']) === 1 ? ' checked="checked"' : '') }}> Allow
                                </label>

                                <label for="{{{ $permission['permission'] }}}_deny" onclick="" class="radio-inline control-label   col-sm-1">
                                        <input type="radio" value="0" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($selectedPermissions, $permission['permission']) ? ' checked="checked"' : '') }}>
                                        Deny
                                    </label>
                             </div>

                            @endforeach

                        </fieldset>
                        @endforeach
                    </div>
                </div>

                <hr/>
                <!-- Form actions -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                        <a class="btn btn-link" href="{{ route('groups') }}">@lang('button.cancel')</a>
                        <button type="submit" class="btn btn-default">@lang('button.save')</button>
                    </div>
                </div>

            </form>
	    </div>
	</div>
</section>
@stop
