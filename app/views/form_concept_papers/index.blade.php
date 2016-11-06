@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('form_concept_papers/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form_concept_papers/title.management')

    <div class="pull-right">
        <a href="{{ route('create/form_concept_paper') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        @if ($form_concept_papers->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>Idea_id</th>
				<th>Step_id</th>
				<th>Activity_id</th>
				<th>Is_opened</th>
				<th>Is_closed</th>
				<th>Concept</th>
				<th>Background</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($form_concept_papers as $form_concept_paper)
                    <tr>
                        <td>{{{ $form_concept_paper->idea_id }}}</td>
					<td>{{{ $form_concept_paper->step_id }}}</td>
					<td>{{{ $form_concept_paper->activity_id }}}</td>
					<td>{{{ $form_concept_paper->is_opened }}}</td>
					<td>{{{ $form_concept_paper->is_closed }}}</td>
					<td>{{{ $form_concept_paper->concept }}}</td>
					<td>{{{ $form_concept_paper->background }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_concept_paper', $form_concept_paper->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_concept_paper', $form_concept_paper->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $form_concept_papers->links() }}
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
