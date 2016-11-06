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
<div class="row">
<div class="col-md-12">

@if ($idea->is_exited)
<div class="widget widget-none">
    <div class="widget-body">
        <a href="#modal-reopen-idea" data-toggle="modal" class="btn btn-danger btn-sm"> <i class="fa fa-cross"></i> @lang('button.idea_reopen')</a>
    </div>
</div>
<!-- CREATE TASK MODAL -->
<div class="modal fade" id="modal-reopen-idea">

    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">{{Lang::get('ideas/form.idea_reopen')}}</h3>
            </div>
            <!-- // Modal heading END -->

            <!-- Modal body -->
            <div class="modal-body">

                <div class="innerAll">
                    <form class="margin-none innerLR inner-2x" method="post" action="{{ route('reopen/idea',$idea->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <p>{{Lang::get('ideas/form.confirm_reopen_idea')}}</p>
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
@elseif(!$idea->is_opened)

<div class="widget widget-none">
    <div class="widget-body">
        <form method="post" action="{{ route('open/idea',$idea->id) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <p class="lead">This project is not initiated yet. <button class="btn btn-success" type="submit">@lang('button.Initiate')</button></p>
        </form>
    </div>
</div>

@else



<div class="widget widget-none">
    <div class="row ">
        <div class="col-sm-4">
            <div class="innerAll">
                <div class="heading">@lang('form/title.Initiator')</div>
                <div class="col-xs-12 text-muted-dark"><div class="innerB half">
                        <img width="40" class="img-circle media-object" alt="people" src="{{ asset($idea->author->avatar->url('thumb')) }}">
                </div></div>
                <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('account/form.mobile')</div></div>
                <div class="col-xs-7 text-inverse"><div class="innerB half">
                            {{{ $idea->author->mobile }}}
                            </div></div>
                <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('account/form.email')</div></div>
                <div class="col-xs-7 text-inverse"><div class="innerB half">
                            {{{ $idea->author->email }}}
                            </div></div>
                <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('account/form.address')</div></div>
                <div class="col-xs-7 text-inverse"><div class="innerB half">
                            {{{ $idea->author->address }}}
                            </div></div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="innerAll ">
                <div class="heading">@lang('form/title.Project_Overview')</div>
                <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Type')</div></div>
                <div class="col-xs-7 text-inverse"><div class="innerB half"><span class="label label-success label-stroke">
                            {{{ $idea->category->name }}}
                            </span></div></div>
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
                        {{{ $idea->sort_date }}}
                    </div></div>
                @endif
                @if($idea->open_date)
                <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Initiate_date')</div></div>
                <div class="col-xs-7 text-inverse"><div class="innerB half">
                        {{{ $idea->open_date }}}
                    </div></div>
                @endif
                <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Activity')</div></div>
                <div class="col-xs-7 text-inverse"><div class="innerB half">
                        {{{ $idea->total_activities }}}
                    </div></div>
                <div class="col-xs-5 text-muted-dark"><div class="innerB half">@lang('form/title.Progress')</div></div>
                <div class="col-xs-7 text-inverse"><div class="innerB half">
                            <div style="" >
                                {{{$idea->activities_done*100/$idea->total_activities}}}%
                            </div>
                    </div></div>
            </div>
        </div>

        @if ($advert!=null)
        <div class="col-sm-4">
            <div class="innerAll ">
                <div class="heading">@lang('form/title.Advertisement')</div>
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
                <div class="col-xs-5 text-muted-dark">
                    <div class="innerB half">@lang('form/title.Status')</div></div>
                <div class="col-xs-7 text-inverse"><div class="innerB half">
                        <span class="label label-success">@lang('form/title.Done')</span>
                    </div>
                </div>

            </div>
        </div>
        @endif
    </div>
</div>





<div class="widget">

    <!-- Widget heading -->
    <div class="widget-head">
        <h4 class="heading">{{Lang::get('form/title.Steps')}}</h4>
    </div>
    <!-- // Widget heading END -->

    <div class="widget-body innerAll ">

        <!-- Table -->
        <table class="table table-bordered table-white">

            <!-- Table body -->
            <tbody>
            @foreach ($idea->steps as $step)
                <!-- Table row -->
                <tr>
                    <td>
                        <div class="strong innerT half">
                            <div style="display: inline-block; font-size: 16px; color: rgb(63, 182, 24) !important;">{{{$step->workflow_step->name}}}</div>

                            @if($step->is_closed)
                            <span class="label label-success">@lang('form/title.Done')</span>
                            @else
                            <span class="label label-info pull-right">@lang('form/title.In_Progress')</span>
                            @endif
                            <div class="text-muted ">
                                {{{$step->workflow_step->num_of_activities}}} {{Lang::get('form/title.Activity')}}
                            </div>
                        </div>
                    </td>
                </tr>
                <!-- // Table row END -->
                <tr>
                    <td>
                        <table  class="table table-bordered table-striped table-white">
                            @foreach ($step->activities as $activity)
                            <tr>
                                <td>

                                <a class="text-regular strong" href="javascript:;" style="font-size: 14px; color: #683091 !important">
                                    <i class="fa fa-arrow-right  fa-fw"></i>
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
                                    <?php $forms = json_decode($activity->activity_form_ids);?>
                                    <table class="table table-bordered table-white">
                                        @foreach ($forms as $form)
                                        <tr>
                                            <td>
                                                <h5><i class="fa fa-file-text  fa-fw"></i> {{$form->title}}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="form-{{$activity->id}}-{{$form->id}}">
                                                <script>
                                                    $(function() {
                                                        $.ajax({
                                                            url: "{{route('activity_form_view',array($form->id,$activity->id))}}",
                                                            success: function(data){
                                                                $('#form-{{$activity->id}}-{{$form->id}}').html(data);
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </td>
                            </tr>
                            @endforeach
                            @foreach ($undone_activities as $activity)
                            <tr>
                                <td>
                                    <i class="fa fa-arrow-right  fa-fw"></i>
                                    {{{$activity->name}}}
                                    <span class="label label-inverse pull-right">@lang('form/title.In_Active')</span>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            @endforeach

            @foreach ($undone_steps as $step)

            <!-- Table row -->
            <tr>
                <td>
                    <div class="strong innerT half">
                        {{{$step->name}}}

                        <span class="label label-inverse">@lang('form/title.In_Active')</span>
                        <div class="text-muted">
                            {{{$step->num_of_activities}}} {{Lang::get('form/title.Activity')}}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <table  class="table table-bordered table-striped table-white">
                        @foreach ($step->activities as $activity)
                        <tr>
                            <td>
                                <i class="fa fa-arrow-right  fa-fw"></i>
                                {{{$activity->name}}}
                                <span class="label label-inverse pull-right">@lang('form/title.In_Active')</span>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>


            @endforeach


            </tbody>
            <!-- // Table body END -->

        </table>
        <!-- // Table END -->

    </div>
</div>






@endif

</div>


</div>


@stop
