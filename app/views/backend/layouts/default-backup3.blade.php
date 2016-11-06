<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/flatlab/blank.html by HTTrack Website Copier/3.x [XR&CO'2010], Fri, 03 Oct 2014 18:43:57 GMT -->
<head>
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

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('backend_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend_assets/css/bootstrap-reset.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('public_assets/css/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />

    <!--right slidebar-->
    <link href="{{ asset('backend_assets/css/slidebars.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('backend_assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('backend_assets/css/style-responsive.css') }}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('backend_assets/js/html5shiv.css') }}"></script>
    <script src="{{ asset('backend_assets/js/respond.min.css') }}"></script>
    <![endif]-->
</head>

<body>

<section id="container" class="">
<!--header start-->
<header class="header white-bg">
<div class="sidebar-toggle-box">
    <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
</div>
<!--logo start-->
<a href="index-2.html" class="logo" >{{Lang::get('form/title.idea')}}<span>{{Lang::get('form/title.bank')}}</span></a>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    <!--Notification will go here-->
</div>
<div class="top-nav ">
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder="{{Lang::get('form/title.Search')}}">
        </li>

        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="img/avatar1_small.jpg">
                <span class="username">{{ Sentry::getUser()->first_name }}</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <div class="log-arrow-up"></div>
                <li><a href="{{ route('profile') }}"><i class=" fa fa-suitcase"></i>@lang('form/title.Profile')</a></li>
                <li><a href="#"><i class="fa fa-bell-o"></i> @lang('form/title.Notification')</a></li>
                <li><a href="{{ route('logout') }}"><i class="fa fa-key"></i> @lang('form/title.Log_Out')</a></li>
            </ul>
        </li>

        <!-- user login dropdown end -->

    </ul>
</div>
</header>
<!--header end-->
<!--sidebar start-->
    @include('backend/layouts/partials/left_menu')
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <!-- Notifications -->
        @include('frontend/notifications')

        <!-- Content -->
        @yield('content')
        <!-- page end-->
    </section>
</section>
<!--main content end-->



<!--footer start-->
<footer class="site-footer">
    <div class="text-center">
        2013 &copy; FlatLab by VectorLab.
        <a href="#" class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
</footer>
<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="{{ asset('backend_assets/js/jquery.js') }}"></script>
<script src="{{ asset('backend_assets/js/bootstrap.min.js') }}"></script>
<script class="include" type="text/javascript" src="{{ asset('backend_assets/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('backend_assets/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('backend_assets/js/slidebars.min.js') }}"></script>
<script src="{{ asset('backend_assets/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend_assets/js/respond.min.js') }}" ></script>

<!--common script for all pages-->
<script src="{{ asset('backend_assets/js/common-scripts.js') }}"></script>

@yield('body_bottom')

</body>

<!-- Mirrored from thevectorlab.net/flatlab/blank.html by HTTrack Website Copier/3.x [XR&CO'2010], Fri, 03 Oct 2014 18:43:57 GMT -->
</html>
