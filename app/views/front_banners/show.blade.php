@extends('layouts.scaffold')

@section('main')

<h1>Show Front_banner</h1>

<p>{{ link_to_route('front_banners.index', 'Return to All front_banners', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

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
			<td>{{{ $front_banner->idea_step_activity_id }}}</td>
					<td>{{{ $front_banner->head_id }}}</td>
					<td>{{{ $front_banner->comment }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/front_banner', $front_banner->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/front_banner', $front_banner->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
