@extends('layouts.scaffold')

@section('main')

<h1>Show Form_fund</h1>

<p>{{ link_to_route('form_funds.index', 'Return to All form_funds', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

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
			<td>{{{ $form_fund->idea_id }}}</td>
					<td>{{{ $form_fund->step_id }}}</td>
					<td>{{{ $form_fund->activity_id }}}</td>
					<td>{{{ $form_fund->head_id }}}</td>
					<td>{{{ $form_fund->comment }}}</td>
					<td>{{{ $form_fund->amount }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_fund', $form_fund->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_fund', $form_fund->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
