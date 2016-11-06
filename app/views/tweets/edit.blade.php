@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('tweets/title.edit') ::
@parent
@stop

{{-- Page content --}}

@section('content')
<section class="panel">
    <header class="panel-heading">
        @lang('tweets/title.edit')
        <div class="pull-right">
            <a href="{{ route('tweets') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
        </div>
    </header>
    <div class="panel-body">
        <div class=" form">

            <form class="form-horizontal" role="form" method="post" action="">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <!-- Author -->
                <div class="form-group {{ $errors->first('author', 'has-error') }}">
                    <label for="author" class="col-sm-2 control-label">@lang('tweet/form.author')</label>
                    <div class="col-sm-5">
                        <input type="text" id="author" name="author" class="form-control" placeholder="Author" value="{{{ Input::old('author', $tweet->author) }}}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('author', '<span class="help-block">:message</span>') }}
                    </div>
                </div>

                <!-- Author -->
                <div class="form-group {{ $errors->first('body', 'has-error') }}">
                    <label for="body" class="col-sm-2 control-label">@lang('tweet/form.body')</label>
                    <div class="col-sm-5">
                        <textarea id="body" name="body" class="form-control" placeholder="Body">{{{ Input::old('body', $tweet->body) }}}</textarea>
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('body', '<span class="help-block">:message</span>') }}
                    </div>
                </div>




                <hr/>
                <!-- Form actions -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                        <a class="btn btn-link" href="{{ route('tweets') }}">@lang('button.cancel')</a>
                        <button type="submit" class="btn btn-default">@lang('button.save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@stop

