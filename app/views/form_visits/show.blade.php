@extends('layouts.scaffold')

@section('main')

<h1>Show Form_visit</h1>

<p>{{ link_to_route('form_visits.index', 'Return to All form_visits', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Location</th>
				<th>Purpose</th>
				<th>Start</th>
				<th>End</th>
				<th>Outcome</th>
				<th>Remark</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_visit->location }}}</td>
					<td>{{{ $form_visit->purpose }}}</td>
					<td>{{{ $form_visit->start }}}</td>
					<td>{{{ $form_visit->end }}}</td>
					<td>{{{ $form_visit->outcome }}}</td>
					<td>{{{ $form_visit->remark }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_visit', $form_visit->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_visit', $form_visit->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
