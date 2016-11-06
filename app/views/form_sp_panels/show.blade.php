@extends('layouts.scaffold')

@section('main')

<h1>Show Form_sp_panel</h1>

<p>{{ link_to_route('form_sp_panels.index', 'Return to All form_sp_panels', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
				<th>Designation</th>
				<th>Remark</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_sp_panel->name }}}</td>
					<td>{{{ $form_sp_panel->designation }}}</td>
					<td>{{{ $form_sp_panel->remark }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_sp_panel', $form_sp_panel->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_sp_panel', $form_sp_panel->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
