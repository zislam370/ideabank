@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('form_payment_schedules/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form_payment_schedules/title.management')

    <div class="pull-right">
        <a href="{{ route('create/form_payment_schedule') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        @if ($form_payment_schedules->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>Name</th>
				<th>Due_date</th>
				<th>Remark</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($form_payment_schedules as $form_payment_schedule)
                    <tr>
                        <td>{{{ $form_payment_schedule->name }}}</td>
					<td>{{{ $form_payment_schedule->due_date }}}</td>
					<td>{{{ $form_payment_schedule->remark }}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/form_payment_schedule', $form_payment_schedule->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/form_payment_schedule', $form_payment_schedule->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $form_payment_schedules->links() }}
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
