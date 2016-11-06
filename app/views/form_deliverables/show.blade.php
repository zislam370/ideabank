@extends('layouts.scaffold')

@section('main')

<h1>Show Form_deliverable</h1>

<p>{{ link_to_route('form_deliverables.index', 'Return to All form_deliverables', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

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
			<td>{{{ $form_deliverable->name }}}</td>
					<td>{{{ $form_deliverable->due_date }}}</td>
					<td>{{{ $form_deliverable->remark }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_deliverable', $form_deliverable->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_deliverable', $form_deliverable->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
