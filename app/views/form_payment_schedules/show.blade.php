@extends('layouts.scaffold')

@section('main')

<h1>Show Form_payment_schedule</h1>

<p>{{ link_to_route('form_payment_schedules.index', 'Return to All form_payment_schedules', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
				<th>Due_date</th>
				<th>Remark</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_payment_schedule->name }}}</td>
					<td>{{{ $form_payment_schedule->due_date }}}</td>
					<td>{{{ $form_payment_schedule->remark }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_payment_schedule', $form_payment_schedule->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_payment_schedule', $form_payment_schedule->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
