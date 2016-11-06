@extends('layouts.scaffold')

@section('main')

<h1>Show Idea_step_history</h1>

<p>{{ link_to_route('idea_step_histories.index', 'Return to All idea_step_histories', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
            <th>@lang('form/title.Idea_id')</th>
            <th> @lang('form/title.Workflow_step_id')</th>
            <th>@lang('form/title.Next_step')</th>
            <th>@lang('form/title.Num_of_steps')</th>
            <th>@lang('form/title.Status')</th>
            <th>@lang('form/title.Due_date')</th>
            <th>@lang('form/title.Initiate_date')</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $idea_step_history->idea_id }}}</td>
					<td>{{{ $idea_step_history-> workflow_step_id }}}</td>
					<td>{{{ $idea_step_history->next_step }}}</td>
					<td>{{{ $idea_step_history->num_of_steps }}}</td>
					<td>{{{ $idea_step_history->status }}}</td>
					<td>{{{ $idea_step_history->due_date }}}</td>
					<td>{{{ $idea_step_history->initiate_date }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/idea_step_history', $idea_step_history->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/idea_step_history', $idea_step_history->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
