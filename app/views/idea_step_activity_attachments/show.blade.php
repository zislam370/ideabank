@extends('layouts.scaffold')

@section('main')

<h1>Show Idea_step_activity_attachment</h1>

<p>{{ link_to_route('idea_step_activity_attachments.index', 'Return to All idea_step_activity_attachments', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
            <th>@lang('form/title.Idea_step_activity_id')</th>
            <th>@lang('form/title.Head_id')</th>
            <th>@lang('form/title.comment')</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $idea_step_activity_attachment->idea_step_activity_id }}}</td>
					<td>{{{ $idea_step_activity_attachment->head_id }}}</td>
					<td>{{{ $idea_step_activity_attachment->comment }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/idea_step_activity_attachment', $idea_step_activity_attachment->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/idea_step_activity_attachment', $idea_step_activity_attachment->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
