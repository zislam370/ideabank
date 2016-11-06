@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')
<h3 class="idbnk-header">@lang('form/title.all_innovation_news')</h3>
<div class="idbnk-detail">
@if (count($posts))
@foreach ($posts as $post)
<div class="row">
    <div class="span8">

        <!-- Post Content -->

        <div class="media">
          <a class="pull-left" href="{{{ $post->url() }}}">
                <img width="60" class="media-object" src="{{ asset($post->img->url('original')) }}" alt="...">
          </a>
          <div class="media-body">
            <h4 class="media-heading"><a href="{{{ $post->url() }}}">{{{ $post->title }}}</a></h4>
            {{{ Str::limit($post->short_description, 200) }}}
          </div>
          <div class="media-footer">
                <p></p>
                <p>
                    <i class="icon-user"></i> by
                    @if ($post->author) {{{ $post->author->first_name }}}
                     @else
                        discontinued user
                     @endif
                    | <i class="icon-calendar"></i> {{{ $post->created_at->diffForHumans() }}}
                    | <i class="icon-comment"></i> <a href="{{ $post->url() }}#comments">Comments
                    <span class="badge">{{ $post->comments()->count() }}</span></a>
                </p>
            </div>
        </div>

    </div>
</div>

<hr />
@endforeach
</div>
{{ $posts->links() }}

@else
<h1>Oops. That page number is invalid.</h1>
@endif
@stop
