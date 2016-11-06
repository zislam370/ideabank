@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('admin/groups/title.management') ::
@parent
@stop
{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('admin/groups/title.management')
    <div class="pull-right">
        <a href="{{ route('create/group') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop
{{-- Content --}}
@section('content')
<section class="widget">
    @if ($groups->count() >= 1) {{ $groups->links() }}
    <table class="table table-striped table-advance table-hover">
        <thead>
        <tr>
            <th class="span6">@lang('admin/groups/table.name')</th>
            <th class="span2">@lang('admin/groups/table.users')</th>
            <th class="span2">@lang('admin/groups/table.created_at')</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($groups as $group)
        <tr>
            <td>{{{ $group->name }}}</td>
            <td>{{{ $group->users()->count() }}}</td>
            <td>{{{ $group->created_at->diffForHumans() }}}</td>
            <td>
                <a class="btn btn-primary btn-xs"  href="{{ route('update/group', $group->id) }}"><i class="fa fa-pencil"></i></a>
                <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/group', $group->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>
</section>

{{ $groups->links() }}

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
