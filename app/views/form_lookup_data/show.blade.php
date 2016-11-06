@extends('layouts.scaffold')

@section('main')

<h1>Show Form_lookup_datum</h1>

<p>{{ link_to_route('form_lookup_data.index', 'Return to All form_lookup_data', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
            <th>@lang('form/title.Form_lookup_id')</th>
            <th>@lang('form/title.name')</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $form_lookup_datum->form_lookup_id }}}</td>
					<td>{{{ $form_lookup_datum->name }}}</td>
                    <td align="right">
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_lookup_datum', $form_lookup_datum->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_lookup_datum', $form_lookup_datum->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
