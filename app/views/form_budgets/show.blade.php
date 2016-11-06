@extends('layouts.scaffold')

@section('main')

<h1>Show Form_budget</h1>

<p>{{ link_to_route('form_budgets.index', 'Return to All form_budgets', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Idea_id</th>
				<th>Step_id</th>
				<th>Activity_id</th>
				<th>Head_id</th>
				<th>Comment</th>
				<th>Amount</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_budget->idea_id }}}</td>
					<td>{{{ $form_budget->step_id }}}</td>
					<td>{{{ $form_budget->activity_id }}}</td>
					<td>{{{ $form_budget->head_id }}}</td>
					<td>{{{ $form_budget->comment }}}</td>
					<td>{{{ $form_budget->amount }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_budget', $form_budget->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_budget', $form_budget->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
