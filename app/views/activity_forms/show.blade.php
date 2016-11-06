@extends('layouts.scaffold')

@section('main')

<h1>Show Activity_form</h1>

<p>{{ link_to_route('activity_forms.index', 'Return to All activity_forms', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
            <th>@lang('form/title.name')</th>
            <th>@lang('form/title.description')</th>
            <th>@lang('form/title.action_uri')</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $activity_form->name }}}</td>
					<td>{{{ $activity_form->description }}}</td>
					<td>{{{ $activity_form->action_uri }}}</td>
                    <td align="right">
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/activity_form', $activity_form->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/activity_form', $activity_form->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
