@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/posts/title.blogmanagement') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('admin/posts/title.blogmanagement')

    <div class="pull-right">
        <a href="{{ route('create/post') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
    </div>
</h1>
@stop

{{-- Page content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">

        <!-- Table -->
        <table class="table table-bordered table-primary">
            <!-- Table heading -->
            <thead>
                <tr>
                    <th class="span6">@lang('admin/posts/table.title')</th>
                    <th class="span1"><i class="fa fa-comments"></i></th>
                    <th class="span2">@lang('admin/posts/table.created_at')</th>
                    <th class="span2"></th>
                </tr>
            </thead>
            <!-- // Table heading END -->
            <!-- Table body -->
            <tbody>
            @foreach ($posts as $post)
            <tr>
                <td><a href="{{ $post->url() }}">{{ $post->title }}</a></td>
                <td>{{{ $post->comments()->count() }}}</td>
                <td>{{{ $post->created_at->diffForHumans() }}}</td>
                <td>
                    <a href="{{ route('update/post', $post->id) }}"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="{{ route('confirm-delete/post', $post->id) }}" data-toggle="modal" data-target="#delete_confirm"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
            @endforeach
            </tbody>
            <!-- // Table body END -->
        </table>
        <!-- // Table END -->
        {{ $posts->links() }}
    </div>
</div>




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
