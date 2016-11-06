@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('form/title.idea') ::
@parent
@stop

{{-- Page content --}}
@section('content')


<h1 class="pull-left">{{{ $idea->name }}}</h1>
<div class="innerT  pull-right">
    <a class="btn btn-primary" href="{{ route('ideas') }}">@lang('button.back_to_project')</a>
</div>
<div class="clearfix"></div>
<div class="separator"></div>
<!--<div class="widget widget-none">-->
<!--    <div class="widget-body">-->
<!--        <p class="lead">{{{ $idea->short_desc }}}</p>-->
<!--        <a class="btn btn-inverse" href="{{ route('view/idea',$idea->id) }}">@lang('button.Details')</a>-->
<!--    </div>-->
<!--</div>-->
<div class="row">
    <div class="col-md-8">

        @if (!$idea->is_opened)

        <div class="widget widget-none">
            <div class="widget-body">
                <form method="post" action="{{ route('open/idea',$idea->id) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <p class="lead">This project is not initiated yet. <button class="btn btn-success" type="submit">@lang('button.Initiate')</button></p>
                </form>
            </div>
        </div>

        @else

        <div class="row  half">
            <div class=" col-md-6 col-sm-6 col-xs-6">
                <div class="pull-left innerR half">
                    <h4>{{Lang::get('form/title.Steps')}}  </h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @if ($advert!=null)
        <div class="widget widget-warning widget-big">
        <div class="media innerAll half">
            <div class="pull-left h1 media-object hidden-xs margin-none innerR">
                <i class=" icon-compose icon-faded fa-fw"></i>
            </div>
            <div class="pull-right text-right">
                <span class="label label-success">@lang('form/title.Done')</span>
            </div>
            <div class="media-body">
                <h4>
                    <a class="" href="{{ route('view/advertisement',$advert->id) }}"> @lang('form/title.Advertisement')</a>
                </h4>
                <p>
                    <span class="label label-success label-stroke">{{{ $idea->category->name }}}</span>

                    (<i>
                     @lang('form/title.advert_date')
                    : {{{date( 'd-m-Y', strtotime( $advert->start ))}}} - {{{date( 'd-m-Y', strtotime( $advert->end ))}}}
                    </i>)
                    <p>@lang('form/title.submission_date') :
                        {{{ date( 'd-m-Y', strtotime( $advert->created_at )) }}}
                    </p>
                </p>
            </div>
            </div>
            </div>
            @endif
        <div class="widget widget-success widget-big">
            <div class="media innerAll half">
                <div class="pull-left h1 media-object hidden-xs margin-none innerR">
                    <i class=" icon-compose icon-faded fa-fw"></i>
                </div>
                <div class="pull-right text-right">
                    <span class="label label-success">@lang('form/title.Done')</span>
                </div>
                <div class="media-body">
                    <h4>
                        <a class="" href="{{ route('view/idea',$idea->id) }}"> @lang('form/title.initial_proposal')</a>
                    </h4>
                    <p>@lang('form/title.submission_date') :
                        {{{ date( 'd-m-Y', strtotime( $idea->created_at )) }}}
                    </p>
                </div>
            </div>
        </div>
        @foreach ($idea->steps as $step)


        <div class="widget widget-primary widget-small">
            <div class="media innerAll half">
                <div class="pull-left h1 media-object hidden-xs margin-none innerR">
                    <i class=" icon-compose icon-faded fa-fw"></i>
                </div>
                <div class="pull-right text-right">
                    @if($step->is_closed)
                    <span class="label label-success">@lang('form/title.Done')</span>
                    @else
                    <span class="label label-info">@lang('form/title.In_Progress')</span>
                    @endif
                    <div class="strong text-muted innerT half">
                        {{{$step->workflow_step->num_of_activities}}} {{Lang::get('form/title.Activity')}}
                    </div>
                </div>

                <div class="media-body">
                    <h4>
                        <a class=""  data-toggle="collapse" href="#task{{{$step->workflow_step->step_no}}}" > {{{$step->workflow_step->name}}}</a>
                        @if (!$step->is_closed)
                        <div class="pull-right">
                            <a href="#modal-close-step" data-toggle="modal" class="btn btn-danger"> <i class="fa fa-cross"></i> @lang('button.close')</a>
                        </div>
                        <!-- CREATE TASK MODAL -->
                        <div class="modal fade" id="modal-close-step">

                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal heading -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h3 class="modal-title">{{Lang::get('ideas/form.Close_Step')}}</h3>
                                    </div>
                                    <!-- // Modal heading END -->

                                    <!-- Modal body -->
                                    <div class="modal-body">

                                        <div class="innerAll">
                                            <form class="margin-none innerLR inner-2x" method="post" action="{{ route('close/idea_step',$step->id) }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <p>{{Lang::get('ideas/form.Confirm_close_step')}}</p>
                                                @if (!empty($next_steps))
                                                <div class="form-group">
                                                    <label class="control-label">@lang('form/title.Next_step')</label>
                                                    {{ Form::select('next_step', $next_steps,null, array('class'=>'selectpicker')) }}
                                                </div>
                                                @endif
                                                <div class="text-center innerAll">
                                                    <a href="" class="btn btn-default" data-dismiss="modal" aria-hidden="true">@lang('button.cancel')</a>
                                                    <button class="btn btn-danger" type="submit">@lang('button.ok')</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    <!-- // Modal body END -->

                                </div>
                            </div>

                        </div>
                        <!-- // Modal END -->
                        @endif
                    </h4>
                    <div class="innerR">

<!--                        @if($step->due_date)-->
<!--                        <span class="strong">@lang('form/title.Due_date')</span>-->
<!--                        <span> </span>-->
<!--                        @endif-->
                    </div>

                </div>
            </div>
            @if($step->workflow_step->step_no==$last_step_no)
            <ul id="task{{{$step->workflow_step->step_no}}}" class="list-group bg-gray border-top collapse in">
            @else
            <ul id="task{{{$step->workflow_step->step_no}}}" class="list-group bg-gray border-top collapse">
            @endif
                @foreach ($step->activities as $activity)
                <li class="list-group-item">
                    <a class="text-regular strong" href="{{ route('show/idea_step_activity',$activity->id) }}">
                        @if($activity->is_opened && $activity->is_closed)
                        <i class="fa fa-check-square-o  fa-fw"></i>
                        @else
                        <i class="fa fa-check-square-o icon-faded  fa-fw"></i>
                        @endif
                        {{{$activity->workflow_step_activity->name}}}
                        &nbsp
                        <span>@lang('form/title.submission_date') :
                            {{{ date( 'd-m-Y', strtotime( $activity->created_at )) }}}
                        </span>

                    </a>
                    @if($activity->is_opened && $activity->is_closed)
                    <span class="label label-success pull-right">@lang('form/title.Done')</span>
                    @elseif($activity->is_opened)
                    <span class="label label-info pull-right">@lang('form/title.Initiated')</span>
                    @else
                    <span class="label label-danger pull-right">@lang('form/title.Not_Initiated_Yet')</span>
                    @endif

                </li>
                @endforeach
                @foreach ($undone_activities as $activity)
                <li class="list-group-item">

                        <i class="fa fa-check-square-o  icon-faded  fa-fw"></i>
                        {{{$activity->name}}}
                        <span class="label label-inverse pull-right">@lang('form/title.In_Active')</span>
                </li>
                @endforeach
            </ul>
        </div>

        @endforeach

        @foreach ($undone_steps as $step)


        <div class="widget widget-primary widget-small">
            <div class="media innerAll half">
                <div class="pull-left h1 media-object hidden-xs margin-none innerR">
                    <i class=" icon-alarm-clock icon-faded fa-fw"></i>
                </div>
                <div class="pull-right text-right">
                    <span class="label label-inverse">@lang('form/title.In_Active')</span>
                    <div class="strong text-muted innerT half">
                        {{{$step->num_of_activities}}} {{Lang::get('form/title.Activity')}}
                    </div>
                </div>

                <div class="media-body">
                    <a class=""  data-toggle="collapse" href="#task{{{$step->step_no}}}" href="#"> {{{$step->name}}}</a>

                </div>
            </div>
            <ul id="task{{{$step->step_no}}}" class="list-group bg-gray border-top collapse">
                @foreach ($step->activities as $activity)
                <li class="list-group-item">
                    <i class="fa fa-check-square-o  icon-faded  fa-fw"></i>
                    {{{$activity->name}}}
                    <span class="label label-inverse pull-right">@lang('form/title.In_Active')</span>
                </li>
                @endforeach
            </ul>
        </div>

        @endforeach





        @endif

    </div>

    <div class="col-md-4">

    @if ($idea->is_opened && !$idea->is_closed)
    @if (($idea->activities_done*100/$idea->total_activities)==100)
    <div class="widget widget-info widget-small">
        <div class="widget-body padding-none">
            <div class="media innerAll margin-none border-bottom">
                <div class="pull-left"></div>
                <div class="media-body innerT half">
                    <form method="get" action="{{ route('close/idea',$idea->id) }}">
                        <button class="btn btn-danger" type="submit">@lang('form/title.Close_the_project')</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @endif
    @endif

        @if ($idea->is_opened)
        <div class="widget widget-primary widget-small">
            <div class="widget-head">
                <div class="heading">@lang('form/title.Project_Overview')
                    <div class="pull-right">
                        <a href="#modal-exit-idea" data-toggle="modal" class="btn btn-danger btn-sm"> <i class="fa fa-cross"></i> @lang('button.idea_stop')</a>
                    </div>
                </div>
            </div>
            <div class="widget-body">
                <div class="row">
                    <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Type')</div></div>
                    <div class="col-xs-7 text-inverse"><div class="innerB half"><span class="label label-success label-stroke">
                            {{{ $idea->category->name }}}
                            </span></div></div>
                    @if ($advert!=null)
                    <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.advert_date')</div></div>
                        <div class="col-xs-7 text-inverse"><div class="innerB half">
                             {{{date( 'd-m-Y', strtotime( $advert->start ))}}} -
                             {{{date( 'd-m-Y', strtotime( $advert->end ))}}}
                        </div>
                    </div>
                    @endif
                    <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Status')</div></div>
                    <div class="col-xs-7 text-inverse"><div class="innerB half">
                            @if ($idea->is_opened==null && $idea->is_sorted==null)
                            <span class="badge badge-primary">@lang('form/title.Processing')</span>
                            @elseif ($idea->is_opened==null && $idea->is_sorted)
                            <span class="badge badge-primary">@lang('form/title.Sorted')</span>
                            @elseif ($idea->is_accepted && $idea->is_sorted)
                            <span class="badge badge-success">@lang('form/title.Accepted')</span>
                            @elseif ($idea->is_rejected && $idea->is_sorted)
                            <span class="badge badge-danger">@lang('form/title.Rejected')</span>
                            @elseif ($idea->is_funded && $idea->is_sorted)
                            <span class="badge badge-info">@lang('form/title.Funded')</span>
                            @elseif ($idea->is_opened && $idea->is_closed)
                            <span class="badge badge-success">@lang('form/title.Completed')</span>
                            @else
                            <span class="badge badge-warning">@lang('form/title.In_Progress')</span>
                            @endif
                    </div></div>
                    @if($idea->sort_date)
                    <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Sort_Date')</div></div>
                    <div class="col-xs-7 text-inverse"><div class="innerB half">
                            {{{date( 'd-m-Y', strtotime( $idea->sort_date ))}}}
                        </div></div>
                    @endif
                    @if($idea->open_date)
                    <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Initiate_date')</div></div>
                    <div class="col-xs-7 text-inverse"><div class="innerB half">
                            {{{date( 'd-m-Y', strtotime( $idea->open_date ))}}}
                        </div></div>
                    @endif
                    <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Activity')</div></div>
                    <div class="col-xs-7 text-inverse"><div class="innerB half">
                            <span class="badge badge-info">{{{ $idea->total_activities }}}</span>
                    </div></div>
                    @if ($idea->sectors)
                    <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.sector')</div></div>
                    <div class="col-xs-7 text-inverse"><div class="innerB half">
                            {{$idea->sectors}}
                        </div>
                    </div>
                    @endif
                    @if ($idea->area)
                    <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.location')</div></div>
                    <div class="col-xs-7 text-inverse"><div class="innerB half">
                            {{ $idea->division?$idea->area->name:'' }}
                        </div>
                    </div>
                    @endif
                    @if ($idea->office)
                    <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.office')</div></div>
                    <div class="col-xs-7 text-inverse"><div class="innerB half">
                            {{ $idea->division?$idea->office->name:'' }}
                        </div>
                    </div>
                    @endif
                    <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Progress')</div></div>
                    <div class="col-xs-7 text-inverse"><div class="innerB half">
                            <div class="progress progress-mini set-width">
                                <div style="width: {{{$idea->activities_done*100/$idea->total_activities}}}%;" class="progress-bar progress-bar-primary"></div>
                            </div>
                    </div></div>

                    <!-- CREATE TASK MODAL -->
                    <div class="modal fade" id="modal-exit-idea">

                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal heading -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3 class="modal-title">{{Lang::get('ideas/form.exit_idea')}}</h3>
                                </div>
                                <!-- // Modal heading END -->

                                <!-- Modal body -->
                                <div class="modal-body">

                                    <div class="innerAll">
                                        <form class="margin-none innerLR inner-2x" method="post" action="{{ route('exit/idea',$idea->id) }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <p>{{Lang::get('ideas/form.confirm_exit_idea')}}</p>
                                            <div class="text-center innerAll">
                                                <a href="" class="btn btn-default" data-dismiss="modal" aria-hidden="true">@lang('button.cancel')</a>
                                                <button class="btn btn-danger" type="submit">@lang('button.ok')</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <!-- // Modal body END -->

                            </div>
                        </div>

                    </div>
                    <!-- // Modal END -->

                </div>
            </div>
        </div>
        @endif
        <div class="widget widget-info widget-small">
            <div class="widget-head">
                <div class="heading">@lang('form/title.Initiator')</div>
            </div>
            <div class="widget-body padding-none">

                <div class="media innerAll margin-none">
                    <div class="pull-left">
                        <img width="40" class="img-circle media-object" alt="people" src="{{ asset($idea->author->avatar->url('thumb')) }}"></div>
                    <div class="media-body innerT half">
                        <a href="{{ route('user/profile',$idea->author->id) }}">{{{$idea->author->first_name}}}</a> ({{{$idea->author->mobile}}})
                    </div>
                </div>
            </div>
        </div>
        <div class="widget widget-info widget-small">
            <div class="widget-head">
                <div class="heading">@lang('form/title.owner')
                    <div class="pull-right">
                        <a href="{{route('idea_owners',$idea->id)}}" data-toggle="modal" class="btn btn-success btn-sm"> <i class="fa fa-cross"></i> @lang('button.add')</a>
                    </div>
                </div>
            </div>
            <div class="widget-body padding-none">

                @foreach($owners as $owner)
                <div class="media innerAll margin-none">
                    <div class="pull-left">
                        <img width="40" class="img-circle media-object" alt="owner" src="{{ asset($owner->owner->avatar->url('thumb')) }}"></div>
                    <div class="media-body innerT half">
                        <a href="{{ route('user/profile',$owner->owner->id) }}">{{{$owner->owner->first_name}}}</a> ({{{$owner->owner->mobile}}})
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="widget widget-info widget-small">
            <div class="widget-head">
                <div class="heading">@lang('form/title.cio')
                    <div class="pull-right">
                        <a href="{{route('idea_cios',$idea->id)}}" data-toggle="modal" class="btn btn-success btn-sm"> <i class="fa fa-cross"></i> @lang('button.add')</a>
                    </div>
                </div>
            </div>
            <div class="widget-body padding-none">
                @foreach($cio as $_cio)
                <div class="media innerAll margin-none">
                    <div class="pull-left">
                        <img width="40" class="img-circle media-object" alt="cio" src="{{ asset($_cio->cio->avatar->url('thumb')) }}"></div>
                    <div class="media-body innerT half">
                        <a href="{{ route('user/profile',$_cio->cio->id) }}">{{{$_cio->cio->first_name}}}</a> ({{{$_cio->cio->mobile}}})
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="widget widget-info widget-small">
            <div class="widget-head">
                <div class="heading">@lang('form/title.mentor')
                    <div class="pull-right">
                        <a href="{{route('idea_mentors',$idea->id)}}" data-toggle="modal" class="btn btn-success btn-sm"> <i class="fa fa-cross"></i> @lang('button.add')</a>
                    </div>
                </div>
            </div>
            <div class="widget-body padding-none">
                @foreach($mentors as $mentor)
                <div class="media innerAll margin-none">
                    <div class="pull-left">
                        <img width="40" class="img-circle media-object" alt="mentor" src="{{ asset($mentor->mentor->avatar->url('thumb')) }}"></div>
                    <div class="media-body innerT half">
                        <a href="{{ route('user/profile',$mentor->mentor->id) }}">{{{$mentor->mentor->first_name}}}</a> ({{{$mentor->mentor->mobile}}})
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @if ($idea->is_opened)
<!--        <div class="widget">-->
<!--            <div class="widget-head">-->
<!--                <div class="heading">@lang('form/title.Activities_History')</div>-->
<!--            </div>-->
<!--            <div class="widget-body padding-none ">-->
<!---->
<!--            </div>-->
<!--        </div>-->
        @endif
    </div>
</div>

@stop
