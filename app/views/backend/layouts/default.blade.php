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
	<link rel="stylesheet/less" href="/backend_assets_new/less/admin/module.admin.stylesheet-complete.less" />
	-->

    <!--[if lt IE 9]><![endif]-->

    <link rel="stylesheet" href="{{ asset('/ideabank/public/backend_assets_new/css/skins/module.admin.stylesheet-complete.skin.purple-gray.min.css') }}/" />

    <!-- NikoshBAN -->
<!--    <link href="{{ asset('frontend_assets/fonts/NikoshBAN/stylessheet.css') }}" rel="stylesheet">-->
    <link href="{{ asset('frontend_assets/fonts/kalpurush/stylesheet.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/ideabank/public/backend_assets_new/css/style.css') }}/" />


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{ asset('backend_assets_new/library/jquery/jquery.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
    <script src="{{ asset('backend_assets_new/library/jquery/jquery-migrate.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
    <script src="{{ asset('backend_assets_new/library/modernizr/modernizr.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
    <script src="{{ asset('backend_assets_new/plugins/core_less-js/less.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
    <script src="{{ asset('backend_assets_new/plugins/charts_flot/excanvas.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
    <script src="{{ asset('backend_assets_new/plugins/core_browser/ie/ie.prototype.polyfill.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>    <script>if (/*@cc_on!@*/false && document.documentMode === 10) { document.documentElement.className+=' ie ie10'; }</script>


    <script src="{{ asset('backend_assets_new/library/bootstrap/js/bootstrap.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>

    <script src="{{ asset('backend_assets_new/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('backend_assets_new/plugins/ckeditor/adapters/jquery.js')}}"></script>
    <style>
        .glyphicons-filetype i:before{
            font-size: 24px;
            color:#2f65a7;
        }
        .select-editable {
            position:relative;
            background-color:white;
            border:solid grey 1px;
            width:120px;
            height:34px;
        }
        .select-editable select {
            position:absolute;
            top:-1px;
            left:-1px;
            font-size:14px;
            border:none;
            width:120px;
            margin:0;
        }
        .select-editable input {
            position:absolute;
            top:-1px;
            left:-1px;
            width:100px;
            padding:1px;
            font-size:12px;

        }
        #menu{
            background-color: #f1f1f1;
        }
        .select-editable select:focus, .select-editable input:focus {
            outline:none;
        }
        #menu #sidebar-fusion-wrapper #logoWrapper{
            height: 60px;
        }
        #menu > div > ul{
            top: 130px;
            background-color: #f1f1f1;
        }
    </style>
</head><body class="">

<!-- Main Container Fluid -->
<div class="container-fluid menu-hidden">

<!-- Sidebar Menu -->
<div id="menu" class="hidden-print hidden-xs">


<div id="sidebar-fusion-wrapper">


<div id="logoWrapper">
    <div class="media">
        <div class="media-body">
            <a href="" class="name">{{ Sentry::getUser()->first_name }}</a>
            <p><i class="fa fa-fw fa-circle-o text-success"></i> @lang('form/title.Online')</p>
        </div>
        <div class="clearfix"></div>
    </div>

   <!--sidebar start-->
       @include('backend/layouts/partials/left_menu')
       <!--sidebar end-->
</div>


</div>

</div>
<!-- // Sidebar Menu END -->
<!-- Content -->
<div id="content">
    <div class="navbar hidden-print main navbar-default" role="navigation">
        <div class="user-action user-action-btn-navbar pull-right">
            <button class="btn btn-sm btn-navbar btn-inverse btn-stroke hidden-lg hidden-md"><i class="fa fa-bars fa-2x"></i></button>
        </div>
        <a href="{{ URL::route('home') }}" class="logo">
            <img src="{{ asset('frontend_assets/img/a2i.png') }}" width="32"/>
            <span class="hidden-xs hidden-sm inline-block"><span style="color:#9962a6">{{Lang::get('form/title.idea')}}</span><span style="color:limegreen">{{Lang::get('form/title.bank')}}</span></span>
        </a>

        <ul class="main pull-right">
            <li class="hidden-xs hidden-sm">
                <a href="#modal-compose" data-toggle="modal" class="btn btn-success"><i class="fa fa-fw fa-envelope"></i>@lang('button.send_message')</a>
            </li>
            <li class="dropdown username hidden-xs">
                <a data-toggle="dropdown" class="dropdown-toggle" href="">
                    <img alt="Profile" class="img-circle" width="32" src="{{ asset(Sentry::getUser()->avatar->url('medium')) }}">
                    {{ Sentry::getUser()->first_name }}
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{{ route('profile') }}" class="glyphicons user"><i></i>@lang('button.Account')</a></li>
                    <li><a href="{{ route('account/messages',Sentry::getUser()->id) }}" class="glyphicons envelope"><i></i>@lang('button.Messages')</a></li>
                    <li><a href="{{ route('account/ideas',Sentry::getUser()->id) }}" class="glyphicons lightbulb"><i></i>@lang('button.Ideas')</a></li>
                    <li><a href="{{ route('logout') }}" class="glyphicons lock no-ajaxify"><i></i>@lang('button.Logout')</a></li>
                </ul>
            </li>
        </ul>
    </div>
    @yield('content_title')
    <div class="innerLR">
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


<!-- Modal -->
<div class="modal fade" id="modal-compose">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><i class="fa fa-fw fa-envelope"></i>{{Lang::get('form/title.send_message')}}</h3>
            </div>
            <!-- // Modal heading END -->

            <!-- Modal body -->
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" action="{{ route('create/message') }}" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="redirect" value="profile" />
                    <div class="">
                        <div class="innerLR">
                            <div class="form-group">
                                {{ Form::label('to', Lang::get('form/title.mobile'), array('class'=>'col-sm-2 control-label')) }}
                                <div>
                                    <div class="input-group">
                                        {{ Form::input('text', 'receiver_mobile', Input::old('receiver_mobile'), array('class'=>'form-control','id'=>'receiver_mobile')) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('body', Lang::get('form/title.Body'), array('class'=>'col-sm-2 control-label')) }}
                        <div class="col-sm-8">
                            {{ Form::textarea('body', Input::old('body'), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.Body'))) }}
                        </div>
                    </div>
                    <!-- Form actions -->
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-success">@lang('button.send')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->

<!-- Global -->
<script data-id="App.Config">
    var App = {};        var basePath = '',
        commonPath = '/backend_assets_new/',
        rootPath = '../',
        DEV = false,
        componentsPath = '/backend_assets_new/components/';

    var primaryColor = '#c72a25',
        dangerColor = '#b55151',
        successColor = '#609450',
        infoColor = '#4a8bc2',
        warningColor = '#ab7a4b',
        inverseColor = '#45484d';

    var themerPrimaryColor = primaryColor;

</script>


<script src="{{ asset('backend_assets_new/plugins/core_nicescroll/jquery.nicescroll.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/core_breakpoints/breakpoints.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/core_preload/pace.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/components/core_preload/preload.pace.init.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/components/forms_elements_fuelux-checkbox/fuelux-checkbox.init.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/components/forms_elements_fuelux-radio/fuelux-radio.init.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>

<script src="{{ asset('backend_assets_new/components/menus/sidebar.main.init.js?v=v1.0.0-rc1') }}"></script>
<script src="{{ asset('backend_assets_new/components/menus/sidebar.collapse.init.js?v=v1.0.0-rc1') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/forms_elements_bootstrap-select/js/bootstrap-select.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/components/forms_elements_bootstrap-select/bootstrap-select.init.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>

<script src="{{ asset('backend_assets_new/plugins/forms_elements_inputmask/jquery.inputmask.bundle.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>

<script src="{{ asset('backend_assets_new/plugins/forms_elements_select2/js/select2.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/components/forms_elements_select2/select2.init.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>

<script src="{{ asset('backend_assets_new/plugins/forms_elements_bootstrap-datepicker/js/bootstrap-datepicker.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/ui_modals/bootbox.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/components/ui_modals/modals.init.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/admin_notifications_gritter/js/jquery.gritter.min.js?v=v1.0.0-rc1') }}"></script>
<script src="{{ asset('backend_assets_new/components/admin_notifications_gritter/gritter.init.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>

<script src="{{ asset('backend_assets_new/plugins/tables_datatables/js/jquery.dataTables.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/tables_datatables/extras/TableTools/media/js/TableTools.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/tables_datatables/extras/ColVis/media/js/ColVis.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/components/tables_datatables/js/DT_bootstrap.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/tables_datatables/extras/FixedHeader/FixedHeader.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/tables_datatables/extras/ColReorder/media/js/ColReorder.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/components/tables_datatables/js/datatables.init.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('frontend_assets/js/jquery.jqEasyCharCounter.min.js') }}"></script>

<script src="{{ asset('backend_assets_new/components/core/core.init.js?v=v1.0.0-rc1') }}"></script>

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
@yield('body_bottom')

</body>
</html>