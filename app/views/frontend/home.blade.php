@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('form/title.Home') ::
@parent
@stop

{{-- Page content --}}
@section('banner')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->

    <ol class="carousel-indicators">
        <?php $i=0; ?>
        @foreach ($front_banners as $front_banner)
        <li data-target="#myCarousel" data-slide-to="{{$i}}" class="{{$i==0?'active':''}}"></li>
        <?php $i++; ?>
        @endforeach
    </ol>
    <div class="carousel-inner">
        <?php $i=0; ?>
        @foreach ($front_banners as $front_banner)
        <div class="item {{$i==0?'active':''}}"> <img src="{{asset($front_banner->img->url('original'))}}" style="width:100%" alt="{{{ $front_banner->title }}}" width="50" height="50">
            {{--<div class="container">--}}
                {{--<div class="carousel-caption">--}}
                    {{--<h1>Slide 1</h1>--}}
                    {{--<p>Aenean a rutrum nulla. Vestibulum a arcu at nisi tristique pretium.</p>--}}
                    {{--<p><a class="btn btn-lg btn-warning" href="#" role="button">@lang('button.Sign_up_today')</a></p>--}}
                    {{--</div>--}}
                {{--</div>--}}
        </div>
        <?php $i++; ?>
        @endforeach

    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>

@stop

@section('content')

<style>
    #main-container{
        margin-top: 10px!important;
    }
</style>

<div class="row">
    <div  id="idea_bank" class="front-box col-sm-12 col-md-4 col-lg-4">
        <div>

            <h4 class=""><span></span> @lang('form/title.Idea_bank')</h4>
            <ul>
                <li><i class="fa fa-circle"></i>
                    <a href="{{ URL::route('view-page','idea-bank-what') }}"> @lang('form/title.What')</a>
                </li>
                <li><i class="fa fa-circle"></i>
                    <a href="{{ URL::route('view-page','idea-bank-why') }}"> @lang('form/title.Why')</a>
                </li>
                <li><i class="fa fa-circle"></i>
                    <a href="{{ URL::route('view-page','idea-bank-how') }}"> @lang('form/title.How')</a>
                </li>
            </ul>
        </div>
    </div>
    <div  id="sif" class="front-box col-sm-12 col-md-4 col-lg-4">
        <div>
            <h4 class=""><span></span> @lang('form/title.SIF')</h4>
            <ul>
                <li><i class="fa fa-circle"></i>
                    <a href="{{ URL::route('view-page','sif-introduction') }}"> @lang('form/title.Introduction')</a>
                </li>
                <li><i class="fa fa-circle"></i>
                    <a href="{{ URL::route('view-page','sif-how-we-work') }}"> @lang('form/title.How_we_work')</a>
                </li>
                <li><i class="fa fa-circle"></i>
                    <a href="{{ URL::route('view-page','sif-success-story') }}"> @lang('form/title.Success_story')</a>
                </li>
            </ul>
        </div>
    </div>
    <div  id="statistics" class="front-box col-sm-12 col-md-4 col-lg-4">
        <div>
            <h4 class=""><span></span> @lang('form/title.Our_innovation_achievement')</h4>
            <ul>
                <li><span class="voilet">{{$idea_stat->application}}</span>
                    @lang('form/title.Applications')
                </li>
                <li><span class="voilet">{{$idea_stat->running}}</span>
                    @lang('form/title.Running_Projects')
                </li>
                <li><span class="voilet">{{$idea_stat->completed}}</span>
                    @lang('form/title.Completed_Projects')
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="row" style="background-color: #fff; margin-top: 10px">
    <div id="news-events-medias" class="col-sm-12 col-md-12 col-lg-7">

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#news-tab">
                    <i class="fa fa-newspaper-o"></i> @lang('form/title.innovation_news')
                    <span>({{count($newsmedias)}})</span>
                </a></li>
            <li><a data-toggle="tab" href="#events-tab">
                    <i class="fa fa-clock-o"></i> @lang('form/title.events')
                    <span>({{count($events)}})</span>
                </a></li>
            <li><a data-toggle="tab" href="#projects-tab">
                    <i class="fa fa-lightbulb-o"></i> @lang('form/title.Projects')
                    <span>({{count($running_ideas)}})</span>
                </a></li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div id="news-tab" class="tab-pane fade active in">
                @include('frontend/partials/news')
            </div>
            <div id="events-tab" class="tab-pane fade">
                @include('frontend/partials/events')
            </div>
            <div id="projects-tab" class="tab-pane fade">
                @include('frontend/partials/projects')
            </div>
        </div>
    </div>

    <div id="newsletter" class="col-sm-12 col-md-12 col-lg-5">
        <h4 class=""><i class="fa fa-envelope"></i> @lang('form/title.Newsletter')</h4>
        <div class="col-sm-12 col-md-12 col-lg-12 " style="margin: 25px 0;">
            <div class="col-sm-4 col-md-4 col-lg-4" style="padding: 0;">
                <img src="{{ asset('frontend_assets/img/home_now5.png') }}">
                <a class="recent-newsletter" href="{{ URL::route('view-page','underconstruction') }}">
                    মার্চ 2015
                </a>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8">
                <h5>@lang('form/title.Latest_Newsletter_Highlights')</h5>
                <ul id="monthly-newsletter" class="">
                    <li>
                        <a href="{{ URL::route('view-page','underconstruction') }}">
                            ফেব্রুয়ারি 2015
                        </a>
                        <span class="pull-right">দেখেছেন ৩২৪২ জন</span>
                    </li>
                    <li>
                        <a href="{{ URL::route('view-page','underconstruction') }}">
                            জানুয়ারী 2015
                        </a>
                        <span class="pull-right">দেখেছেন ৪৪৩ জন</span>
                    </li>
                    <li>
                        <a href="{{ URL::route('view-page','underconstruction') }}">
                            ডিসেম্বর 2014
                        </a>
                        <span class="pull-right">দেখেছেন ৫৬৪ জন</span>
                    </li>
                    <li>
                        <a href="{{ URL::route('view-page','underconstruction') }}">
                            নভেম্বর 2014
                        </a>
                        <span class="pull-right">দেখেছেন ১২৪ জন</span>
                    </li>
                    <li>
                        <a href="{{ URL::route('view-page','underconstruction') }}">
                            অক্টোবর 2014
                        </a>
                        <span class="pull-right">দেখেছেন ৪৫৪৫ জন</span>
                    </li>
                    <li>
                        <a href="{{ URL::route('view-page','underconstruction') }}">
                            সেপ্টেম্বর 2014
                        </a>
                        <span class="pull-right">দেখেছেন ৮৯৭ জন</span>
                    </li>
                </ul>
                <a class="read-more-btn" href="{{ URL::route('view-page','underconstruction') }}">
                    @lang('form/title.readmore')...
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <div class="form-group">
                <label class="control-label">@lang('form/title.uptodate'):</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="{{Lang::get('form/title.input_email')}}">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-info"><i class="fa fa-chevron-right"></i></button>
                        </span>
                </div>
            </div>
        </div>
    </div>
</div>



@stop

@section('page_scripts')
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script>
    stLight.options({
        publisher:'insert-your-key-here'
    });

    stWidget.addEntry({
        "service":"sharethis",
        "element":document.getElementById('button_1'),
        "url":"http://sharethis.com",
        "title":"sharethis",
        "type":"large",
        "text":"ShareThis" ,
        "image":"http://www.softicons.com/download/internet-icons/social-superheros-icons-by-iconshock/png/256/sharethis_hulk.png",
        "summary":"this is description1"
    });

    stWidget.addEntry({
        "service":"sharethis",
        "element":document.getElementById('button_2'),
        "url":"http://sharethis.com/2",
        "title":"sharethis",
        "type":"large",
        "text":"ShareThis" ,
        "image":"http://farm4.static.flickr.com/3571/3427619794_13dae8e979_o.png",
        "summary":"this is description2"
    });

    function addMore(){
        stWidget.addEntry({
            "service":"sharethis",
            "element":document.getElementById('button_3'),
            "url":"http://sharethis.com/3",
            "title":"sharethis",
            "type":"large",
            "text":"ShareThis" ,
            "image":"http://icons.iconarchive.com/icons/iconshock/high-detail-social/256/sharethis-icon.png",
            "summary":"this is description3"
        });
    }
</script>
<script type="text/javascript" src="http://static.addinto.com/ai/ai2_bkmk.js"></script>
<script>
    $( document ).ready(function() {

    });
</script>
<script>
    $( document ).ready(function() {

    });
</script>
<script language="JavaScript1.2">
    var testresults
    function checkemail(){
        var str=document.validation.emailcheck.value
        var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
        if (filter.test(str))
            testresults=true
        else{
            alert("Please input a valid email address!")
            testresults=false
        }
        return (testresults)
    }
</script>

<script>
    function checkbae(){
        if (document.layers||document.getElementById||document.all)
            return checkemail()
        else
            return true
    }
</script>
@stop