@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('advertisements/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('advertisements/title.management')

    <div class="pull-right">
        <a href="{{ route('create/advertisement') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        @if ($advertisements->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>@lang('ideas/form.wrokflow_category')</th>
                    <th>@lang('advertisements/form.name')</th>
				    <th>@lang('advertisements/form.Start')</th>
				    <th>@lang('advertisements/form.End')</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($advertisements as $advertisement)
                    <tr>
                        <td>{{{ $advertisement->workflow_category->name }}}</td>
					<td>{{{ $advertisement->name }}}</td>
					<td>{{{ date( 'd-m-Y', strtotime( $advertisement->start )) }}}</td>
					<td>{{{ date( 'd-m-Y', strtotime( $advertisement->end )) }}}</td>
                    <td>
                        <a href="{{ route('view/advertisement',$advertisement->id) }}" type="button" class="btn btn-success btn-xs">view</a>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/advertisement', $advertisement->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/advertisement', $advertisement->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $advertisements->links() }}
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
