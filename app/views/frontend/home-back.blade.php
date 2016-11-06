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
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>{{ $front_banner->slide_title }}</h1>
                            <h3><p>{{ $front_banner->title }}</p></h3>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
            @endforeach
        </div>
    <div class="panel panel-success"></div>
   <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
@stop
@section('content')
<style>
#boder{
     border-radius: 3px 3px 0 0;
      }
#boder7{
     border-radius: 3px 3px 0 0;
     padding-right: 10px;
      }
#boder3{
    margin-bottom: 0px;
    margin-top: 1px;
    border-radius: 5px 5px 5px 5px;
    padding-top: 10px;
    padding-bottom: 5px;
      }
#boder2{
    float: left;
    margin: 5px 20px 10px 5px ;
    border-radius: 5px 5px 5px 5px;
      }
#boder4{
    margin-bottom: 0px;
    margin-top: 1px;
    border-radius: 0px 0px 0px 0px;
    padding-top: 10px;
    padding-bottom: 5px;
      }
#boder1{
    margin-bottom: 1px;
    margin-top: 1px;
    border-radius: 5px 5px 5px 5px;
      }
#boder8{
    margin-bottom: 5px;
    margin-top: 1px;
    border-radius: 5px 5px 5px 5px;
      }
#boder5{
    margin-bottom: 0px;
    margin-top: 0px;
    border-radius: 0px 0px 0px 0px;
    padding-top: 1px;
    padding-bottom: 1px;
      }
.well-heading{
    background-color:#f4f4f4;
    border-color: #f4f4f4;
    color:#fff;
    padding-top: 0px;
    padding-bottom: 1px;
}
.well-info{
    border-color: #ffffff;
}
.well-title{
    color:#000;
}

#border6{
    margin-left: 2cm;

}
.white-box{
    background-color: #fdfdfc;
    padding: 5px 10px;
}
.media1-body{
    padding: 10px 30px;
    background: #e60000;
    width: 200px;
    border-radius: 50px;
    margin-left: 2cm;
    margin-top: 15px;

}
</style>
<style>
    #pbt_subscribe-box {
        float: right;
        width: 290px;
        margin: 0 0 10px
    }

    #bleft {
        -webkit-border-radius: 10px 10px 0 0;
        -moz-border-radius: 10px 10px 0 0;
        border-radius: 6px 6px 6px 6px;
        -webkit-box-shadow: 0 0 25px rgba(0, 0, 0, 0.1) inset;
        -moz-box-shadow: 0 0 25px rgba(0, 0, 0, 0.1) inset;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.1) inset;
        background: none repeat scroll 0 0 #EEE;
        float: left;
        height: 160px;
        width: 307px;
        border: 1px #CCC;
        position: relative;
        border-bottom: 1px solid #BBB
    }

    #bleft .icon {
        background: url(http://3.bp.blogspot.com/-c2n0mX2Emm8/T96kjqg0qHI/AAAAAAAABWw/7MF8P4bHEcM/s1600/letter.png) no-repeat scroll center center transparent;
        display: block;
        float: left;
        width: 70px;
        height: 64px;
        margin: 16px;
    }
    #bleft .sub-email {
        float: right;
        width: 195px;
        margin: 10px 0 0
    }
    #bleft .sub-email h4 {
        color: #000;
        font-family: arial;
        font-size: 20px;
        font-weight: bold;
        margin: 10px 0;
        text-shadow: 0 1px #FFF
    }
    #bleft .sub-email p.getposts {
        color: #777;
        font-family: arial;
        font-size: 13px;
        text-shadow: 0 1px 0 #FFF;
        width: 175px
    }
    #bleft form {
        float: left;
        margin: 0 0 0 20px
    }
    #bleft .sbox {
        -webkit-border-radius: 5px 5px 5px 5px;
        -moz-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;
        -webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3) inset;
        -moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3) inset;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3) inset;
        border: 0 none;
        float: left;
        height: 30px;
        padding: 4px;
        width: 165px;
        border-bottom: 1px solid #CCC
    }
    #bleft .go {
        -webkit-border-radius: 5px 5px 5px 5px;
        -moz-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;
        -webkit-box-shadow: 0 -12px 0 rgba(0, 0, 0, 0.15) inset;
        -moz-box-shadow: 0 -12px 0 rgba(0, 0, 0, 0.15) inset;
        box-shadow: 0 -12px 0 rgba(0, 0, 0, 0.15) inset;
        background: none repeat scroll 0 0 #00BFFF;
        border: 1px solid #689328;
        color: #FFF;
        float: left;
        font-weight: bold;
        margin: 0 0 0 10px;
        cursor:pointer;
        padding: 5px
    }
    #bright {
        -webkit-border-radius: 0 0 10px 10px;
        -moz-border-radius: 0 0 10px 10px;
        border-radius: 0 0 10px 10px;
        background:#EEE;
        background: -moz-linear-gradient(center bottom, #FFF 0%, #EEE 100%) repeat scroll 0 0 transparent;
        background:-webkit-gradient(
            linear,
            left bottom,
            left top,
            color-stop(0, rgb(255,255,255)),
            color-stop(1, rgb(238,238,238))
        );
        border: 1px solid #CCC;
        float: left;
        height: 50px;
        margin: -10px 0 10px;
        width: 300px;
        -webkit-box-shadow: 0 10px 13px rgba(0, 0, 0, 0.1) inset;
        -moz-box-shadow: 0 10px 13px rgba(0, 0, 0, 0.1) inset;
        box-shadow: 0 10px 13px rgba(0, 0, 0, 0.1) inset
    }
    #bright ul {
        float: left;
        list-style: none outside none;
        margin: 20px 0 20px 15px !important;
        padding: 0 !important
    }

    #bright ul li {
        background: url(http://3.bp.blogspot.com/-DubrD-iJuQs/T96kkoBby3I/AAAAAAAABW4/INhMaDeckC4/s1600/subs-icons.png) no-repeat;
        float: left;
        margin: 3px 0;
        width: 93px;
        position: relative;
        padding:1px;
    }

    #bright ul li a {
        color: #555;
        float: left;
        font-family: arial, helvetica, sans-serif;
        font-size: 12px;
        font-weight: bold;
        margin-left: 25px;
        margin-top: -2px;
        background:0 none;
        text-shadow: 1px 1px #FFF
    }
</style>
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
<div class="row">
 <div class="col-sm-8">
          <div id="boder1" class="widget-small">
            <div id="boder" class="widget-heading"><h3>Inovation news and medias</h3></div>
              <div class="well ">
                  <div class="media">
                      <div class="media-body" >
                          <div class="pull-right">
                          </div>
                          <table class="table">
                             <tbody>
                               @foreach($newsmedias as $newsmedia)
                               <tr>
                                   <td><img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/images (1).jpg" width="130"></td>
                                   <td><b><a href="{{ $newsmedia->url() }}">{{ $newsmedia->title }}</a>&nbsp;</b><br>
                                           {{ Str::limit($newsmedia->content, 200) }}
                                           <br>
                                        {{{ $newsmedia->created_at->diffForHumans() }}}  | Social media share <a href="javascript:;" onmouseover="ai2display_bkmk(this, '', '', '');" onmouseout="ai2close_bkmk();"><img src="http://icons.iconarchive.com/icons/iconshock/high-detail-social/256/sharethis-icon.png" width="15px"></a><!--<a href="https://www.facebook.com/sharer/sharer.php?u="><i class="fa fa-share-alt"></i></a>-->
                                   </td>
                               </tr>
                               @endforeach
                               </tbody>
                          </table>
                          <a class="pull-right" href="{{route('all_news_media')}}"><span class="pull-right">@lang('form/title.All')</span></a>
                      </div>
                  </div>
              </div>
          </div>
        <div>
              <div id="boder1" class="widget-small col-sm-7">
                <div id="boder" class="widget-head"><h3>Innovation Event</h3></div>
                 @foreach($events as $event)
                  <div id="boder3" class="well">
                      <div id="boder2" class="thumb pull-left">
                          <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/index(1).png" width="60">
                      </div>
                      <div class="media-body">
                          <p><b><font color="green"><a href="">{{ $event->link_title }}</a></font></b></p>
                          Duration : {{$event->start}}  From:  {{$event->end}}
<!--                          <p><h5>Vanue: BIAM Foundation New Eskaton,Dhaka.</h5></p>-->
                      </div>
                  </div>
                @endforeach
                <div id="boder5" class="well">
                <a class="pull-right" href="{{route('all_events')}}"><span class="pull-right">@lang('form/title.All')</span></a>
                </div>
            </div>
              <div id="boder1" class="widget-small col-sm-7">
                <div id="boder" class="widget-head"><h3>Upcoming Innovation Event</h3></div>
                 @foreach($upcoming_events as $event)
                  <div id="boder3" class="well">
                      <div id="boder2" class="thumb pull-left">
                          <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/index(1).png" width="60">
                      </div>
                      <div class="media-body">
                          <p><b><font color="green"><a href="">{{ $event->link_title }}</a></font></b></p>
                          Duration : {{$event->start}}  From:  {{$event->end}}
<!--                          <p><h5>Vanue: BIAM Foundation New Eskaton,Dhaka.</h5></p>-->
                      </div>
                  </div>
                @endforeach
                <div id="boder5" class="well">
                <a class="pull-right" href="{{route('all_events')}}"><span class="pull-right">@lang('form/title.All')</span></a>
                </div>
            </div>

          </div>
          <div id="boder" class="widget-head"><h3>Innovation Newsletter</h3></div>
          <div id="boder8" class="well col-sm-5">
              <div>
                  <table align="Center">
                      <tr>
                          <td rowspan=3 id="boder7"><P align=Center><img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/original/news.jpg" width="130px"> </td>
                          <td><font color="green">LATTER NEWSLETTER HIGHLIGHTS</font></td>
                      </tr>
                      <tr>
                          <td><h5>-Newsletter Month: 21 April 2014</h5><h5>Viewers: 442</h5></td>
                      </tr>
                      <tr>
                          <td><h5>-Newsletter Month 21 January 2015</h5><h5>Viewers: 44</h5></td>
                      </tr>
                  </table>
              </div>
              <div id="pbt_subscribe-box">
                  <div id="bleft">
                      <div class='icon'>&nbsp;
                      </div>
                      <div
                          class='sub-email'><h4>Subscribe now!</h4>

                          <p class="getposts">Get Our Latest Posts in Your Inbox For Free.</p>
                      </div>
                      <form onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?probloggingtools', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" target="popupwindow" method="post" action="http://feedburner.google.com/fb/a/mailverify">
                       <input type="email" name="emailcheck" class="sbox" placeholder="Your email address here!">
                       <input type="hidden" name="uri" value="probloggingtools">
                       <input type="hidden" value="en_US" name="loc">&nbsp;&nbsp;
                       <input type="submit" value="Subscribe" class='go'>
                      </form>
                  </div>

              </div>
          </div>
        </div>
        <!--col-sm-4 -->
        <div class="col-sm-4">
            <div  class="panel-body">
                <div id="boder2" class="thumb pull-left">
                    <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/original/idea.png" width="60">
                </div>
                <div class="media1-body">
                    <a href="{{ route('submit/idea','general') }}">@lang('button.submitidea')</a>
                </div>
            </div>
            <div id="boder5" class="well-info">
                <div id="boder5" class="well-heading">
                  <h4 class="well-title">SIF Section</h4>
                </div>
                <div id="boder4" class="well">
                    <div class="white-box">
                        <i id="border6" class="fa fa-chain"><a href="{{ route('view-page','sif_innovative_found_by_a2i') }}">Innovative Found By a2i</a></i><br>
                        <i id="border6" class="fa fa-chain"><a href="{{ route('view-page','sif_awardees') }}">SIF Awardees</a></i><br>
                        <i id="border6" class="fa fa-chain"><a href="{{ route('view-page','sif_innovation_circle') }}">Innovation circle</a></i><br>
                        <i id="border6" class="fa fa-chain"><a href="{{ route('view-page','sif_application') }}">Submit your SIF application</a></i><br>
                        <i id="border6" class="fa fa-chain"><a href="{{ route('view-page','sif_asked_question') }}">Frequently asked question</a></i><br>
                        <i id="border6" class="fa fa-chain"><a href="{{ route('view-page','question_about_sif') }}">Asked your question about SIF</a></i><br>
                    </div>
                </div>
            </div>
            <div id="boder5" class="well-info">
                <div id="boder5" class="well-heading">
                  <h4 class="well-title">Cap-Dev Section</h4>
                </div>
                <div id="boder4" class="well">
                    <div class="white-box">
                        <i id="border6" class="fa fa-chain"><a href="{{ route('view-page','capdev_innovative_found_by_a2i') }}">Innovative Found By a2i</a></i><br>
                        <i id="border6" class="fa fa-chain"><a href="{{ route('view-page','capdev_awardees') }}">Cap-Dev awardess</a></i><br>
                        <i id="border6" class="fa fa-chain"><a href="{{ route('view-page','capdev_innovation_circle') }}">Innovation circle</a></i><br>
                        <i id="border6" class="fa fa-chain"><a href="{{ route('view-page','capdev_application') }}">Submit your Cap-Dev application</a></i><br>
                        <i id="border6" class="fa fa-chain"><a href="{{ route('view-page','capdev_asked_question') }}">Frequently asked question</a></i><br>
                        <i id="border6" class="fa fa-chain"><a href="{{ route('view-page','question_about_capdev') }}">Asked Question about Cap-Dev</a></i><br>
                    </div>
                </div>
            </div>
          <div id="boder5" class="well-info">
            <div id="boder5" class="well-heading">
              <h4 class="well-title">Complete Project</h4>
            </div>
              @foreach($completed_ideas as $idea)
                <div id="boder4" class="well">
                    <div id="boder2" class="thumb pull-left">
                        <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/SIF.jpg" width="60">
                    </div>
                    <div class="media-body">
                        <p><p>{{$idea->name}}<b>
                        {{$idea->workflow_category_id}}
                        </b></p></p>
                    </div>
                </div>
                @endforeach
              <div id="boder5" class="well">
                  <a class="pull-right" href="{{route('all_news_media')}}"><span class="pull-right">@lang('form/title.All')</span></a>
              </div>
          </div>
          <div id="boder5" class="well-info">
            <div id="boder5" class="well-heading">
              <h4 class="well-title">Running Project</h4>
            </div>
            @foreach($running_ideas as $idea)
              <div id="boder4" class="well">
                  <div id="boder2" class="thumb pull-left">
                      <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/SIF.jpg" width="60">
                  </div>
                  <div class="media-body">
                      <p><p>{{$idea->name}}<b>
                              {{$idea->workflow_category_id}}
                          </b></p></p>
                  </div>
              </div>
              @endforeach
              <div id="boder5" class="well">
                  <div class="">
                    <a href="{{route('running_projects')}}"><span class="pull-right">@lang('form/title.All')</span></a>
                  </div>
              </div>
          </div>
           <div id="boder5" class="well-info">
              <div id="boder5" class="well-heading">
                <h4 class="well-title">SIF Idea Statistics</h4>
              </div>
              <div id="boder4" class="well">
                  <div class="white-box">
                      <div class="panel-body">
                      @foreach($totalideas as $totalidea)
                        <span class="badge pull-right">{{$totalidea->total_idea}}</span>
                        Total<br>
                        @endforeach
                        @foreach($runnings as $running)
                        <span class="badge pull-right">{{$running->running}}</span>
                        Running<br>
                        @endforeach
                        @foreach($completes as $complete)
                        <span class="badge pull-right">{{$complete->complete}}</span>
                        Successfully Complete<br>
                        @endforeach
                         <!--<div class="media innerAll well"></div>-->
                         @foreach($totalamounts as $totalamount)
                        <span class="badge pull-right">{{$totalamount->total_amount}}</span>
                        Total Amount<br>
                        @endforeach
                         <!--<div class="media innerAll well"></div>-->
                         @foreach($sifs as $sif)
                        <span class="badge pull-right">{{$sif->sif}}</span>
                        SIF<br>
                        @endforeach
                         <!--<div class="media innerAll well"></div>-->
                    </div>
                  </div>
              </div>
            </div>
        </div><!-- /.col-sm-4 -->
</div>
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
<script>
$(function() {
    $(selector).pagination({
        items: 100,
        itemsOnPage: 10,
        cssStyle: 'light-theme'
    });
});
</script>
@stop
@section('page_scripts')
@stop