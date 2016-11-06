@extends('frontend/layouts/account')

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
            <a class="glyphicons envelope" href="{{ route('account/messages') }}">
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
    <div class="separator"></div>
                 <div class="row">
                     <div class="col-md-6">
                         <h4>Inbox</h4>
                         <div class="innerT">
                             <div class="widget widget-none bg-white ">
                                 <div class="widget-body padding-none">
                                     <div class=" media innerAll overflow-visible margin-none">
                                         <div class="media-body">
                                            <li>
                                                <div class="media">
                                                    <div class="pull-left">
                                                        <img width="35" class="media-object img-rounded " alt="photo" src="../assets/images/people/50/2.jpg">
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="pull-right">
                                                            <i class="icon-tag-3"></i>
                                                        </div>
                                                         <h4>Adrian Demian</h4>
                                                        <div>
                                                           <a href="#">View</a>
                                                        </div>
                                                        <div class="text-muted-dark small">Yesterday <i class="fa fa-fw fa-clock-o"></i> 10:23 AM</div>
                                                    </div>
                                                </div>
                                            </li>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                          <h4>Outbox</h4>
                          <div class="innerT">
                              <div class="widget widget-none bg-white ">
                                  <div class="widget-body padding-none">
                                      <div class=" media innerAll overflow-visible margin-none">
                                           <div class="media-body">
                                              <li>
                                               @foreach ($messages as $message)
                                                  <div class="media">
                                                      <div class="pull-left">
                                                          <img width="35" class="media-object img-rounded " alt="photo" src="{{ asset($user->avatar->url('thumb')) }}">
                                                      </div>
                                                      <div class="media-body">
                                                          <div class="pull-right">
                                                              <i class="icon-tag-3"></i>
                                                          </div>
                                                           <h4>{{{ $user->receiver_mobile }}}</h4>

                                                          <div>
                                                             <a href="#">{{{ $messages->body }}}</a>
                                                          </div>

                                                          <div class="text-muted-dark small"><i class="fa fa-fw fa-clock-o"></i>{{{ $messages->created_at }}}</div>
                                                      </div>
                                                  </div>
                                                  @endforeach
                                              </li>
                                           </div>
                                       </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                 </div>

             </div>
       </div>
     </div>
</div>
@stop


