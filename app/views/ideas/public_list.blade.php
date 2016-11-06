@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')
<h3 class="idbnk-header">@lang('form/title.all_ideas')</h3>
<div class="idbnk-detail">
    @if (count($ideas))
    @foreach ($ideas as $idea)
    <div class="row">
        <div class="col-lg-2">
            <img alt="Profile" class="img-circle" width="100" src="{{ asset($idea->author->avatar->url('medium')) }}">
        </div>
        <div class="col-lg-10 span8">

            <!-- Post Content -->

            <div class="media">
                <div class="media-body">
                    <h4 class="media-heading">

                        <a href="{{ URL::route('show-idea',$idea->id) }}">{{$idea->name}}</a></h4>
                        {{{ Str::limit($idea->prob_stmnt, 200) }}}
                </div>
            </div>

        </div>
    </div>

    <hr />
    @endforeach
</div>
{{ $ideas->links() }}

@else
<h1>Oops. That page number is invalid.</h1>
@endif
@stop
