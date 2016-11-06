@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('workflow_steps/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('workflow_steps/title.management')

    <div class="pull-right">
        <a class="btn btn-link" href="{{ route('workflow_categories') }}">@lang('button.back')</a>
        <a href="{{ route('create/workflow_step', $workflowId) }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        @if (sizeof($workflow_steps) >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>@lang('form/title.name')</th>
                    <th>@lang('form/title.Step No')</th>
                    <th>@lang('form/title.Next_step')</th>
                    <th>@lang('form/title.Num_of_activities')</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($workflow_steps as $workflow_step)
                    <tr>
                        <td>{{{ $workflow_step->name }}}</td>
                        <td>{{{ $workflow_step->step_no }}}</td>
                        <td>{{{ $workflow_step->next_steps }}}</td>
                        <td>
                            <span class="badge badge-success">{{{ $workflow_step->num_of_activities }}}</span>
                            <a class="btn btn-primary btn-xs"  href="{{ route('list/workflow_step_activity', array($workflowId, $workflow_step->id)) }}">
                                <i class="fa fa-external-link"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-xs"  href="{{ route('update/workflow_step', $workflow_step->id) }}"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/workflow_step', $workflow_step->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

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
