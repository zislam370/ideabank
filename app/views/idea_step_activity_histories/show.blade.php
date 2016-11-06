@extends('layouts.scaffold')

@section('main')

<h1>Show Idea_step_activity_history</h1>

<p>{{ link_to_route('idea_step_activity_histories.index', 'Return to All idea_step_activity_histories', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
            <th>@lang('form/title.Idea_step_id')</th>
            <th>@lang('form/title.Workflow_activity_id')</th>
            <th>@lang('form/title.Status')</th>
            <th>@lang('form/title.Due_date')</th>
            <th>@lang('form/title.Initiate_date')</th>
            <th>@lang('form/title.Next_activity')</th>
            <th>@lang('form/title.Num_of_activities')</th>
            <th>@lang('form/title.Activity_form_ids') </th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $idea_step_activity_history->idea_step_id }}}</td>
					<td>{{{ $idea_step_activity_history->workflow_activity_id }}}</td>
					<td>{{{ $idea_step_activity_history->status }}}</td>
					<td>{{{ $idea_step_activity_history->due_date }}}</td>
					<td>{{{ $idea_step_activity_history->initiate_date }}}</td>
					<td>{{{ $idea_step_activity_history->next_activity }}}</td>
					<td>{{{ $idea_step_activity_history->num_of_activities }}}</td>
					<td>{{{ $idea_step_activity_history-> activity_form_ids }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/idea_step_activity_history', $idea_step_activity_history->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/idea_step_activity_history', $idea_step_activity_history->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
