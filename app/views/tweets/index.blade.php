@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('tweets/title.management') ::
@parent
@stop

{{-- Content --}}
@section('content')
<section class="panel">

    <header class="panel-heading">
        @lang('tweet/title.management')

        <div class="pull-right">
            <a href="{{ route('create/tweet') }}" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
        </div>
    </header>
    @if ($tweets->count() >= 1) {{ $tweets->links() }}
    <table class="table table-striped table-advance table-hover">
        <thead>
        <tr>
            <th class="span6">@lang('tweet/form.author')</th>
            <th class="span6">@lang('tweet/form.body')</th>
            <th class="span6">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tweets as $tweet)
        <tr>
            <td>{{{ $tweet->author }}}</td>
            <td>{{{ $tweet->body }}}</td>
<!--            <td>-->
<!--                <a class="btn btn-primary btn-xs"  href="{{ route('update/tweet', $tweet->id) }}"><i class="fa fa-pencil"></i></a>-->
<!--                <a class="btn btn-danger btn-xs" href="{{ route('confirm-delete/tweet', $tweet->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>-->
<!--            </td>-->
        </tr>
        @endforeach

        </tbody>
    </table>
    {{ $tweets->links() }}
</section>

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
