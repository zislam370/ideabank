@extends('layouts.scaffold')

@section('main')

<h1>Show Announcement</h1>

<p>{{ link_to_route('announcements.index', 'Return to All announcements', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>@lang('form/title.Body')</th>
				<th>@lang('form/title.Publish')</th>
				<th>@lang('form/title.User_id')</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $announcement->body }}}</td>
					<td>{{{ $announcement->publish }}}</td>
					<td>{{{ $announcement->user_id }}}</td>
                    <td align="right">
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/announcement', $announcement->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/announcement', $announcement->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
