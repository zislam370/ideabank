@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('sectors/title.management') ::
@parent
@stop

{{-- Content --}}
@section('content_title')
<h1>
    @lang('sectors/title.management')

    <div class="pull-right">
        <a href="{{ route('create/sector') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<section class="widget">
    @if ($sectors->count() >= 1) {{ $sectors->links() }}
    <table class="table table-striped table-advance table-hover">
        <thead>
            <tr>
				<th>@lang('form/title.name')</th>
				<th>&nbsp;</th>
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
    {{ $sectors->links() }}
</section>

@else
<h4>@lang('general.noresults')</h4>
@endif
@stop

{{-- Body Bottom confirm modal --}}
@section('body_bottom')
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
@stop
