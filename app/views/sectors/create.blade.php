@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Create a Sector ::
@parent
@stop

{{-- Page content --}}
@section('content_title')
<h1>
    @lang('sectors/title.create')
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
            <form class="apply-nolazy form-horizontal" role="form" method="post" action="" autocomplete="off">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group">
            {{ Form::label('name', Lang::get('form/title.name'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('name', Input::old('name'), array('class'=>'form-control', 'placeholder'=>Lang::get('sectors/form.name'))) }}
            </div>
        </div>


                <hr>

                <!-- Form actions -->
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-default">@lang('button.save')</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>
@stop


