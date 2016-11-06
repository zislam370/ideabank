@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('form_idea_approvals/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form_idea_approvals/title.management')

    <div class="pull-right">
        <a href="{{ route('create/form_idea_approval') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        @if ($form_idea_approvals->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>Idea_id</th>
				<th>Step_id</th>
				<th>Activity_id</th>
				<th>Approval_id</th>
				<th>Comment</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($form_idea_approvals as $form_idea_approval)
                    <tr>
                        <td>{{{ $form_idea_approval->idea_id }}}</td>
					<td>{{{ $form_idea_approval->step_id }}}</td>
					<td>{{{ $form_idea_approval->activity_id }}}</td>
					<td>{{{ $form_idea_approval->approval_id }}}</td>
					<td>{{{ $form_idea_approval->comment }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_idea_approval', $form_idea_approval->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_idea_approval', $form_idea_approval->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $form_idea_approvals->links() }}
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
