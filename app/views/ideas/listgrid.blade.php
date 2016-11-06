@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('ideas/title.management') ::
@parent
@stop

{{-- Content --}}
@section('content')

<h1 class="pull-left">@lang('ideas/title.sortedlist')</h1>
<div class="pull-right innerT">
    <div class="btn-group">
        <a class="btn btn-default filled" href="{{ route('ideas') }}"><i class="fa fa-list"></i></a>
        <a class="btn btn-inverse" href="{{ route('listgrid/idea') }}"><i class="fa fa-th"></i></a>
    </div>
</div>

<div class="clearfix"></div>
@if ($ideas->count() >= 1)
<div class="innerTB">
        @foreach ($ideas as $idea)
    <div class="col-md-6">
        <div class="widget widget-primary widget-small">
            <div class="innerAll">
                <div class="media">
                    <div class="pull-left innerR half">
                        <i class="icon-light-bulb fa-4x icon-faded"></i>
                    </div>
                    <div class="media-body ">
                        <h4><a class="media-heading" href="{{ route('show/idea',$idea->id) }}">{{{ $idea->name }}}</a>
                            <span class="label label-success label-stroke">{{{ $idea->category->name }}}</span>
                        </h4>
                        <p class="margin-none text-muted">{{{ $idea->short_desc }}}</p>
                    </div>
                </div>
                <form role="form" class="form-horizontal">
                    <div class="widget widget-none bg-gray innerAll half margin-slim">
                        <div class="row">
                            <label class="col-sm-2 control-label text-left">@lang('form/title.Progress')</label>
                            <div class="col-md-4 col-sm-6 col-xs-10 innerT half">
                                <div class="progress progress-mini">
                                    <div style="width: 20%;" class="progress-bar progress-bar-primary"></div>
                                </div>
                            </div>
                            <label class="control-label text-left strong text-muted-dark">20 %</label>
                        </div>
                    </div>

                    <div class="widget widget-none bg-gray innerAll half margin-slim">
                        <div class="row">
                            <label class="col-sm-2 control-label text-left padding-top-none">@lang('form/title.Tags')</label>
                            <div class="col-md-4 col-sm-6 col-xs-10 strong">
                                <a href=""><span class="label label-primary">HTML</span></a>
                                <a href=""><span class="label label-warning"> CSS</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="widget widget-none bg-gray innerAll half margin-slim">
                        <div class="row">
                            <label class="col-sm-2 control-label text-left">@lang('form/title.Fund')</label>
                            <div class="col-md-4 col-sm-6 col-xs-10">
                                <p class="lead margin-none">2,50,000 tk <span class="text-small text-muted-dark strong">(funded)</span> </p>
                            </div>
                        </div>
                    </div>
                    <div class="widget widget-none bg-gray innerAll half margin-slim">
                        <div class="row">
                            <label class="col-sm-2 control-label text-left innerT">@lang('form/title.Initiator')</label>
                            <div class="col-md-4 col-sm-6 col-xs-10">
                                <a href="">{{{ $idea->fullname }}}</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @endforeach
</div>

{{ $ideas->links() }}
@else
@lang('general.noresults')
@endif
@stop

{{-- Body Bottom confirm modal --}}
@section('body_bottom')
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
@stop
