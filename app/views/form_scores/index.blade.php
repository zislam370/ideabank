@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('form_scores/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form_scores/title.management')

    <div class="pull-right">
        <a href="{{ route('create/form_score') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        @if ($form_scores->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>Idea_id</th>
				<th>Step_id</th>
				<th>Activity_id</th>
				<th>Head_id</th>
				<th>Comment</th>
				<th>Score</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($form_scores as $form_score)
                    <tr>
                        <td>{{{ $form_score->idea_id }}}</td>
					<td>{{{ $form_score->step_id }}}</td>
					<td>{{{ $form_score->activity_id }}}</td>
					<td>{{{ $form_score->head_id }}}</td>
					<td>{{{ $form_score->comment }}}</td>
					<td>{{{ $form_score->score }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_score', $form_score->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_score', $form_score->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $form_scores->links() }}
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
