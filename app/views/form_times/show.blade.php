@extends('layouts.scaffold')

@section('main')

<h1>Show Form_time</h1>

<p>{{ link_to_route('form_times.index', 'Return to All form_times', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Idea_id</th>
				<th>Step_id</th>
				<th>Activity_id</th>
				<th>Head_id</th>
				<th>Comment</th>
				<th>Duration</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_time->idea_id }}}</td>
					<td>{{{ $form_time->step_id }}}</td>
					<td>{{{ $form_time->activity_id }}}</td>
					<td>{{{ $form_time->head_id }}}</td>
					<td>{{{ $form_time->comment }}}</td>
					<td>{{{ $form_time->duration }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_time', $form_time->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_time', $form_time->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
