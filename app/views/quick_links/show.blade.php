@extends('layouts.scaffold')

@section('main')

<h1>Show Quick_link</h1>

<p>{{ link_to_route('quick_links.index', 'Return to All quick_links', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
            <th>@lang('form/title.title')</th>
            <th>@lang('form/title.link')</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $quick_link->title }}}</td>
					<td>{{{ $quick_link->link }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/quick_link', $quick_link->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/quick_link', $quick_link->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

		</tr>
	</tbody>
</table>

@stop
