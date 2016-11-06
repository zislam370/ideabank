@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/users/form.User_Management') ::
@parent
@stop

{{-- Page content --}}
@section('content')
<h1 class="innerLR margin-none">@lang('admin/users/title.management')</h1>
<div class="innerLR">
    <!-- Search Bar -->
    <div class="input-group">
        <input type="text" placeholder="Search topic" class="form-control">
        <span class="input-group-btn">
            <button type="button" class="btn btn-primary rounded-none"><i class="fa fa-search"></i></button>
        </span>
    </div>
    <!-- End Search Bar -->
</div>
<div class="innerAll border-top">
    <div class="row">
        <div class="col-md-12">
            <div class="widget">

                <!-- Category Heading -->
                <div class="widget-head">
                    <a class="btn btn-xs strong btn-info pull-right" href="{{ route('create/user') }}"><i class="fa fa-plus fa-fw"></i> @lang('button.create_user')</a>
                    <h4 class="margin-none">@lang('admin/users/title.list')</h4>
                    <div class="clearfix"></div>
                </div>
                <!-- End Category Heading -->

                @foreach ($users as $user)
                <!-- Category Listing -->
                <div class="bg-gray-hover overflow-hidden">
                    <div class="row innerAll half  border-bottom">
                        <div class="col-sm-6 col-xs-9">
                            <ul class="media-list margin-none">
                                <li class="media">
                                    <a href="#" class="pull-left innerAll half hidden-xs">
                                        <span class="empty-photo"><i class="fa fa-folder-o fa-2x text-faded innerT half"></i></span>
                                    </a>
                                    <div class="media-body">
                                        <div class="innerAll half">
                                            <h4 class="margin-none"><a href="{{ route('user/profile',$user->id) }}">{{{ $user->first_name }}}</a></h4>
                                            <div class="clearfix"></div>
                                            <span class="margin-none text-muted-dark">{{{ $user->first_name }}}</span>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-3 col-xs-3">
                            <div class="text-center pull-right innerT innerR ">
                                <p class="strong padding-none margin-none">101</p>
                                <span class="text-muted">posts</span>
                            </div>
                        </div>
                        <div class="col-sm-3 hidden-xs ">
                            <div class="innerAll half pull-right ">
                                <div class="media ">
                                    <a class="pull-left" href="">
                                        <img src="{{{$user->avatar->url('medium')}}}" alt="image" class="center-block img-circle img-thumbnail img-responsive">
                                    </a>
                                    <div class="media-body innerT half">
                                        <a href="">mosaicpro</a>
                                        <small class="display-block text-muted-dark">5 hrs ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- // END Category Listing -->


            </div>

        <!-- // END col-separator -->
        </div>
    </div>
</div>
<section class="panel">

        <header class="panel-heading">
            @lang('admin/users/title.management')

            <div class="pull-right">
            </div>
        </header>
        <div>
                <div>
                    <ul class="nav nav-pills">
                      <li><a class="btn btn-medium" href="{{ URL::to('admin/users?withTrashed=true') }}">@lang('form/title.Include_Deleted_Users')</a></li>
                      <li><a class="btn btn-medium" href="{{ URL::to('admin/users?onlyTrashed=true') }}">@lang('form/title.Include_Only_Deleted_Users')</a></li>
                    </ul>
                </div><br>
           @foreach ($users as $user)
                <tr
                @if ($user->accountStatus()=='suspended')
                <?php echo ' class="warning"'; ?>
                @elseif ($user->accountStatus()=='banned')
                <?php echo ' class="danger"'; ?>
                @endif>
              <div>
                <div class="bg-gray-hover overflow-hidden">
                        <div class="row innerAll half  border-bottom">
                            <div class="col-sm-6 col-xs-9">
                                <ul class="media-list margin-none">
                                    <li class="media">
                                      <a class="pull-left innerAll half hidden-xs" href="#">

                                      <img src="{{{$user->avatar->url('medium')}}}" alt="image" class="center-block img-circle img-thumbnail img-responsive">
                                    </a>
                                    <div class="media-body">
                                        <div class="innerAll half">
                                            <h4 class="margin-none"><a href="{{ route('user/profile',$user->id) }}">{{{ $user->first_name }}}</a></h4>
                                            <div class="clearfix"></div>
                                            <span class="margin-none text-muted-dark"></span>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-1 col-xs-6">
                            <div class="text-center pull-right innerT innerR ">
                                @lang('general.' . ($user->isActivated() ? 'active' : 'deactivate'))
                            </div>
                        </div>
                        <div class="col-sm-1 col-xs-6">
                            <div class="text-center pull-right innerT innerR ">
                              {{{ $user->created_at->diffForHumans() }}}
                            </div>
                        </div>
                        <div class="col-sm-3 hidden-xs ">
                            <div class="innerAll half pull-right ">
                                <div class="media ">
                                    <a href="" class="pull-right">
                                     <a class="btn btn-primary btn-xs"  href="{{ route('update/user', $user->id) }}"><i class="fa fa-pencil"></i></a>
                                     @if ( ! is_null($user->deleted_at))
                                     <a href="{{ route('restore/user', $user->id) }}"><span class="glyphicon glyphicon-ok"></span></a>
                                     @else
                                     @if (Sentry::getId() !== $user->id)
                                     <a href="{{ route('confirm-delete/user', $user->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-trash-o "></i></a>
                                     @else
                                     <i class="fa fa-trash-o "></i>
                                     @endif
                                     @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           @endforeach
</section>


@if (count($users))
<div class="row">
{{ $users->links() }}
</div>
@endif
@stop
