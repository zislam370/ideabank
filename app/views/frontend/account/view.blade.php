@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
@lang('ideas/title.view') ::
@parent
@stop





{{-- Page content --}}
@section('account-content')
<style>
    .cntnt{
        padding-top: 11px;
    }
    .control-label{
        margin-bottom: 0;
        padding-top: 1px;
        text-align: right;
    }
    .form-group{
        display: table;
        width: 100%;
    }
    .widget-body{
        display:white;
    }

</style>


<!--<div class="well">
    <h4>@lang('activity_forms/title.view')

    </h4>
</div>-->
        <!-- // Widget heading END -->
<section class="well panel panel-default">
        <div class="row">
            <div class="pull-right">
                <a href="javascript:;" onclick="window.history.back(); return false;"  class="btn btn-info"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
            </div>
           <!-- Idea Name -->
            <div class="col-sm-12">
                <h2 class="strong">
                    {{ $idea->name }}
                </h2>
                <p>{{Lang::get('form/title.durations')}}{{{Input::old('duration',$idea->duration)}}}-{{Lang::get('form/title.month')}}</p>
            </div>

            <!-- Problem Statement -->
            <div class="col-sm-12">
                    <h6 class="heading"><b>@lang('form/title.prob_stmnt')</b></h6>
                <div class="white-box">
                    <p>{{ $idea->prob_stmnt }}</p>
                </div>
            </div>
            <!-- Problem Attachment -->
            <div>
                <h6 class="col-sm-2"><b>@lang('form/title.prob_file')</b></h6>
                <div class="col-sm-10">
                    <div class="">
                        <a href="{{ asset($idea->prob_file->url('original')) }}">{{ $idea->prob_file->originalFilename()?"Download":""}}</a>
                    </div>
                </div>
            </div>

            <!-- Solution Statement -->
            <div class="col-sm-12">
                <h6 class="heading"><b>@lang('form/title.sol_stmnt')</b></h6>
                <div class="white-box">
                    <p>{{ $idea->sol_stmnt }}</p>
                </div>
            </div>

            <!-- Solution Attachment -->
            <div>
                <h6 class="col-sm-2"><b>@lang('form/title.sol_file')</b></h6>
                <div class="col-sm-10">
                    <div class="">
                        <a href="{{ asset($idea->sol_file->url('original')) }}">{{ $idea->sol_file->originalFilename()?"Download":""}}</a>
                    </div>
                </div>
            </div>
            <!-- Dependecies  -->
            <div class="col-sm-12">
                <h6 class="heading"><b>@lang('form/title.dependencies')</b></h6>
                <div class="white-box">
                    <p>{{ $idea->beneficaries }}</p>
                </div>
            </div>
            <!-- Dependecies  -->
            <div class="col-sm-12">
                <h6 class="heading"><b>@lang('form/title.beneficaries')</b></h6>
                <div class="white-box">
                    <p>{{ $idea->beneficaries }}</p>
                </div>
            </div>
            <!-- Dependecies  -->
            <div class="col-sm-12">
                <h6 class="heading"><b>@lang('form/title.sectors')</b></h6>
                <div class="white-box">
                    <p>{{ $idea->sectors }}</p>
                </div>
            </div>
            <!-- Location  -->
            <div class="col-sm-12">
                <h6 class="heading"><b>@lang('form/title.location')</b></h6>
                <div class="white-box">
                    <p>
                        {{ $idea->division?$idea->division->name.',':'' }}
                        {{ $idea->district?$idea->district->name.',':'' }}
                        {{ $idea->upazilla?$idea->upazilla->name.',':'' }}
                    </p>
                </div>
            </div>
            <!-- Dependecies  -->
            <div class="col-sm-12">
                <h6 class="heading"><b>@lang('form/title.office')</b></h6>
                <div class="white-box">
                    <p>
                        {{ $idea->ministry?$idea->ministry->name.',':'' }}
                        {{ $idea->mindivision?$idea->mindivision->name.',':'' }}
                        {{ $idea->directorate?$idea->directorate->name.',':'' }}
                    </p>
                </div>
            </div>

        </div>
    </section>
<style>
    .white-box{
        background-color: #fff;
        padding: 5px 15px;
    }
</style>
@stop

@section('body_bottom')
<script>
    $(document).ready(function(){
    });
</script>
@stop