@extends('layouts.scaffold')

@section('main')

<h1>Show Form_stack_holder</h1>

<p>{{ link_to_route('form_stack_holders.index', 'Return to All form_stack_holders', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
				<th>Role</th>
				<th>Remark</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_stack_holder->name }}}</td>
					<td>{{{ $form_stack_holder->role }}}</td>
					<td>{{{ $form_stack_holder->remark }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_stack_holder', $form_stack_holder->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_stack_holder', $form_stack_holder->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
