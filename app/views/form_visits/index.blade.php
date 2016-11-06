@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('form_visits/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form_visits/title.management')

    <div class="pull-right">
        <a href="{{ route('create/form_visit') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        @if ($form_visits->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>Location</th>
				<th>Purpose</th>
				<th>Start</th>
				<th>End</th>
				<th>Outcome</th>
				<th>Remark</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($form_visits as $form_visit)
                    <tr>
                        <td>{{{ $form_visit->location }}}</td>
					<td>{{{ $form_visit->purpose }}}</td>
					<td>{{{ $form_visit->start }}}</td>
					<td>{{{ $form_visit->end }}}</td>
					<td>{{{ $form_visit->outcome }}}</td>
					<td>{{{ $form_visit->remark }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_visit', $form_visit->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_visit', $form_visit->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $form_visits->links() }}
    </div>
</div>

@else
@lang('general.noresults')
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
