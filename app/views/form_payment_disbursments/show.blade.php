@extends('layouts.scaffold')

@section('main')

<h1>Show Form_payment_disbursment</h1>

<p>{{ link_to_route('form_payment_disbursments.index', 'Return to All form_payment_disbursments', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Installment</th>
				<th>Disburse_date</th>
				<th>Amount</th>
				<th>Remark</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_payment_disbursment->Installment }}}</td>
					<td>{{{ $form_payment_disbursment->disburse_date }}}</td>
					<td>{{{ $form_payment_disbursment->amount }}}</td>
					<td>{{{ $form_payment_disbursment->remark }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_payment_disbursment', $form_payment_disbursment->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_payment_disbursment', $form_payment_disbursment->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
