@extends('layouts.scaffold')

@section('main')

<h1>Show Form_activity</h1>

<p>{{ link_to_route('form_activities.index', 'Return to All form_activities', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Idea_id</th>
				<th>Step_id</th>
				<th>Activity_id</th>
				<th>Duration</th>
				<th>Due_date</th>
				<th>Target</th>
				<th>Achieve</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_activity->idea_id }}}</td>
					<td>{{{ $form_activity->step_id }}}</td>
					<td>{{{ $form_activity->activity_id }}}</td>
					<td>{{{ $form_activity->duration }}}</td>
					<td>{{{ $form_activity->due_date }}}</td>
					<td>{{{ $form_activity->target }}}</td>
					<td>{{{ $form_activity->achieve }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_activity', $form_activity->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_activity', $form_activity->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
