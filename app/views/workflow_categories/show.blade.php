@extends('layouts.scaffold')

@section('main')

<h1>Show Workflow_category</h1>

<p>{{ link_to_route('workflow_categories.index', 'Return to All workflow_categories', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>@lang('form/title.name')</th>
				<th>@lang('form/title.description')</th>
				<th>@lang('form/title.Next_step')</th>
				<th>@lang('form/title.Num_of_steps')</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $workflow_category->name }}}</td>
					<td>{{{ $workflow_category->description }}}</td>
					<td>{{{ $workflow_category->next_step }}}</td>
					<td>{{{ $workflow_category->num_of_steps }}}</td>
                    <td align="right">
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/workflow_category', $workflow_category->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/workflow_category', $workflow_category->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
