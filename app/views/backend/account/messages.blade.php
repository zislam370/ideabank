@extends('backend/layouts/account')

{{-- Page title --}}
@section('title')
@lang('account/title.messages') ::
@parent
@stop

{{-- Account page content --}}
@section('account-content')


<div class="widget widget-tabs-content widget-tabs-responsive widget-none">
<!-- Tabs Heading -->
<div class="widget-head bg-background text-center">
    <ul>
        <li>
        @if (Sentry::check() && (Sentry::getUser()->id==$user->id))
            <a class="glyphicons lock" href="{{ route('profile') }}">
                <i></i>@lang('form/title.Profile')
            </a>
        @else
            <a class="glyphicons lock" href="{{ route('user/profile',$user->id) }}">
                <i></i>@lang('form/title.Profile')
            </a>
        @endif
        </li>
        <li>
        <a  class="glyphicons lightbulb" href="{{ route('account/ideas',$user->id) }}">

                <i></i>{{Lang::get('form/title.idea')}}
            </a>
        </li>
        <li class="active">
        @if (Sentry::check() && (Sentry::getUser()->id==$user->id))
            <a class="glyphicons envelope" href="{{ route('account/messages',$user->id) }}">
                <i></i>{{Lang::get('form/title.Messages')}}
            </a>
        @else
            <a class="glyphicons envelope" href="{{ route('account/messages',$user->id) }}">
                <i></i>{{Lang::get('form/title.Messages')}}
            </a>
        @endif
        </li>

        </li>
        {{--<li>
            <a class="glyphicons share_alt" href="{{ route('account/ideas',$user->id) }}">
                <i></i>History Log
            </a>
        </li>--}}
    </ul>
</div>
<!-- // Tabs Heading END -->
    <div class="widget-body">
        <h4>Messages : ({{$user->mobile}})</h4>
        <div class="separator"></div>
        <!-- MESSAGES START -->
        <div class="row row-merge bg-white">
            <div id="email_list" class="col-lg-4 col-md-6">
                <div class="col-table">
                    <div class="input-group border-bottom bg-gray">
                <span class="input-group-btn">
                    <a class="btn" href=""><i class="fa fa-search text-muted"></i></a>
                </span>
                        <input type="text" placeholder="Search" class="form-control border-none rounded-none">
                    </div>
                    <div class="col-table-row">
                        <div class="col-app col-unscrollable">
                            <div class="col-app">
                                @foreach ($msg_user_list as $msg_user)
                                    <div class="list-group email-item-list" style="margin-bottom: 0">
                                        <a class="list-group-item padding-none" href="javascript:;" onclick="get_user_messages('{{ route('view/message',array($user->id,$msg_user->user_id))}}','{{$msg_user->mobile}}')" >
                                        <span class="innerTB display-block">
                                            <span class="media">
                                                <span class="pull-left text-center innerLR innerT display-block half">
                                                {{$msg_user->in_out}}
                                                    @if($msg_user->in_out=="OUT")
                                                    <i class="fa fa-fw fa-arrow-circle-right"></i>
                                                    @else
                                                    <i class="fa fa-fw fa-arrow-circle-left"></i>
                                                    @endif
                                                </span>
                                                <span class="media-body display-block innerR">
                                                    <span class="media display-block innerB">
                                                        <img width="40" class="pull-left" alt="" src="../../assets/images/people/80/1.jpg">
                                                        <span class="media-body display-block">
                                                            <small class="text-muted pull-right">{{$msg_user->msg_time}}</small>
                                                            <span class="h5 text-muted-dark text-weight-normal">{{$msg_user->first_name}}</span><br>
                                                            <span class="h5 text-muted text-weight-normal">{{$msg_user->mobile}}</span><br>
                                                        </span>
                                                        <span class="clearfix"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </span>
                                        </a>
                                    </div>
                                    <!-- // END list-group -->
                                @endforeach
                            </div>
                            <!-- // END col-app -->
                        </div>
                        <!-- // END col-app -->
                    </div>
                    <!-- // END col-table-row -->
                </div>
                <!-- // END col-table -->

                <!-- // END col-separator -->
            </div>
            <!-- // END col -->
            <div id="email_details" class="col-lg-8 col-md-6 hidden-sm hidden-xs ">
                <div class="col-table bg-white">
                    <div class="col-table-row">
                        <div class="col-app col-unscrollable">
                            <div class="innerAll border-bottom bg-gray text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="#modal-compose" data-toggle="modal" class="btn btn-default"><i class="fa fa-reply"></i></a>
                                </div>

                                <div class="col-app" id="user_msg">

                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col 2 -->
        </div>
        <!-- // END MESSAGES -->
        <div class="clearfix"></div>
    </div>
</div>
<style>
    .messageL{
        float:left;
        background-color: #666;
        color: #fff;
        margin-bottom: 10px;
        padding: 10px!important;
    }
    .messageR{
        float:right;
        background-color: #fff;
        color: #000;
        margin-bottom: 10px;
        padding: 10px!important;
    }
</style>
@stop




