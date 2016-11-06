@extends('layouts.scaffold')

@section('main')

<h1>{{Lang::get('media/form.Show_Medium')}}</h1>

<p>{{ link_to_route('media.index', 'Return to All media', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>@lang('form/title.Title')</th>
				<th>@lang('form/title.Body')</th>
				<th>@lang('form/title.Publish')</th>
				<th>@lang('form/title.User_id')</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $medium->title }}}</td>
					<td>{{{ $medium->body }}}</td>
					<td>{{{ $medium->publish }}}</td>
					<td>{{{ $medium->user_id }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/medium', $medium->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/medium', $medium->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
