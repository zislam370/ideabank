<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from wbpreview.com/previews/WB0MN4GG2/index.html by HTTrack Website Copier/3.x [XR&CO'2010], Wed, 22 Oct 2014 21:00:25 GMT -->
<head>
    <meta charset="utf-8">
    <title>
        @section('title')
        @lang('general.site_name')
        @show
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="{{ asset('frontend_assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend_assets/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend_assets/css/icons.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('frontend_assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend_assets/css/skindefault.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend_assets/css/bootstrap-responsive.css') }}" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="{{ asset('frontend_assets/js/html5shiv.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend_assets/css/ie.css') }}" />
    <![endif]-->
    <!-- Jquery - The rest of the scripts at the bottom-->
    <script src="{{ asset('frontend_assets/js/jquery-1.9.0.min.js') }}"></script>
</head>
<body>

<!-- Header
================================================== -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="/"><span class="glyphicon glyphicon-home"></span> @lang('general.site_name')</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    @if (Sentry::check())

                    <li class="dropdown {{ (Request::is('account*') ? ' active' : '') }}">
                        <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="{{ route('account') }}">
                            Welcome, {{ Sentry::getUser()->first_name }}
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li{{ (Request::is('account/profile') ? ' class="active"' : '') }}><a href="{{ route('profile') }}"><i class="icon-user"></i>@lang('form/title.Edit_profile')</a></li>
                    <li{{ Request::is('account/change-password') ? ' class="active"' : '' }}><a href="{{ URL::route('change-password') }}">@lang('form/title.Change_Password')</a></li>
                    <li{{ Request::is('account/change-email') ? ' class="active"' : '' }}><a href="{{ URL::route('change-email') }}">@lang('form/title.Change_Email')</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('logout') }}"><i class="icon-off"></i>@lang('button.Logout')<</a></li>
                </ul>
                </li>

                @if(Sentry::getUser()->hasAccess('posts.write'))
                <li{{ (Request::is('admin/posts*') ? ' class="active"' : '') }}><a href="{{ URL::to('admin/posts') }}"><i class="icon-list-alt icon-white"></i> @lang('form/title.Blog_Posts')</a></li>

                <li class="dropdown {{ (Request::is('admin/users*|admin/groups*') ? ' active' : '') }}">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{ URL::to('admin/users') }}">
                        <i class="icon-user icon-white"></i> @lang('form/title.Users') <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li{{ (Request::is('admin/users*') ? ' class="active"' : '') }}><a href="{{ URL::to('admin/users') }}"><i class="icon-user"></i> @lang('form/title.Users')</a></li>
                <li{{ (Request::is('admin/groups*') ? ' class="active"' : '') }}><a href="{{ URL::to('admin/groups') }}"><i class="icon-user"></i> @lang('form/title.Groups')</a></li>
                </ul>
                </li>
                @endif

                @else
                <li {{ (Request::is('auth/signup') ? 'class="active"' : '') }}><a href="{{ route('signup') }}">@lang('button.signup')</a></li>
                <li {{ (Request::is('auth/signin') ? 'class="active"' : '') }}><a href="{{ route('signin') }}">@lang('button.Log_in')</a></li>
                @endif
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>



    <!-- Notifications -->
    @include('frontend/notifications')

    <!-- Content -->
    @yield('content')


<!-- Footer
================================================== -->
<div class="footer">
    <div class="container">
        <!-- 1st row -->
        <div class="row-fluid">
            <div class="span12 text-center">
                <h1 class="title" style="color:#ccc;">Get in touch</h1>
                <p>
                    If you have a specific project or event for us,  get in touch today on:
                </p>
                <span>+42 (0) 628 593 842</span> or <span>photo@serenity.com.au</span>
            </div>
        </div>
        <hr>
        <!-- 2nd row -->
        <div class="row-fluid">
            <!-- left -->
            <div class="span4 smallspacetop">
                <p class="smaller">
                    <span class="copyright">&copy; </span> Copyright 2013 Serenity Theme
                </p>
            </div>
            <!-- middle -->
            <div class="span4">
                <div class="text-center">
                    <a class="totop"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <!-- right -->
            <div class="span4 smallspacetop">
                <ul class="social-links pull-right">
                    <li class="twitter-link">
                        <a href="#" class="twitter has-tip" target="_blank" title="Follow Us on Twitter">Twitter</a>
                    </li>
                    <li class="facebook-link">
                        <a href="#" class="facebook has-tip" target="_blank" title="Join us on Facebook">Facebook</a>
                    </li>
                    <li class="google-link">
                        <a href="#" class="google has-tip" title="Google +" target="_blank">Google</a>
                    </li>
                    <li class="linkedin-link">
                        <a href="#" class="linkedin has-tip" title="Linkedin" target="_blank">Linkedin</a>
                    </li>
                    <li class="pinterest-link">
                        <a href="#" class="pinterest has-tip" title="Pinterest" target="_blank">Pinterest</a>
                    </li>
                </ul>
                <div class="clearfix">
                </div>
            </div>
            <!-- end right -->
        </div>
    </div>
</div>
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('frontend_assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('frontend_assets/js/twitter-bootstrap-hover-dropdown.js') }}"></script>
<script src="{{ asset('frontend_assets/js/common.js') }}"></script>
<script src="{{ asset('frontend_assets/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('frontend_assets/js/jquery.isotope.min.js') }}"></script>
</body>

<!-- Mirrored from wbpreview.com/previews/WB0MN4GG2/index.html by HTTrack Website Copier/3.x [XR&CO'2010], Wed, 22 Oct 2014 21:01:59 GMT -->
</html>