@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('ideas/title.shortlist') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('ideas/title.shortlist')
    <div class="pull-right">
        <a href="{{ route('unsortedlist/idea') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
    </div>
</h1>
@stop

{{-- Page content --}}
@section('content')
<p>This view is not implemented yet.</p>
<div class="widget widget-body-white widget-heading-simple">
<div class="widget-body">
{{$table->render();}}
</div>
</div>
@stop
@section('body_bottom')
{{}}
@stop