@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Create a Tweet ::
@parent
@stop

{{-- Page content --}}
@section('content')

<section class="panel">
    <header class="panel-heading">
        @lang('tweets/title.create')
        <small>@lang('tweets/title.createsub')</small>
    </header>
    <div class="panel-body">
        <div class=" form">
            <form class="form-horizontal" role="form" method="post" action="" autocomplete="off">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group">
            {{ Form::label('author', Lang::get('form/title.Author'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('author', Input::old('author'), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.Author'))) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('body', Lang::get('form/title.Body'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('body', Input::old('body'), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.Body'))) }}
            </div>
        </div>


                <hr>

                <!-- Form actions -->
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-default">@lang('form/title.save')</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>
@stop


