@extends('layouts.scaffold')

@section('main')

<h1>Show Form_lookup</h1>

<p>{{ link_to_route('form_lookups.index', 'Return to All form_lookups', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
            <th>@lang('form/title.name')</th>
            <th>@lang('form/title.description')</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_lookup->name }}}</td>
					<td>{{{ $form_lookup->description }}}</td>
                    <td align="right">
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_lookup', $form_lookup->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_lookup', $form_lookup->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
