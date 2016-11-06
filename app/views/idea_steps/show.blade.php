@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Idea-Step ::
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="innerT  pull-right">
    <a class="btn btn-primary" href="{{ route('show/idea',$idea_step->idea->id) }}">@lang('button.Back_to_project')</a>
</div>
<h1>{{{$idea_step->workflow_step->name}}}</h1>
<div class="separator"></div>


<div class="row">
    @if (!$idea_step->is_opened)


    <div class="col-md-9">
    <div class="widget widget-none">
        <div class="widget-body">
            <form method="post" action="{{ route('open/idea_step',$idea_step->id) }}">
                <p class="lead">This step is not initiated yet. Please enter the due date to initiate.</p>
                    {{ Form::label('due_date', Lang::get('form/title.Due_date'), array('class'=>'col-md-2 control-label')) }}
                <div class="col-md-4">
                     {{ Form::input('text', 'due_date', Input::old('due_date'), array('class'=>'form-control datepicker1')) }}
                </div>
                <button class="btn btn-success" type="submit">@lang('form/title.Initiated')</button>
            </form>
        </div>
    </div>
    </div>


    @else

    <div class="col-md-8">
    <div class="widget widget-primary widget-small">
        <div class="widget-body">
            <div class="innerT">
                <h4 class="strong innerB half">@lang('form/title.Activity')</h4>
                <ul class="list-group bg-gray margin-none">
                    @foreach ($activities as $activity)
                    <li class="list-group-item">
                        <label class="">

                             <a href="{{ route('show/idea_step_activity',$activity->id) }}"><i class="fa fa-check-square-o checked"></i>
                                 {{{$activity->workflow_step_activity->name}}}</a>
                        </label>
                    </li>
                    @endforeach
                </ul>
                <!-- END CHECKLIST -->

            </div>
            <!--  END ROW CHECKLIST -->

        </div>
    </div>

</div>

<div class="col-md-4">
    @if ($idea_step->is_opened && !$idea_step->is_closed)
    <div class="widget widget-info widget-small">
        <div class="widget-body padding-none">
            <div class="media innerAll margin-none border-bottom">
                <div class="pull-left"></div>
                <div class="media-body innerT half">
                    @if (!empty($next_steps))
                    <a data-toggle="collapse" class="btn btn-primary btn-stroke" href="#close_step"> @lang('form/title.Close_the_step')</a>
                    <div id="close_step" class="collapse" style="margin-top: 10px;">
                        <form method="post" action="{{ route('close/idea_step',$idea_step->id) }}">
                            {{ Form::select('next_step', $next_steps) }}
                            <button class="btn btn-danger" type="submit">@lang('button.close')</button>
                        </form>
                    </div>
                    @else
                    <form method="post" action="{{ route('close/idea_step',$idea_step->id) }}">
                        <button class="btn btn-danger" type="submit">@lang('button.close')</button>
                    </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
    @endif
    <div class="widget widget-primary widget-small">
        <div class="widget-head">
            <div class="heading">@lang('form/title.Step_Overview')</div>
        </div>
        <div class="widget-body">
            <div class="row">
                <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Initiate_date')</div></div>
                <div class="col-xs-7 text-inverse"><div class="innerB half">{{{$idea_step->initiate_date}}}</div></div>
                <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Due_date')</div></div>
                <div class="col-xs-7 text-inverse"><div class="innerB half">{{{$idea_step->due_date}}}</div></div>
                <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Current_Activity')</div></div>
                <div class="col-xs-7 text-inverse"><div class="innerB half">1</div></div>
                <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Pending')</div></div>
                <div class="col-xs-7 text-inverse"><div class="innerB half">0</div></div>
            </div>
        </div>
    </div>
</div>
    @endif
</div>

@stop
