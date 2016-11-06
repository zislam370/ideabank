@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('announcements/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('announcements/title.management')

    <div class="pull-right">
        <a href="{{ route('create/announcement') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">
    <div class="widget-body innerAll inner-2x">
        @if ($announcements->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>@lang('form/title.title')</th>
				<th>@lang('form/title.Publish')</th>
				<th>@lang('form/title.User_id')</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($announcements as $announcement)
                    <tr>
                        <td><a href="{{ route('update/announcement',$announcement->id) }}">{{{ $announcement->title }}}</a></td>
					<td> {{ Form::checkbox('publish',1)}}</td>
					<td>{{{ $announcement->User->first_name }}}</td>
                    <td align="right">
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/announcement', $announcement->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/announcement', $announcement->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $announcements->links() }}
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
