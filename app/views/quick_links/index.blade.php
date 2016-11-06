@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('quick_links/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('quick_links/title.management')

    <div class="pull-right">
        <a href="{{ route('create/quick_link') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        @if ($quick_links->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>@lang('form/title.title')</th>
                    <th>@lang('form/title.link')</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($quick_links as $quick_link)
                    <tr>
                        <td>{{{ $quick_link->title }}}</td>

					<td><a href="{{route('quick_links', $quick_link->title)}}">{{{ $quick_link->link }}}</a></td>
                    <td align="right">
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/quick_link', $quick_link->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/quick_link', $quick_link->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $quick_links->links() }}
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
