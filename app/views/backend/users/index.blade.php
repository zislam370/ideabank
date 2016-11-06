@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/users/form.User_Management') ::
@parent
@stop

{{-- Page content --}}
@section('content')
<h3 class="innerLR margin-none">@lang('admin/users/title.management')</h3>

<div class="innerAll border-top">
    <div class="row">
        <div class="col-md-3">
            <div class="widget">
                    <div class="widget-head">
                        <!-- Heading -->
                        <h4 class="margin-bottom-none">@lang('admin/users/form.Filter')</h4>
                    </div>
                <form method="get" action="" class="">
                    <!-- Listing -->
                    <div class="bg-gray-hover border-bottom">
                        <div class="innerAll half">
                            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="{{{ Lang::get('admin/users/form.User_name')}}}" value="{{{ Input::get('first_name') }}}">
                        </div>
                    </div>

                    <div class="bg-gray-hover border-bottom">
                        <div class="innerAll half">
                            <div>

                               @lang('admin/users/form.User_Type')<br>
                                {{ Form::select('role', array(''=>'')+$roles , Input::get('role'), array('class'=>'form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-hover border-bottom">
                        <div class="innerAll half">
                            <div>
                                @lang('admin/users/form.Organization_Type')<br>
                                {{Form::select('user_type', array(''=>'','Individual'=>'Individual', 'Organization'=>'Organization'),Input::get('user_type'), array('id'=>'user_type','class'=>'form-control'));}}
                            </div>
                        </div>
                    </div>
<!--                    <div class="bg-gray-hover border-bottom">-->
<!--                        <div class="innerAll half">-->
<!--                            {{Form::select('field_name', array(''=>'','Individual'=>'Individual', 'Organization'=>'Organization'),Input::old('user_type'), array('id'=>'user_type','class'=>'form-control'));}}-->
<!--                            <input type="text" id="field_value" name="field_value" class="form-control" value="{{{ Input::old('first_name') }}}">-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="bg-gray-hover border-bottom">
                        <div class="innerAll half">
                            <div>
                                <button class="btn btn-primary" type="submit">@lang('admin/users/form.Search')</button>
                            </div>
                        </div>
                    </div>
                    <!-- // END Listing -->
                </form>
            </div>
        <!-- // END col-separator -->
         </div>
            <div class="col-md-9">
                <div class="widget">
                 <!-- Category Heading -->
                     <div class="widget-head">
                         <a class="btn btn-xs strong btn-info pull-right" href="{{ route('create/user') }}"><i class="fa fa-plus fa-fw"></i> @lang('button.create_user')</a>
                         <h4 class="margin-none">@lang('admin/users/title.list')</h4>
                         <div class="clearfix"></div>
                         {{ $users->appends(Input::except('page'))->links() }}
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
                                            <img src="{{ asset($user->avatar->url('thumb')) }}" alt="image" class="center-block img-circle img-thumbnail" width="50" height="50">
                                         </a>
                                         <div class="media-body">
                                             <div class="innerAll half">
                                                 <h4 class="margin-none">
                                                     <a href="{{ route('user/profile',$user->id) }}">
                                                         {{{ $user->first_name }}}
                                                     </a>
                                                     </h4>
                                                 <span style="font-size: 12px"> ( {{{ $user->mobile }}} )</span>
                                                 <div class="clearfix"></div>
                                                 <span class="margin-none text-muted-dark">
                                                 <?php foreach($user->getGroups() as $group){ ?>
                                                   {{ $group->name }}
                                                   <?php } ?></span>
                                             </div>
                                         </div>
                                     </li>
                                 </ul>
                             </div>
                             <div class="col-sm-3 col-xs-3">
                                 <div class="text-center pull-right innerT innerR ">
                                     <p class="strong padding-none margin-none">{{{ $user->user_type }}}</p>
                                 </div>
                             </div>
                             <div class="col-sm-3 hidden-xs ">
                                 <div class="innerAll half pull-right ">
                                     <div class="media ">
                                         <a class="pull-left" href="">
                                         </a>
                                         <div class="media-body innerT half">
                                             @lang('admin/users/title.Created')
                                             <small class="display-block text-muted-dark">{{{ $user->created_at->diffForHumans() }}}</small>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     @endforeach
                    <div class="clearfix"></div>
                    <!-- // END Category Listing -->
                </div>
                 <!-- // END col -->
             </div>
        	<!-- // END row -->
      </div>
</div>
</section>


@if (count($users))
<div class="row">

</div>
@endif
@stop
