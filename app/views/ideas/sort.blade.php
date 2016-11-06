@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('ideas/title.sort') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('ideas/title.sorting')
    <div class="pull-right">
        <a href="{{ route('unsortedlist/idea') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
    </div>
</h1>
@stop

{{-- Page content --}}
@section('content')
<form autocomplete="off" method="post" class="apply-nolazy form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Widget -->
    <div class="widget">


        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">

            <!-- Workflow Category -->
            <div class="form-group {{ $errors->first('advertisement_id', 'has-error') }}">
                <label for="advertisement_id" class="col-sm-3 control-label">@lang('ideas/form.advertisement_id')</label>
                <div class="col-sm-5">
                    {{ Form::select('advertisement_id', $workflow_categories , Input::old('advertisement_id', $idea->advertisement_id), array('class'=>'form-control')) }}
                </div>
                <div class="col-sm-4">
                    {{ $errors->first('advertisement_id', '<span class="help-block">:message</span>') }}
                </div>
            </div>

            <div class="separator"></div>

                <!-- Form actions -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                        <a class="btn btn-link" href="{{ route('unsortedlist/idea') }}">@lang('button.cancel')</a>
                        <button type="submit" class="btn btn-default">@lang('button.save')</button>
                    </div>
                </div>
        </div>
    </div>
</form>

<style>
    .cntnt{
        padding-top: 11px;
    }
    .control-label{
        margin-bottom: 0;
        padding-top: 11px;

    }
    .form-group{
        display: table;
        width: 100%;
    }
    .white-box{
        background-color: #fff;
        padding: 5px 10px;
    }
</style>
<div class="widget-body">
    <div class="row">
        <div class="col-sm-8">
            <div class="widget widget-primary widget-small">
                <div class="widget-head">
                    <h4 class="heading">@lang('ideas/title.detail')</h4>
                </div>
                <div class="widget-body innerAll inner-2x">
                    <table class="table table-bordered table-striped table-white">
                        <div class="col-sm-12">
                            <h6 class="heading">@lang('form/title.Date')</h6>
                            <div>
                                <p>{{{ date( 'd-m-Y', strtotime( $idea->created_at )) }}}</p>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h6 class="heading">@lang('form/title.durations')</h6>
                            <div>
                                <p>{{Lang::get('form/title.durations')}}{{{Input::old('duration',$idea->duration)}}}-{{Lang::get('form/title.month')}}</p>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h6 class="heading cntnt">@lang('form/title.prob_stmnt')</h6>
                            <div class="white-box">
                                {{ $idea->prob_stmnt }}
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h6 class="heading cntnt">@lang('form/title.prob_file')</h6>
                            <div>
                                <a href="{{ asset($idea->prob_file->url('original')) }}">{{ $idea->prob_file->originalFilename()?"Download":""}}</a>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h6 class="heading cntnt">@lang('form/title.sol_stmnt')</h6>
                            <div class="white-box">
                                {{ $idea->sol_stmnt }}
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h6 class="heading cntnt">@lang('form/title.sol_file')</h6>
                            <div>
                                <a href="{{ asset($idea->sol_file->url('original')) }}">{{ $idea->sol_file->originalFilename()?"Download":""}}</a>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h6 class="heading cntnt">@lang('form/title.dependencies')</h6>
                            <div class="white-box">
                                {{ $idea->dependencies }}
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h6 class="heading cntnt">@lang('form/title.beneficaries')</h6>
                            <div class="white-box">
                                {{ $idea->beneficaries }}
                            </div>
                        </div>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="widget widget-primary widget-small">
                <div class="widget-head">
                    <h4 class="heading">@lang('ideas/form.Initiator_details')</h4>
                </div>
                <div>
                    <div class="widget-body">
                        <div class="media innerAll half">
                            <i><img class="center-block img-circle" alt="" src="{{ asset($idea->author->avatar->url('thumb')) }}" width="200" height="200"></i>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <div class="pull-right">
                                </div>
                                <h2><a href="{{ route('user/profile',$idea->author->id) }}">{{{$idea->author->first_name}}}</a></h2>
                                <table class="table ">
                                    <tbody>
                                    <tr>
                                        <td><span class="fa fa-tablet"></span> @lang('account/form.mobile')</td>
                                        <td class="text-primary"> {{{ $idea->author->mobile }}}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="fa fa-envelope"></span> @lang('account/form.email')</td>
                                        <td class="text-primary"> {{{ $idea->author->email }}}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="fa fa-anchor"></span> @lang('account/form.address')</td>
                                        <td class="text-primary"> {{{ $idea->author->address }}}</td>
                                    </tr>
                                    @if ($idea->author->user_type == "Organization" )
                                    <tr>
                                        <td><span class="fa fa-briefcase"></span> @lang('account/form.organization_type')</td>
                                        <td class="text-primary"> {{{$idea->author->organization_type}}}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="fa fa-building-o"></span> @lang('account/form.office_name')</td>
                                        <td class="text-primary"> {{{$idea->author->office_name}}}</td>
                                    </tr>

                                    <tr>
                                        <td><span class="fa fa-user"></span> @lang('account/form.representative_name')</td>
                                        <td class="text-primary"> {{{$idea->author->representative_name}}}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="fa fa-phone"></span> @lang('account/form.contact_number')</td>
                                        <td class="text-primary"> {{{$idea->author->contact_number}}}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="fa fa-link"></span> @lang('account/form.office_web_url')</td>
                                        <td class="text-primary"> {{{$idea->author->office_web_url}}}</td>
                                    </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop