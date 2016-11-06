<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/flatlab/horizontal_menu.html by HTTrack Website Copier/3.x [XR&CO'2010], Fri, 03 Oct 2014 18:40:15 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<!--    <link href="{{ asset('frontend_assets/fonts/NikoshBAN/stylessheet.css') }}" rel="stylesheet">-->
    <!-- Kalpurush -->
<!--        <link href="{{ asset('frontend_assets/fonts/kalpurush/stylesheet.css') }}" rel="stylesheet">-->
    <!-- SolemanLipi -->
        <link href="{{ asset('frontend_assets/fonts/SolaimanLipiNormal/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend_assets/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('backend_assets_new/plugins/forms_elements_select2/css/select2.css') }}" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('backend_assets_new/library/modernizr/modernizr.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
    <style>
        #bdgov {
            background-image: url("{{ asset('frontend_assets/img/social-network-sprite.png') }}");
            background-position: -99px 0;
            background-repeat: no-repeat;
            display: block;
            float: left;
            height: 57px;
            margin-right: 10px;
            text-indent: -9999px;
            width: 59px;
        }
        #undp {
            background-image: url("{{ asset('frontend_assets/img/social-network-sprite.png') }}");
            background-position: -62px 0;
            background-repeat: no-repeat;
            display: block;
            float: left;
            height: 62px;
            margin-right: 10px;
            text-indent: -9999px;
            width: 31px;
        }
        #usaid {
            background-image: url("{{ asset('frontend_assets/img/social-network-sprite.png') }}");
            background-position: 0 0;
            display: block;
            float: left;
            height: 58px;
            margin-right: 49px;
            text-indent: -9999px;
            width: 58px;
        }
        #facebook {
            background-image: url("{{ asset('frontend_assets/img/social-network-sprite.png') }}");
            background-position: -357px 43px;
            display: block;
            float: left;
            height: 36px;
            text-indent: -9999px;
            width: 36px;
        }
        #twitter {
            background-image: url("{{ asset('frontend_assets/img/social-network-sprite.png') }}");
            background-position: -6px -157px;
            display: block;
            float: left;
            height: 36px;
            padding-left: 5px;
            text-indent: -9999px;
            width: 36px;
        }
        #youtube {
            background-image: url("{{ asset('frontend_assets/img/social-network-sprite.png') }}");
            background-position: -207px 43px;
            display: block;
            float: left;
            height: 36px;
            padding-left: 5px;
            text-indent: -9999px;
            width: 36px;
        }


    </style>
</head>

<body>

<div id="wrap">
    <div id="main">
        <div class="navbar navbar-inverse navbar-white navbar-fixed-top" id="top-nav-bar">
            <div class="container" >
                <div class="navbar-header">
                    <ul class="navbar-brand">
                        <a href="{{ ('http://a2i.pmo.gov.bd/') }}"><img  src="{{ asset('frontend_assets/img/a2i.png') }}" width="40"></a>
                        <a href="{{ URL::route('home') }}"><span style="color:#683091" id="ideabank">{{Lang::get('form/title.idea')}} <span  style="color:#3fb618 "> {{Lang::get('form/title.bank')}}</span></span></a>
                    </ul>
                    <button data-target="#navbar-main" data-toggle="collapse" type="button" class="navbar-toggle">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar-main" class="navbar-collapse collapse" style="">
                    <ul class="nav navbar-nav navbar-right" id="login-box">
                        <li><a href="{{ URL::to('home') }}">@lang('form/title.Home')</a></li>
                        @if (Sentry::check() && Sentry::getUser())
                        <?php $applicant = Sentry::findGroupByName('Applicant'); ?>
                        @if (Sentry::getUser()->inGroup($applicant))
                        <li{{ (Request::is('account/public*') ? ' class="active"' : '') }}><a href="{{ URL::to('/account/public') }}"><i class="fa fa-user"></i> {{ Sentry::getUser()->first_name }}</a></li>
                        @else
                        <li><a href="{{ URL::to('account') }}"><i class="fa fa-user"></i> {{ Sentry::getUser()->first_name }}</a></li>
                        @endif
                        <li><a href="{{ route('logout') }}" class="glyphicons lock no-ajaxify"><i class="fa fa-sign-out"></i> @lang('button.sign_out')</a></li>
                        @else

                        <li {{ (Request::is('auth/signup') ? 'class="active"' : '') }}><a href="{{ route('signup') }}">@lang('button.signup')</a></li>
                        <li {{ (Request::is('auth/signin') ? 'class="active"' : '') }}><a href="{{ route('signin') }}">@lang('button.signin')</a></li>
                        @endif
                        <li>
                            <a class="gel-buttond" style="text-decoration: underline" href="{{ route('myideas') }}">@lang('button.submitidea')</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        <!-- Content -->
        @yield('banner')

        <div id="main-container" class="container">

            <!-- Content -->
            @yield('content')

        </div>
    </div>
</div>
<!--main content end-->
<!--footer start-->
<footer class="footer">
    <div id="footer" class="container">
        <div id="footer-content">
            <div id="our-partners">
                <div id="our-parner-title"></div>
                <a id="bdgov" rel="http://www.bangladesh.gov.bd" title="Bangladesh Government" href="http://www.bangladesh.gov.bd">http://www.bangladesh.gov.bd</a>
                <a id="undp" rel="http://www.undp.org.bd" title="UNDP" href="http://www.undp.org.bd">http://www.undp.org.bd</a>
                <a id="usaid" rel="http://www.usaid.gov/where-we-work/asia/bangladesh" title="USAID" href="http://www.usaid.gov/where-we-work/asia/bangladesh">http://www.usaid.gov/where-we-work/asia/bangladesh</a>
            </div><!-- end of our-partner -->
            <div id="footeer-menu">
                <div class="region region-footer-menu">
                    <div class="block block-menu" id="block-menu-menu-footer-menu">
                        <div class="content">
                            <ul class="menu"><li class="first leaf menu-629"><a class="ac" title="" href="{{ URL::route('home') }}">@lang('form/title.Home')</a><div></div></li>
                                <li class="leaf menu-631"><a class="active" title="" href="{{ URL::route('view-page','faq') }}">FAQ</a><div></div></li>
                                <li class="last leaf menu-634"><a title="" href="{{ URL::route('contact-us') }}">@lang('form/title.Contact_Us')</a><div></div></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="copyright">©
                    @lang('form/title.copyright')
                    ২০১৫ (Access To Information (a2i) Programme)</div>
            </div><!-- end of footer-menu -->
            <div id="social-networks">
                <div id="social-network-title"></div>
                <a id="facebook" rel="https://www.facebook.com/A2IBangladesh" title="?????? ?????? ????" href="https://www.facebook.com/A2IBangladesh">https://www.facebook.com/A2IBangladesh</a>
                <a id="twitter" rel="http://www.twitter.com" title="?????? ?????? ????" href="https://twitter.com/a2i_bd">http://www.twitter.com</a>
                <a id="youtube" rel="http://www.youtube.com/user/a2ibangladesh" title="?????? ?????? ????" href="https://www.youtube.com/channel/UC9Qe9Cbf-MZYwawshQBmlGA">http://www.youtube.com/</a>
            </div><!-- end of social-network -->

        </div><!-- end of footer-content -->
    </div>

</footer>


<!-- js placed at the end of the document so the pages load faster -->
<script src="{{ asset('backend_assets_new/library/jquery/jquery.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('frontend_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('backend_assets_new/plugins/ckeditor/adapters/jquery.js')}}"></script>
<script src="{{ asset('frontend_assets/js/jquery.jqEasyCharCounter.min.js') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/forms_elements_select2/js/select2.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>

<script>
    $(function () {
    });
    function load_basic_ckeditor(txt_fld_id){
        var editor = CKEDITOR.instances[txt_fld_id];
        if (editor) { editor.destroy(true); }

        CKEDITOR.config.toolbar_Basic = [['Bold','Italic','Underline',
            '-','JustifyLeft','JustifyCenter','JustifyRight','-','Undo','Redo']];
        CKEDITOR.config.toolbar = 'Basic';
//        CKEDITOR.config.width=400;
//        CKEDITOR.config.height=300;
        CKEDITOR.replace('text_id', CKEDITOR.config);
    }
</script>
@yield('page_scripts')

</body>

<!-- Mirrored from thevectorlab.net/flatlab/horizontal_menu.html by HTTrack Website Copier/3.x [XR&CO'2010], Fri, 03 Oct 2014 18:40:16 GMT -->
</html>
