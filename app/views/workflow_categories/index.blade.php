@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('workflow_categories/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('workflow_categories/title.management')

    <div class="pull-right">
        <a href="{{ route('create/workflow_category') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        @if ($workflow_categories->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>@lang('form/title.name')</th>
                    <th>@lang('form/title.Num_of_steps')</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($workflow_categories as $workflow_category)
                    <tr>
                        <td>{{{ $workflow_category->name }}}</td>
                        <td>
                            <span class="badge badge-success">{{{ $workflow_category->num_of_steps }}}</span>
                            <a class="btn btn-primary btn-xs"  href="{{ route('list/workflow_step', $workflow_category->id) }}">
                                <i class="fa fa-external-link"></i>
                            </a>
                        </td>
                        <td align="right">
                            <a class="btn btn-primary btn-xs"  href="{{ route('update/workflow_category', $workflow_category->id) }}"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/workflow_category', $workflow_category->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $workflow_categories->links() }}
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
