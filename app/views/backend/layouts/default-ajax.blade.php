<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 paceSimple sidebar sidebar-fusion"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 paceSimple sidebar sidebar-fusion"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 paceSimple sidebar sidebar-fusion"> <![endif]-->
<!--[if gt IE 8]> <html class="ie paceSimple sidebar sidebar-fusion"> <![endif]-->
<!--[if !IE]><!--><html class="paceSimple sidebar sidebar-fusion"><!-- <![endif]-->
<head>
    <title>
        @section('title')
        @lang('general.site_name')
        @show
    </title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">

    <!--
        **********************************************************
        In development, use the LESS files and the less.js compiler
        instead of the minified CSS loaded by default.
        **********************************************************
        <link rel="stylesheet/less" href="../assets/less/admin/module.admin.stylesheet-complete.less" />
        -->

    <!--[if lt IE 9]><link rel="stylesheet" href="{{ asset('backend_assets_new/components/library/bootstrap/css/bootstrap.min.css')}}" /><![endif]-->

    <link rel="stylesheet" href="{{ asset('backend_assets_new/css/skins/module.admin.stylesheet-complete.skin.purple-gray.min.css') }}/" />



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{ asset('backend_assets_new/plugins/core_ajaxify_loadscript/script.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2')}}"></script>

    <script>var App = {};</script>

    <script data-id="App.Scripts">
        App.Scripts = {

            /* CORE scripts always load first; */
            core: [
                '{{ asset('backend_assets_new/library/jquery/jquery.min.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/library/modernizr/modernizr.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}'
            ],

            /* PLUGINS_DEPENDENCY always load after CORE but before PLUGINS; */
            plugins_dependency: [
                '{{ asset('backend_assets_new/library/bootstrap/js/bootstrap.min.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/library/jquery/jquery-migrate.min.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}'
            ],

            /* PLUGINS always load after CORE and PLUGINS_DEPENDENCY, but before the BUNDLE / initialization scripts; */
            plugins: [
                '{{ asset('backend_assets_new/plugins/core_ajaxify_davis/davis.min.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/plugins/core_ajaxify_lazyjaxdavis/jquery.lazyjaxdavis.min.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/plugins/core_preload/pace.min.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/plugins/core_nicescroll/jquery.nicescroll.min.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/plugins/core_breakpoints/breakpoints.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/plugins/forms_elements_bootstrap-select/js/bootstrap-select.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/plugins/forms_elements_select2/js/select2.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}',
                '{{ asset('backend_assets_new/plugins/forms_elements_bootstrap-datepicker/js/bootstrap-datepicker.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/plugins/ui_modals/bootbox.min.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/plugins/admin_notifications_gritter/js/jquery.gritter.min.js?v=v1.0.0-rc1')}}',
                '{{ asset('backend_assets_new/plugins/core_less-js/less.min.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/plugins/core_browser/ie/ie.prototype.polyfill.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}'
            ],

            /* The initialization scripts always load last and are automatically and dynamically loaded when AJAX navigation is enabled; */
            bundle: [
                '{{ asset('backend_assets_new/components/core_ajaxify/ajaxify.init.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/components/core_preload/preload.pace.init.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/components/forms_elements_fuelux-checkbox/fuelux-checkbox.init.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/components/menus/sidebar.main.init.js?v=v1.0.0-rc1')}}',
                '{{ asset('backend_assets_new/components/menus/sidebar.collapse.init.js?v=v1.0.0-rc1')}}',
                '{{ asset('backend_assets_new/components/forms_elements_bootstrap-select/bootstrap-select.init.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',

                '{{ asset('backend_assets_new/components/forms_elements_bootstrap-datepicker/bootstrap-datepicker.init.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/components/ui_modals/modals.init.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/components/admin_notifications_gritter/gritter.init.js?v=v1.0.0-rc1&sv=v0.0.1.2')}}',
                '{{ asset('backend_assets_new/components/core/core.init.js?v=v1.0.0-rc1')}}'
            ]

        };
    </script>

    <script>
        $script(App.Scripts.core, 'core');

        $script.ready(['core'], function(){
            $script(App.Scripts.plugins_dependency, 'plugins_dependency');
        });
        $script.ready(['core', 'plugins_dependency'], function(){
            $script(App.Scripts.plugins, 'plugins');
        });
        $script.ready(['core', 'plugins_dependency', 'plugins'], function(){
            $script(App.Scripts.bundle, 'bundle');
        });

    </script>
    <script>if (/*@cc_on!@*/false && document.documentMode === 10) { document.documentElement.className+=' ie ie10'; }</script>


</head><body class="">

<!-- Main Container Fluid -->
<div class="container-fluid menu-hidden">

<!-- Sidebar Menu -->
<div id="menu" class="hidden-print hidden-xs">


<div id="sidebar-fusion-wrapper">
<!--        <input class="form-control search" type="text" placeholder="Search...">-->
<div class="search-wrapper">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="{{Lang::get('form/title.Search')}}">
            <span class="input-group-btn">
                <button class="btn btn-inverse" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </span>
    </div><!-- /input-group -->
</div>

<div id="logoWrapper">
    <div class="media">
        <div class="media-body">
            <a href="" class="name">{{ Sentry::getUser()->first_name }}</a>
            <p><i class="fa fa-fw fa-circle-o text-success"></i> @lang('form/title.Online')</p>
        </div>
        <div class="clearfix"></div>
    </div>
    <select class="selectpicker" data-style="btn-inverse" id="select_project">
        <option>@lang('form/title.Select_Project')</option>
        <option value="project_milestones.html">Project #1</option>
        <option value="project_milestones.html">Project #2</option>
        <option value="project_milestones.html">Project #3</option>
    </select>
</div>
    <!--sidebar start-->
    @include('backend/layouts/partials/left_menu')
    <!--sidebar end-->

</div>







</div>
<!-- // Sidebar Menu END -->

<!-- Content -->
<div id="content">

<div class="navbar hidden-print main navbar-default" role="navigation">
    <div class="user-action user-action-btn-navbar pull-right">
        <button class="btn btn-sm btn-navbar btn-inverse btn-stroke hidden-lg hidden-md"><i class="fa fa-bars fa-2x"></i></button>
    </div>
    <a href="index.html" class="logo">
        <img src="/backend_assets_new/images/logo/logo.jpg" width="32" alt="SMART" />
        <span class="hidden-xs hidden-sm inline-block"><span style="color:#9962a6">{{Lang::get('form/title.idea')}}</span><span style="color:limegreen">{{Lang::get('form/title.bank')}}</span></span>
    </a>

    <ul class="main pull-right">
        <li class="dropdown username hidden-xs ">
            <a href="" class="dropdown-toggle" data-toggle="dropdown"> {{ Sentry::getUser()->first_name }} <span class="caret"></span></a>

            <ul class="dropdown-menu pull-right">
                <li><a href="{{ route('account') }}" class="glyphicons user"><i></i> @lang('button.Account')</a></li>
                <li><a href="{{ route('logout') }}" class="glyphicons lock no-ajaxify"><i></i>@lang('button.Logout')</a></li>
            </ul>
        </li>
    </ul>
</div>
<!-- // END navbar -->
    <div class="top-content-menu">
        <a data-target="#top-menu" data-toggle="collapse" class="visible-xs " href="#">Submenu <i class="fa fa-caret-down pull-right"></i></a>
        <div id="top-menu" class="collapse in">
            <ul class="list-unstyled ">
                <li><a href="{{ route('create/idea') }}">@lang('button.Submit_Idea')</a></li>
                <li class=""><a href="{{ route('unsortedlist/idea') }}">@lang('button.New_Ideas')</a></li>
                <li class=""><a href="{{ route('shortlist/idea') }}">@lang('button.Short_list_Ideas')</a></li>
                <li class=""><a href="{{ route('ideas') }}">@lang('button.Sorted_Ideas')</a></li>
            </ul>
        </div>
    </div>
    <br/>
    @yield('content_title')
    <div class="innerLR">
        <!-- page start-->
        <!-- Notifications -->
        @include('frontend/notifications')

        <!-- Content -->
        @yield('content')
        <!-- page end-->
    </div>

</div>
<!-- // Content END -->

<div class="clearfix"></div>
<!-- // Sidebar menu & content wrapper END -->

<div id="footer" class="hidden-print">

    <!--  Copyright Line -->
    <div class="copy">&copy; 2014 - <a href="http://www.a2i.gov.bd">A2I</a> - All Rights Reserved. </div>
    <!--  End Copyright Line -->

</div>

<!-- // Footer END -->

</div>
<!-- // Main Container Fluid END -->


<!-- Global -->
<script data-id="App.Config">
    var basePath = '',
        commonPath = '{{ asset('backend_assets_new/')}}',
        rootPath = '../',
        DEV = false,
        componentsPath = '{{ asset('backend_assets_new/components/')}}';

    var primaryColor = '#c72a25',
        dangerColor = '#b55151',
        successColor = '#609450',
        infoColor = '#4a8bc2',
        warningColor = '#ab7a4b',
        inverseColor = '#45484d';

    var themerPrimaryColor = primaryColor;

    App.Config = {
        ajaxify_menu_selectors: ['#menu'],
        ajaxify_layout_app: false        };

</script>

@yield('body_bottom')

</body>
</html>