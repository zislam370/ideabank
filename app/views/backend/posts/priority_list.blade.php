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
                    <th class="span2">@lang('admin/posts/table.created_at')</th>
                    <th class="span2">@lang('form/title.priority')</th>
                </tr>
            </thead>
            <!-- // Table heading END -->
            <!-- Table body -->
            <tbody>
            @foreach ($posts as $post)
            <tr>
                <td><a href="{{ $post->url() }}">{{ $post->title }}</a></td>
                <td>{{{ $post->created_at->diffForHumans() }}}</td>
                <td>
                    {{ Form::selectRange('priority', 0, 10,$post->priority,array('onchange'=>'set_post_priority('.$post->id.',this)')) }}
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
<script>
    $(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});
    function set_post_priority(id,t){
        var v = $(t).val();
        document.location.href= '/admin/posts/'+id+'/'+v+'/set_priority';
    }
</script>
@stop
