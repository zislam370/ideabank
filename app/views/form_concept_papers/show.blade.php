@extends('layouts.scaffold')

@section('main')

<h1>Show Form_concept_paper</h1>

<p>{{ link_to_route('form_concept_papers.index', 'Return to All form_concept_papers', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Idea_id</th>
				<th>Step_id</th>
				<th>Activity_id</th>
				<th>Is_opened</th>
				<th>Is_closed</th>
				<th>Concept</th>
				<th>Background</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_concept_paper->idea_id }}}</td>
					<td>{{{ $form_concept_paper->step_id }}}</td>
					<td>{{{ $form_concept_paper->activity_id }}}</td>
					<td>{{{ $form_concept_paper->is_opened }}}</td>
					<td>{{{ $form_concept_paper->is_closed }}}</td>
					<td>{{{ $form_concept_paper->concept }}}</td>
					<td>{{{ $form_concept_paper->background }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_concept_paper', $form_concept_paper->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_concept_paper', $form_concept_paper->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
