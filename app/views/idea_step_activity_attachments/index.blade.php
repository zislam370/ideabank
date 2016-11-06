@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('idea_step_activity_attachments/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('idea_step_activity_attachments/title.management')

    <div class="pull-right">
        <a href="{{ route('create/idea_step_activity_attachment') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        @if ($idea_step_activity_attachments->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>@lang('form/title.Idea_step_activity_id')</th>
                    <th>@lang('form/title.Head_id')</th>
                    <th>@lang('form/title.comment')</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($idea_step_activity_attachments as $idea_step_activity_attachment)
                    <tr>
                        <td>{{{ $idea_step_activity_attachment->idea_step_activity_id }}}</td>
					<td>{{{ $idea_step_activity_attachment->head_id }}}</td>
					<td>{{{ $idea_step_activity_attachment->comment }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/idea_step_activity_attachment', $idea_step_activity_attachment->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/idea_step_activity_attachment', $idea_step_activity_attachment->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $idea_step_activity_attachments->links() }}
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
