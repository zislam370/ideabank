@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('idea_step_histories/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('idea_step_histories/title.management')

    <div class="pull-right">
        <a href="{{ route('create/idea_step_history') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        @if ($idea_step_histories->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>@lang('form/title.Idea_id')</th>
				<th> @lang('form/title.Workflow_step_id')</th>
				<th>@lang('form/title.Next_step')</th>
				<th>@lang('form/title.Num_of_steps')</th>
				<th>@lang('form/title.Status')</th>
				<th>@lang('form/title.Due_date')</th>
				<th>@lang('form/title.Initiate_date')</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($idea_step_histories as $idea_step_history)
                    <tr>
                        <td>{{{ $idea_step_history->idea_id }}}</td>
					<td>{{{ $idea_step_history-> workflow_step_id }}}</td>
					<td>{{{ $idea_step_history->next_step }}}</td>
					<td>{{{ $idea_step_history->num_of_steps }}}</td>
					<td>{{{ $idea_step_history->status }}}</td>
					<td>{{{ $idea_step_history->due_date }}}</td>
					<td>{{{ $idea_step_history->initiate_date }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/idea_step_history', $idea_step_history->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/idea_step_history', $idea_step_history->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $idea_step_histories->links() }}
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
