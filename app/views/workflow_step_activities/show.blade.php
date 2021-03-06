@extends('layouts.scaffold')

@section('main')

<h1>Show Workflow_step_activity</h1>

<p>{{ link_to_route('workflow_step_activities.index', 'Return to All workflow_step_activities', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
            <th>@lang('form/title.Workflow_step_id')</th>
            <th>@lang('form/title.name')</th>
            <th>@lang('form/title.description')</th>
            <th>@lang('form/title.Activity_no')</th>
            <th>@lang('form/title.forms')</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $workflow_step_activity->workflow_step_id }}}</td>
					<td>{{{ $workflow_step_activity->name }}}</td>
					<td>{{{ $workflow_step_activity->description }}}</td>
					<td>{{{ $workflow_step_activity->activity_no }}}</td>
					<td>{{{ $workflow_step_activity->forms }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/workflow_step_activity', $workflow_step_activity->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/workflow_step_activity', $workflow_step_activity->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
