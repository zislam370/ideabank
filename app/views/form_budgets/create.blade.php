@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Create a Form_budget ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form_budgets/title.create')

    <div class="pull-right">
        <a href="{{ route('show/idea_step_activity',$activity->id) }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back to activity</a>
    </div>
</h1>
@stop


{{-- Page content --}}
@section('content')

<form autocomplete="off" method="post" class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Widget -->
    <div class="widget">

        <!-- Widget heading -->
        <div class="widget-head">
            <h4 class="heading">@lang('form_budgets/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->
        {{ Form::hidden( 'idea_id', Input::old('idea_id',$activity->idea_id), array('class'=>'form-control')) }}
        {{ Form::hidden( 'step_id', Input::old('step_id',$activity->idea_step_id), array('class'=>'form-control')) }}
        {{ Form::hidden( 'activity_id', Input::old('step_id',$activity->id), array('class'=>'form-control')) }}

        <div class="widget-body innerAll inner-2x">

        <table class="table table-bordered table-striped table-white">
            <?php $i = 0;?>
            @foreach ($heads as $head)
            <tr>
                <td>
                    {{{$head->name}}} <input type="hidden" name="budget[{{{$i}}}][head_id]" value="{{{$head->id}}}">
                </td>
                <td>
                    <input type="text" name="budget[{{{$i}}}][amount]" placeholder="Amount" class="form-control">
                </td>
                <td>
                    <input type="text" name="budget[{{{$i}}}][comment]" placeholder="Comment" class="form-control">
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </table>



            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('form_budgets') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.submit')</button>
            </div>

        </div>
    </div>
</form>
@stop


