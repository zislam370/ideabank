@extends('backend/layouts/default')
{{-- Web site Title --}}
@section('title')
@lang('ideas/title.management') ::
@parent
@stop
{{-- Content --}}
@section('content')
<h1 class="pull-left">@lang('form/title.completed_ideas')</h1>
<div class="pull-right innerT">
    <div class="btn-group">
        <a class="btn btn-inverse" href="{{ route('ideas') }}"><i class="fa fa-list"></i></a>
        <!--        <a class="btn btn-default filled" href="{{ route('listgrid/idea') }}"><i class="fa fa-th"></i></a>-->
    </div>
</div>
<div class="clearfix"></div>
<div class="innerTB">
    <form method="get" action="" class="">
        <div class="form-group">
            <div class="input-group">
                <input name="name" type="text" placeholder="@lang('form/title.Idea_Name')" class="form-control">
                <div class="input-group-btn"><button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button></div>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default" onclick="showOptions();">@lang('form/title.Options')</button>
                </div>
            </div>
        </div>
        <div class="widget widget-heading-simple widget-body-white" id="options" style="display: none;">
            <div class="widget-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="strong">@lang('form/title.Idea_Category')</label>
                        {{ Form::select('advertisement_id',  array(''=>'All')+$workflow_categories , Input::old('advertisement_id'), array('class'=>'form-control')) }}
                        <div class="separator bottom"></div>
                    </div>
                    <div class="col-md-12">
                        <label class="strong">@lang('form/title.Applicant_Name')</label>
                        <input name="first_name" type="text" placeholder="@lang('form/title.Applicant_Name')" class="form-control span8">
                        <div class="separator bottom"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="strong">@lang('form/title.Submission_From')</label>
                        <input name="sub_from" type="text" placeholder="dd/mm/yyyy" class="datepicker1 form-control span8">
                        <div class="separator bottom"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="strong">@lang('form/title.Submission_To')</label>
                        <input name="sub_to" type="text" placeholder="dd/mm/yyyy" class="datepicker1 form-control span8">
                        <div class="separator bottom"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="form-actions pull-right">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i>@lang('form/title.Search')</button>
                            <button class="btn btn-default" type="button" onclick="showOptions();"><i class="fa fa-times"></i>@lang('form/title.Close')</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@if (sizeof($ideas) >= 1)
<div class="innerTB">
    {{ $ideas->appends(Input::except('page'))->links() }}
    <div class="separator bottom"></div>
    @foreach ($ideas as $idea)
    <div class="">
        <div class="col-md-12 widget widget-inverse widget-small ">
            <div class="widget-body padding-none">
                <div class=" media innerAll overflow-visible margin-none">
                    <div class="pull-left innerR half hidden-xs">
                        <i class="icon-light-bulb fa-4x icon-faded"></i>
                    </div>
                    <div class="widget widget-none innerR innerB half margin-slim pull-right">
                        <div class="media-body innerT half">
                            <div class="pull-right" style="margin-left:5px ">
                                <img width="40" class="img-circle media-object" alt="people" src="{{ asset($idea->author->avatar->url('thumb')) }}">
                            </div>
                            <div class="pull-left">
                                <a href="{{ route('user/profile',$idea->author->id) }}">{{{$idea->author->first_name}}}</a><br/>
                                @if ($idea->author->user_type=="Organization")
                                {{{$idea->author->office_name}}}<br/>
                                @endif
                                <a href="tel:{{{$idea->author->mobile}}}"><i class="fa fa-phone"></i> {{{$idea->author->mobile}}}</a><br/>
                                @if ($idea->author->email)
                                <a href="mailto:{{{$idea->author->email}}}"><i class="fa fa-envelope"></i> {{{$idea->author->email}}}</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="media-body">
                        <h4><a class="media-heading" href="{{ route('detail/idea',$idea->id) }}">{{{ $idea->name }}}</a>
                        </h4>
                    <span class="label label-success label-stroke">
                            {{{ $idea->category->name }}}
                        </span>
                        @if ( $idea->advertisement!=null)
                        (<i>
                            @lang('form/title.advert_date')
                            : {{{date( 'd-m-Y', strtotime( $idea->advertisement->start ))}}} - {{{date( 'd-m-Y', strtotime( $idea->advertisement->end ))}}}
                        </i>)
                        @endif
                        <div class="clearfix"></div>
                        <span class="strong"> @lang('form/title.submission_date') </span>
                        : <span>
                      <?php echo date( 'd-m-Y', strtotime( $idea->created_at ) )?>
                          </span>
                        <div class="clearfix"></div>
                        <div class="widget widget-none innerR innerB half margin-slim pull-left">
                            <span class="pull-left strong">@lang('form/title.duration')</span> :
                            <span class="badge badge-info badge-stroke">{{{$idea->duration?$idea->duration:'0'}}} মাস</span>
                        </div>
                        <div class="widget widget-none innerR innerB half margin-slim pull-left">
                            <span class="strong"> @lang('form/title.Status')</span>
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
                        </div>
                        <div class="widget widget-none innerR innerB half margin-slim pull-left">
                            @if ($idea->total_activities)
                            <span class="pull-left strong">@lang('form/title.Progress')</span>
                            <div class="progress progress-mini set-width">
                                <div style="width: {{{$idea->activities_done*100/$idea->total_activities}}}%;" class="progress-bar progress-bar-primary"></div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="separator bottom"></div>
    {{ $ideas->appends(Input::except('page'))->links() }}
</div>
<!-- $ideas->links() -->
@else
@lang('general.noresults')
@endif
@stop
@section('body_bottom')
<script>
    $( document ).ready(function() {
        $(".datepicker1").datepicker({
            format: 'dd/mm/yyyy'
        });
    });
</script>
@stop
