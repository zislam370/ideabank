@extends('layouts.scaffold')

@section('main')

<h1>Show Form_idea_approval</h1>

<p>{{ link_to_route('form_idea_approvals.index', 'Return to All form_idea_approvals', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Idea_id</th>
				<th>Step_id</th>
				<th>Activity_id</th>
				<th>Approval_id</th>
				<th>Comment</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_idea_approval->idea_id }}}</td>
					<td>{{{ $form_idea_approval->step_id }}}</td>
					<td>{{{ $form_idea_approval->activity_id }}}</td>
					<td>{{{ $form_idea_approval->approval_id }}}</td>
					<td>{{{ $form_idea_approval->comment }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_idea_approval', $form_idea_approval->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_idea_approval', $form_idea_approval->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
