@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('sectors/title.edit') ::
@parent
@stop

{{-- Page content --}}
@section('content_title')
<h1>
    @lang('sectors/title.edit')
    <div class="pull-right">
        <a href="{{ route('sectors') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
    </div>
</h1>
@stop


{{-- Page content --}}
@section('content')
<section class="widget">
    <div class="panel-body">
        <div class=" form">

            <form class="apply-nolazy form-horizontal" role="form" method="post" action="">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group">
            {{ Form::label('name', Lang::get('form/title.name'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('name', Input::old('name',$sector->name), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.name'))) }}
            </div>
        </div>


                <hr/>
                <!-- Form actions -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                        <a class="btn btn-link" href="{{ route('sectors') }}">@lang('button.cancel')</a>
                        <button type="submit" class="btn btn-default">@lang('button.save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@stop