@extends('layouts.scaffold')

@section('main')

<h1>Show Workflow_step</h1>

<p>{{ link_to_route('workflow_steps.index', 'Return to All workflow_steps', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
            <th>@lang('form/title.Workflow_step_id')</th>
            <th>@lang('form/title.name')</th>
            <th>@lang('form/title.description')</th>
            <th>@lang('form/title.Next_activity')</th>
            <th>@lang('form/title.Num_of_activities')</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $workflow_step->workflow_step_id }}}</td>
					<td>{{{ $workflow_step->name }}}</td>
					<td>{{{ $workflow_step->description }}}</td>
					<td>{{{ $workflow_step->next_activity }}}</td>
					<td>{{{ $workflow_step->num_of_activities }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/workflow_step', $workflow_step->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/workflow_step', $workflow_step->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
