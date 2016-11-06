@extends('layouts.scaffold')

@section('main')

<h1>Show Tweet</h1>

<p>{{ link_to_route('tweets.index', 'Return to All tweets', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>@lang('tweet/form.author')</th>
				<th>@lang('tweet/form.body')</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $tweet->author }}}</td>
					<td>{{{ $tweet->body }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('tweets.destroy', $tweet->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('tweets.edit', 'Edit', array($tweet->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
