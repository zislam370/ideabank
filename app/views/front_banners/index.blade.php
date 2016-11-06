@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('front_banners/title.management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('front_banners/title.management')

    <div class="pull-right">
        <a href="{{ route('create/front_banner') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        @if ($front_banners->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>@lang('form/title.img_thumbnail')</th>
                    <th>@lang('form/title.title')</th>
                    <th>@lang('form/title.slide_title')</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($front_banners as $front_banner)
                    <tr>
                        <td>{{{ $front_banner->img_file_name }}}</td>
					<td>{{{ $front_banner->title }}}</td>
					<td>{{{ $front_banner->slide_title }}}</td>

                    <td>
                        <a class="btn btn-primary btn-xs"  href="{{ route('update/front_banner', $front_banner->id) }}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/front_banner', $front_banner->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $front_banners->links() }}
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
