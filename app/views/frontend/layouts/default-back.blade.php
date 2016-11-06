<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8" />
        <title>
            @section('title')
            @lang('general.site_name')
            @show
        </title>
        <meta name="keywords" content="your, awesome, keywords, here" />
        <meta name="author" content="Jon Doe" />
        <meta name="description" content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei." />

        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS
        ================================================== -->
        <link href="{{ asset('public_assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

        <style>
        @section('styles')
        body { padding-top: 70px; }
            @media screen and (max-width: 768px) {
                body { padding-top: 0px; }
            }
        /* Set the fixed height of the footer here */
        #footer {

          line-height: 40px;
          background-color: #f5f5f5;
          margin-top: 60px;
          padding-top: 10px;
        }
        @show
        </style>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Favicons
        ================================================== -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('public_assets/ico/apple-touch-icon-144-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('public_assets/ico/apple-touch-icon-114-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('public_assets/ico/apple-touch-icon-72-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" href="{{ asset('public_assets/ico/apple-touch-icon-57-precomposed.png') }}">
        <link rel="shortcut icon" href="{{ asset('public_assets/ico/favicon.png') }}">
    </head>

    <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"><span class="glyphicon glyphicon-home"></span> @lang('general.site_name')</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li {{ (Request::is('about-us') ? 'class="active"' : '') }}><a href="{{ URL::to('about-us') }}">@lang('form/title.Discover')</a></li>
            <li {{ (Request::is('contact-us') ? 'class="active"' : '') }}><a href="{{ URL::to('contact-us') }}">@lang('form/title.Start')</a></li>

          </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="{{Lang::get('form/title.Search')}}">
                </div>
                <button type="submit" class="btn btn-default">@lang('button.submit')</button>
            </form>
          <ul class="nav navbar-nav navbar-right">
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
                    <li><a href="{{ route('logout') }}"><i class="icon-off"></i> @lang('button.Logout')</a></li>
                </ul>
            </li>

            @if(Sentry::getUser()->hasAccess('posts.write'))
            <li{{ (Request::is('admin/posts*') ? ' class="active"' : '') }}><a href="{{ URL::to('admin/posts') }}"><i class="icon-list-alt icon-white"></i> @lang('form/title.Blog_Posts')</a></li>

            <li class="dropdown {{ (Request::is('admin/users*|admin/groups*') ? ' active' : '') }}">
                <a class="dropdown-toggle" data-toggle="dropdown" href="{{ URL::to('admin/users') }}">
                    <i class="icon-user icon-white"></i> @lang('form/title.Users') <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li{{ (Request::is('admin/users*') ? ' class="active"' : '') }}><a href="{{ URL::to('admin/users') }}"><i class="icon-user"></i>  @lang('form/title.Users')</a></li>
                    <li{{ (Request::is('admin/groups*') ? ' class="active"' : '') }}><a href="{{ URL::to('admin/groups') }}"><i class="icon-user"></i> @lang('form/title.Groups')</a></li>
                </ul>
            </li>
            @endif

            @else
            <li {{ (Request::is('auth/signup') ? 'class="active"' : '') }}><a href="{{ route('signup') }}">@lang('button.signup')</a></li>
            <li {{ (Request::is('auth/signin') ? 'class="active"' : '') }}><a href="{{ route('signin') }}">@lang('button.Log_in')</a></li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<!-- Begin page content -->

<div class="container">

    <!-- Notifications -->
    @include('frontend/notifications')

    <!-- Content -->
    @yield('content')

</div>

    <div id="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </div>

        <!-- Javascripts
        ================================================== -->
        <script src="{{ asset('public_assets/js/jquery.1.10.2.min.js') }}"></script>
        <script src="{{ asset('public_assets/js/bootstrap/bootstrap.min.js') }}"></script>
        @section('body_bottom')
        @show
    </body>
</html>
