@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('form_activities/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form_activities/title.management')

    <div class="pull-right">
        <a href="{{ route('create/form_activity') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        @if ($form_activities->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>Idea_id</th>
				<th>Step_id</th>
				<th>Activity_id</th>
				<th>Duration</th>
				<th>Due_date</th>
				<th>Target</th>
				<th>Achieve</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($form_activities as $form_activity)
                    <tr>
                        <td>{{{ $form_activity->idea_id }}}</td>
					<td>{{{ $form_activity->step_id }}}</td>
					<td>{{{ $form_activity->activity_id }}}</td>
					<td>{{{ $form_activity->duration }}}</td>
					<td>{{{ $form_activity->due_date }}}</td>
					<td>{{{ $form_activity->target }}}</td>
					<td>{{{ $form_activity->achieve }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_activity', $form_activity->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_activity', $form_activity->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $form_activities->links() }}
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
