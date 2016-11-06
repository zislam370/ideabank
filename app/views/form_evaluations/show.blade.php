@extends('layouts.scaffold')

@section('main')

<h1>Show Form_evaluation</h1>

<p>{{ link_to_route('form_evaluations.index', 'Return to All form_evaluations', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Task</th>
				<th>Due_date</th>
				<th>Target</th>
				<th>Achieved</th>
				<th>Remark</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_evaluation->task }}}</td>
					<td>{{{ $form_evaluation->due_date }}}</td>
					<td>{{{ $form_evaluation->target }}}</td>
					<td>{{{ $form_evaluation->achieved }}}</td>
					<td>{{{ $form_evaluation->remark }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_evaluation', $form_evaluation->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_evaluation', $form_evaluation->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
