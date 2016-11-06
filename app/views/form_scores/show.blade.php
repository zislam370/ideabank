@extends('layouts.scaffold')

@section('main')

<h1>Show Form_score</h1>

<p>{{ link_to_route('form_scores.index', 'Return to All form_scores', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Idea_id</th>
				<th>Step_id</th>
				<th>Activity_id</th>
				<th>Head_id</th>
				<th>Comment</th>
				<th>Score</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_score->idea_id }}}</td>
					<td>{{{ $form_score->step_id }}}</td>
					<td>{{{ $form_score->activity_id }}}</td>
					<td>{{{ $form_score->head_id }}}</td>
					<td>{{{ $form_score->comment }}}</td>
					<td>{{{ $form_score->score }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_score', $form_score->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_score', $form_score->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
