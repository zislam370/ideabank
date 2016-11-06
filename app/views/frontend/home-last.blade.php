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
        margin-top: 40px;
    }
    .infographics-block .topic{
        font-size: 1.5em;
        color: #666;
    }
    .infographics-block .topic-data{
        font-size: 2.5em;
        color: #683091;
    }
    .infographics-block{
        border-right: #683091 solid 4px;
        border-bottom: #683091 solid 4px;
        text-align: right;
        padding: 0  10px;
    }
    .event-date{
        color: #683091;
        font-size: 1.2em;
        font-style: italic;
    }
    #content-blocks{

    }
    #content-blocks h3{
        color: #683091;
        padding-top: 15px;
        border-top: 1px solid #3fb618;
    }
    #content-blocks h3 i{
        color: #683091;
    }
    #content-blocks ul li{
        margin: 0;
        padding: 5px 0;
        border: none;
    }
    #content-blocks ul li a{
        color: #333;
    }
    #content-blocks ul li i{
        background-color: #3fb618;
        color: #fff;
        padding: 10px;
        margin: 0 10px 0 0;
    }
    #infographics div{
        padding-left: 0;
    }
</style>
<style>
    .list-group .list-group-item-info{
        border:none;
    }
    .list-group .media{
        background-color: #eee;
        margin: 0;
        padding: 0;
        border-bottom: 1px #eee solid;
        border: 1px solid #fff;
    }
    .list-group .list-group-item-info{
        font-weight: bold;
    }
    .list-group,.list-group .media-list{
        margin-bottom: 10px;
    }
    .media-body h5.media-heading{
        font-weight: bold;
        margin-top: 5px;
        font-size: .9em;
    }
    .media-body h5.media-heading a{
        color: #666;
    }
    #infographics .infographic{
        margin: 0;margin-bottom: 20px;
        padding: 0;
        padding-left: 20px;
    }
    #infographics .infographic:first-child{
        padding-left: 0px;
    }
</style>
<div id="infographics" class="col-lg-12" style=" padding: 0;">
    <div  class="infographic col-lg-3">
        <div class="infographics-block">
            <span class="topic">@lang('general.total')</span>
            <span class="topic-data">1,278</span>
        </div>
    </div>
    <div  class="infographic col-lg-2">
        <div class="infographics-block">
            <span class="topic">SIF</span>
            <span class="topic-data">534</span>
        </div>
    </div>
    <div  class="infographic col-lg-2">
        <div class="infographics-block">
            <span class="topic"><i class="fa fa-check"></i></span>
            <span class="topic-data">10</span>
        </div>
    </div>
    <div  class="infographic col-lg-2">
        <div class="infographics-block">
            <span class="topic">@lang('general.funded')</span>
            <span class="topic-data">564</span>
        </div>
    </div>
    <div  class="infographic col-lg-3">
        <div class="infographics-block">
            <span class="topic"><i class="fa fa-money"></i></span>
            <span class="topic-data">1,24,45,000</span>
        </div>
    </div>

</div>
    <div id="content-blocks" class="col-lg-9"  style="margin: 0;padding: 0;">

        <div id="" class="col-lg-12"  style="margin-left: 0;padding-left: 0;">
            <h3><i class="fa fa-camera-retro"></i> @lang('general.press_media')</h3>
            @foreach($newsmedias as $newsmedia)
            <div class="media">
                <div class="media-left">
                    <img alt="140x140" class="img-rounded" data-src="holder.js/140x140" style="width: 140px; height: 140px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQzLjUiIHk9IjcwIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MTQweDE0MDwvdGV4dD48L2c+PC9zdmc+" data-holder-rendered="true">
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><a href="{{ $newsmedia->url() }}">{{ $newsmedia->title }}</a></h4>
                    <p>{{ Str::limit($newsmedia->content, 200) }}</p>
                    <p><span aria-hidden="true" class="glyphicon glyphicon-calendar"></span> {{{ $newsmedia->created_at->diffForHumans() }}}
                        <a href="javascript:;" onmouseover="ai2display_bkmk(this, '', '', '');" onmouseout="ai2close_bkmk();"><i style="font-size: 2em;" class="fa fa-share-alt-square"></i></a>
                    </p>
                </div>
            </div>
            @endforeach


        </div>
        <div id="" class="col-lg-6" style="margin-left: 0;padding-left: 0;">
            <h3><i class="fa fa-lightbulb-o"></i> @lang('general.innovation_event')</h3>
            <div class="list-group">
                <ul class="media-list">
                    @foreach($events as $event)
                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjEyLjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" style="width: 64px; height: 64px;" class="media-object" data-src="holder.js/64x64" alt="64x64">
                            </a>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="">{{ $event->link_title }}</a></h5>
                            <p>Start : {{$event->start}}  From:  {{$event->end}}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <style>
            #pbt_subscribe-box {
                /*float: right;*/
                /*margin: 0 0 10px;*/
                /*width: 290px;*/
            }
            #bleft {
                -moz-border-bottom-colors: none;
                -moz-border-left-colors: none;
                -moz-border-right-colors: none;
                -moz-border-top-colors: none;
                background: none repeat scroll 0 0 #eee;
                border-color: #ccc #ccc #bbb;
                border-image: none;
                border-style: none none solid;
                border-width: 1px;
                box-shadow: 0 0 25px rgba(0, 0, 0, 0.1) inset;
                float: left;
                height: 160px;
                position: relative;
            }
            #bleft .icon {
                background: url("http://3.bp.blogspot.com/-c2n0mX2Emm8/T96kjqg0qHI/AAAAAAAABWw/7MF8P4bHEcM/s1600/letter.png") no-repeat scroll center center transparent;
                display: block;
                float: left;
                height: 64px;
                margin: 16px;
                width: 70px;
            }
            #bleft .sub-email {
                float: left;
                margin: 10px 0 0;
            }
            #bleft .sub-email h4 {
                color: #000;
                font-family: arial;
                font-size: 20px;
                font-weight: bold;
                margin: 10px 0;
                text-shadow: 0 1px #fff;
            }
            #bleft .sub-email p.getposts {
                color: #777;
                font-family: arial;
                font-size: 13px;
                text-shadow: 0 1px 0 #fff;
                width: 175px;
            }
            #bleft form {
                float: left;
                margin: 0 0 0 20px;
            }
            #bleft .sbox {
                -moz-border-bottom-colors: none;
                -moz-border-left-colors: none;
                -moz-border-right-colors: none;
                -moz-border-top-colors: none;
                border-color: -moz-use-text-color -moz-use-text-color #ccc;
                border-image: none;
                border-style: none none solid;
                border-width: 0 0 1px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3) inset;
                float: left;
                height: 35px;
                padding: 4px;
                width: 250px;
            }
            #bleft .go {
                background: none repeat scroll 0 0 #00bfff;
                border: 1px solid #689328;
                box-shadow: 0 -12px 0 rgba(0, 0, 0, 0.15) inset;
                color: #fff;
                cursor: pointer;
                float: left;
                font-weight: bold;
                margin: 0 0 0 10px;
                padding: 5px;
            }
            #bright {
                background: -moz-linear-gradient(center bottom , #fff 0%, #eee 100%) repeat scroll 0 0 transparent;
                border: 1px solid #ccc;
                border-radius: 0 0 10px 10px;
                box-shadow: 0 10px 13px rgba(0, 0, 0, 0.1) inset;
                float: left;
                height: 50px;
                margin: -10px 0 10px;
                width: 300px;
            }
            #bright ul {
                float: left;
                list-style: outside none none;
                margin: 20px 0 20px 15px !important;
                padding: 0 !important;
            }
            #bright ul li {
                background: url("http://3.bp.blogspot.com/-DubrD-iJuQs/T96kkoBby3I/AAAAAAAABW4/INhMaDeckC4/s1600/subs-icons.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
                float: left;
                margin: 3px 0;
                padding: 1px;
                position: relative;
                width: 93px;
            }
            #bright ul li a {
                background: none repeat scroll 0 center rgba(0, 0, 0, 0);
                color: #555;
                float: left;
                font-family: arial,helvetica,sans-serif;
                font-size: 12px;
                font-weight: bold;
                margin-left: 25px;
                margin-top: -2px;
                text-shadow: 1px 1px #fff;
            }
        </style>
        <div id="" class="col-lg-6" style="margin-left: 0;padding-left: 0;">
            <h3><span aria-hidden="true" class="glyphicon glyphicon-envelope"></span> @lang('general.news_letter')</h3>
            <div id="pbt_subscribe-box">
                <div id="bleft">
                    <div class="icon">&nbsp;
                    </div>
                    <div class="sub-email"><h4>Subscribe now!</h4>

                        <p class="getposts">Get Our Latest Posts in Your Inbox For Free.</p>
                    </div>
                    <form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?probloggingtools', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
                        <input type="email" placeholder="Your email address here!" class="sbox" name="emailcheck">
                        <input type="hidden" value="probloggingtools" name="uri">
                        <input type="hidden" name="loc" value="en_US">&nbsp;&nbsp;
                        <input type="submit" class="go" value="Subscribe">
                    </form>
                </div>

            </div>
        </div>
        <div id="" class="col-lg-6" style="margin-left: 0;padding-left: 0;">
            <h3><span aria-hidden="true" class="glyphicon glyphicon-envelope"></span> SIF Stat</h3>
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge">14</span>
                    Cras justo odio
                </li>
                <li class="list-group-item">
                    <span class="badge">2</span>
                    Dapibus ac facilisis in
                </li>
                <li class="list-group-item">
                    <span class="badge">1</span>
                    Morbi leo risus
                </li>
            </ul>
        </div>
        <div id="" class="col-lg-6" style="margin-left: 0;padding-left: 0;">
            <h3><span aria-hidden="true" class="glyphicon glyphicon-envelope"></span> Cap-Dev Stat</h3>
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge">14</span>
                    Cras justo odio
                </li>
                <li class="list-group-item">
                    <span class="badge">2</span>
                    Dapibus ac facilisis in
                </li>
                <li class="list-group-item">
                    <span class="badge">1</span>
                    Morbi leo risus
                </li>
            </ul>
        </div>
    </div>
    <div id="" class="col-lg-3" style="margin: 0;padding: 0;">
        <div class="list-group">
            <img style="width: 64px; height: 64px;" data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjEyLjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" class="media-object" data-src="holder.js/64x64" alt="64x64">
            <a href="{{ route('submit/idea','general') }}" class="btn btn-warning btn-lg"><i class="fa fa-lightbulb-o"></i> @lang('button.submitidea')</a>
        </div>
        <br/>

        <div class="list-group ">
            <a class="list-group-item list-group-item-info" href="#">
                <span aria-hidden="true" class="glyphicon glyphicon-thumbs-up"></span> @lang('general.completed_project')
            </a>
            <ul class="media-list">
                @foreach($completed_ideas as $idea)
                <li class="media">
                    <div class="media-left">
                        <a href="#">
                            <img alt="64x64" data-src="holder.js/64x64" class="media-object" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjEyLjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true">
                        </a>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading"><a href="#">{{$idea->name}}</a></h5>
                        <p><span class="label label-primary">{{$idea->category->name}}</span></p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="list-group">
            <a class="list-group-item list-group-item-info" href="#">
                <span aria-hidden="true" class="glyphicon glyphicon-hand-right"></span> @lang('general.running_project')
            </a>
            <ul class="media-list">
                @foreach($running_ideas as $idea)
                <li class="media">
                    <div class="media-left">
                        <a href="#">
                            <img alt="64x64" data-src="holder.js/64x64" class="media-object" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjEyLjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true">
                        </a>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading"><a href="#">{{$idea->name}}</a></h5>
                        <p><span class="label label-primary">{{$idea->category->name}}</span></p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="list-group">
            <a class="list-group-item list-group-item-info" href="#">
                <span aria-hidden="true" class="glyphicon glyphicon-link"></span> SIF Section
            </a>
            <a class="list-group-item" href="{{ route('view-page','sif_innovative_found_by_a2i') }}">Innovative Found By a2i</a>
            <a class="list-group-item" href="{{ route('view-page','sif_awardees') }}">SIF Awardees</a>
            <a class="list-group-item" href="{{ route('view-page','sif_innovation_circle') }}">Innovation circle</a>
            <a class="list-group-item" href="{{ route('view-page','sif_application') }}">Submit your SIF application</a>
            <a class="list-group-item" href="{{ route('view-page','sif_asked_question') }}">Frequently asked question</a>
            <a class="list-group-item" href="{{ route('view-page','question_about_sif') }}">Asked your question about SIF</a>
        </div>
        <div class="list-group">
            <a class="list-group-item list-group-item-info" href="#">
                <span aria-hidden="true" class="glyphicon glyphicon-link"></span> Cap-Dev Section
            </a>
            <a class="list-group-item" href="{{ route('view-page','capdev_innovative_found_by_a2i') }}">Innovative Found By a2i</a>
            <a class="list-group-item" href="{{ route('view-page','capdev_awardees') }}">Cap-Dev awardess</a>
            <a class="list-group-item" href="{{ route('view-page','capdev_innovation_circle') }}">Innovation circle</a>
            <a class="list-group-item" href="{{ route('view-page','capdev_application') }}">Submit your Cap-Dev application</a>
            <a class="list-group-item" href="{{ route('view-page','capdev_asked_question') }}">Frequently asked question</a>
            <a class="list-group-item" href="{{ route('view-page','question_about_capdev') }}">Asked Question about Cap-Dev</a>
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