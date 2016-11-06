@extends('layouts.scaffold')

@section('main')

<h1>{{Lang::get('form/title.Show_Sector')}}</h1>

<p>{{ link_to_route('sectors.index', 'Return to All sectors', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>@lang('form/title.name')</th>
		</tr>
	</thead>

    <tbody>
    @foreach ($sectors as $sector)
    <tr>
        <td>{{{ $sector->name }}}</td>
        <td>
            <a class="btn btn-primary btn-xs"  href="{{ route('update/sector', $sector->id) }}"><i class="fa fa-pencil"></i></a>
            <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/sector', $sector->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
        </td>
    </tr>
    @endforeach

    </tbody>
</table>

@stop
