@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')


<section class="panel">

    <div class="panel-body">
        <ul class="nav nav-pills" >
            <li{{ Request::is('account/myideas') ? ' class="active"' : '' }}><a href="{{ URL::route('myideas') }}">@lang('form/title.My_Ideas')</a></li>
            <li{{ Request::is('account/profile') ? ' class="active"' : '' }}><a href="{{ URL::route('profile') }}">@lang('form/title.Profile')</a></li>
            <li{{ Request::is('account/mymessages') ? ' class="active"' : '' }}><a href="{{ URL::route('mymessages') }}">@lang('form/title.mymessages')</a></li>
            <li{{ Request::is('account/change-password') ? ' class="active"' : '' }}><a href="{{ URL::route('change-password') }}">@lang('form/title.Change_Password')</a></li>
            <li{{ Request::is('account/change-mobile') ? ' class="active"' : '' }}><a href="{{ URL::route('change-mobile') }}">@lang('form/title.Change_Mobile_Number')</a></li>
        </ul>
    </div>

</section>

@include('frontend/notifications')

@yield('account-content')

@stop
