@extends('layouts.default')

{{-- Page title --}}
@section('title')
@lang('form/title.Home') ::
@parent
@stop
{{-- Page content --}}
@section('banner')
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title>
        @section('title')
        @lang('general.site_name')
        @show
    </title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('frontend_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend_assets_new/library/icons/fontawesome/assets/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('frontend_assets/css/simple-sidebar.css') }}" rel="stylesheet">

    <!-- NikoshBAN -->
    <link href="{{ asset('frontend_assets/fonts/NikoshBAN/stylessheet.css') }}" rel="stylesheet">
    <!-- Kalpurush -->
<!--    <link href="{{ asset('frontend_assets/fonts/kalpurush/stylesheet.css') }}" rel="stylesheet">-->

    <link href="{{ asset('frontend_assets/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/ideabank/public/backend_assets_new/plugins/forms_elements_select2/css/select2.css') }}/" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('backend_assets_new/library/modernizr/modernizr.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
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
<div>
</div>
@stop
@section('content')
<style>
#boder{
     border-radius: 3px 3px 0 0;
      }
#boder3{
    margin-bottom: 1px;
    margin-top: 1px;
    border-radius: 5px 5px 5px 5px;
      }
#boder2{
    float: left;
    margin: 5px 20px 10px 0px ;
    border-radius: 5px 5px 5px 5px;
      }
#boder1{
    margin-bottom: 1px;
    margin-top: 1px;
    border-radius: 5px 5px 5px 5px;
      }
.panel-primary{
    background-color:#d5d2d2;
    border-color: #d5d2d2;
    color:#fff;
 .max-lines {
      text-overflow: ellipsis;
      word-wrap: break-word;
      overflow: hidden;
      max-height: 3.6em;
      line-height: 1.8em;
    }
}

</style>
<div class="row">
 <div class="col-sm-8">
 <div id="boder" class="widget-heading" style="color:#9962a6"><h3><b>Inovation news and medias</b></h3></div>
          <div id="boder1" class="media innerAll well">
              <div class="widget widget-small widget-primary">
                  <div class="media">
                      <div class="media-body">
                          <div class="pull-right">
                          </div>
                          <table class="table ">
                              <tbody>
                              @foreach($posts as $post)
                              <tr>
                                  <td><img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/images (1).jpg" width="130"></td>
                                  <td><b><a href="{{ $post->url() }}">{{ $post->title }}</a>&nbsp;by</b>{{{$post->source}}}<br>
                                          {{ Str::limit($post->content, 200) }}
                                          <br>
                                      6554 Views | {{$post->created_at}}  | Social media share <a href=""><i class="fa fa-share-alt"></i></a>
                                  </td>
                              </tr>
                              @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
        <div>
          <div id="boder1" class="widget-small col-sm-7">
          <div id="boder" class="widget-heading" style="color:#9962a6"><h3><b>Innovation Event</b></h3></div>
              <div id="boder3" class="well">
                  <div id="boder2" class="thumb pull-left">
                      <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/images (1).jpg" width="70">
                  </div>
                  <div class="media-body">
                      <p><b>Digital Centers Entrepreneurs Conference</b></p>
                      <p>Date : 11th November, 2014</p>
                      <p>Vanue : National Parade Square, Dhaka</p>
                  </div>
              </div>
              <div id="boder3" class="well">
                  <div id="boder2" class="thumb pull-left">
                      <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/images (1).jpg" width="70">
                  </div>
                  <div class="media-body">
                      <p><b>Inovation Forum on Utilizing to the fullest</b></p>
                      <p>Date: 4th September 2014</p>
                      <p>Vanue: BIAM Foundation New Eskaton, Dhaka.</p>
                  </div>
              </div>
              <div id="boder3" class="well">
                  <div id="boder2" class="thumb pull-left">
                      <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/images (1).jpg" width="70">
                  </div>
                  <div class="media-body">
                      <p><b>Inovation Fund(Round-3)</b></p>
                      <p>Date: Thursday, Agugust21, 2014</p>
                      <p>Vanue: BIAM Foundation New Eskaton, Dhaka.</p>
                  </div>
          </div>
            </div>
          </div>
          <div id="boder1" class="widget-small col-sm-5">
          <div id="boder" class="widget-heading" style="color:#9962a6"><h3><b>Innovation Newsletter</b></h3></div>
              <div class="media innerAll well">
              <div col-sm-6>
                  <div class="pull-left"><img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/index(1).png" width="60"></div>
                  </div>
                  <div col-sm-6>
                  <table class="table">
                      <tbody>
                          <h4>
                              LATTER NEWSLETTER HIGHLIGHTS
                          </h4>
                          <tr class="innerR">
                              <td><span class="strong">-Newsletter </span> <span> 21 April 2014</span>
                              <p>Viewers: 442</p>
                              </td>
                          </tr>
                          <tr class="innerR">
                              <td><span class="strong">-Newsletter </span> <span> 21 January 2015</span>
                                  <p>Viewers: 44</p>
                              </td>
                          </tr>
                      </tbody>
                  </table>
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
                    <div class="media-body">
                        <a href="{{ route('submit/idea','general') }}" class="list-group-item btn btn-warning">@lang('button.submitidea')</a>
                        @foreach ($adverts as $advert)
                        <li class="list-group-item">
                            <a href="{{ route('submit/idea',$advert->id) }}" class="list-group-item btn btn-success">{{{$advert->link_title}}}</a>
                        </li>
                        @endforeach
                    </div>
                </div>
            <div id="boder1" class="media innerAll well">
                <div id="boder" class="panel-heading">
                  <h3 class="panel-title">SIF Section</h3>
                </div>
                <div id="boder3" class="well">
                    <!--<div id="boder2" class="pull-left"></div>-->
                    <div class="media-body">
                        <i class="fa fa-chain"></i><a href="">Innovative Found By a2i</a><br>
                        <i class="fa fa-chain"></i><a href="">SIF awardess</a><br>
                        <i class="fa fa-chain"></i><a href="">Innovation circle</a><br>
                        <i class="fa fa-chain"></i><a href="">Submit your SIF application</a><br>
                        <i class="fa fa-chain"></i><a href="">Frequently asked question</a><br>
                        <i class="fa fa-chain"></i><a href="">Asked your question about SIF</a><br>
                    </div>
                </div>
            </div>
          <div id="boder1" class="media innerAll well">
            <div id="boder1" class="panel-heading">
              <h3 class="panel-title">Complete Project</h3>
            </div>
              <div id="boder3" class="well">
                  <div id="boder2" class="thumb pull-left">
                      <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/SIF.jpg" width="60">
                  </div>
                  <div class="media-body">
                      <p>Development of Bangla Optical Caracter Recognizer(OCR)<b>SIF</b></p>
                  </div>
              </div>
              <div id="boder3" class="well">
                  <div id="boder2" class="thumb pull-left">
                      <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/bari.jpg" width="60">
                  </div>
                  <div class="media-body">
                      <p>Online Fertillizer Recommendation: Automation of data processing and data updating(CAP-DEV)</p>
                  </div>
              </div>
              <div id="boder3" class="well">
                  <div id="boder2" class="thumb pull-left">
                      <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/BRRI(1).jpg" width="60">
                  </div>
                  <div class="media-body">
                      <p>Web based on click service for application and Environmental Clearance Certificates(SIF)</p>
                  </div>
              </div>
          </div>
          <div id="boder1" class="media innerAll well">
            <div id="boder1" class="panel-heading">
              <h3 class="panel-title">Running Project</h3>
            </div>
              <div id="boder3" class="well">
                  <div id="boder2" class="thumb pull-left">
                      <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/SIF.jpg" width="60">
                  </div>
                  <div class="media-body">
                      <p><p>Development of Bangla Optical Caracter Recognizer(OCR)<b>SIF</b></p></p>
                  </div>
              </div>
              <div id="boder3" class="well">
                  <div id="boder2" class="thumb pull-left">
                      <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/BRRI(1).jpg" width="60">
                  </div>
                  <div class="media-body">
                      <p>Web based on click service for application and Environmental Clearance Certificates(SIF)</p>
                  </div>
              </div>
              <div id="boder3" class="well">
                  <div id="boder2" class="thumb pull-left">
                      <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/bari.jpg" width="60">
                  </div>
                  <div class="media-body">
                      <p>Online Fertillizer Recommendation: Automation of data processing and data updating(CAP-DEV)</p>
                  </div>
              </div>
          </div>
            <div id="boder1" class="media innerAll well">
                <div id="boder" class="panel-heading">
                  <h3 class="panel-title"  style="color:limegreen">SIF Section</h3>
                </div>
                <div id="boder3" class="well">
                    <!--<div id="boder2" class="pull-left"></div>-->
                    <div class="panel-body">
                          <span class="badge pull-right">15</span>
                          Total<br>
                          <span class="badge pull-right">10</span>
                          Running<br>
                          <span class="badge pull-right">5</span>
                          Successfully Complete<br>
                           <!--<div class="media innerAll well"></div>-->
                          <span class="badge pull-right">33400000</span>
                          Total Amount<br>
                           <!--<div class="media innerAll well"></div>-->
                          <span class="badge pull-right">3</span>
                          SIF<br>
                           <!--<div class="media innerAll well"></div>-->
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
<!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('backend_assets_new/library/jquery/jquery.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('frontend_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('backend_assets_new/plugins/ckeditor/adapters/jquery.js')}}"></script>
<script src="{{ asset('frontend_assets/js/jquery.jqEasyCharCounter.min.js') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/forms_elements_select2/js/select2.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
@stop
@section('page_scripts')
@stop