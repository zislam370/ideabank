@extends('layouts.scaffold')

@section('main')

<h1>Show Form_richtext</h1>

<p>{{ link_to_route('form_richtexts.index', 'Return to All form_richtexts', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_richtext->name }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_richtext', $form_richtext->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_richtext', $form_richtext->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
