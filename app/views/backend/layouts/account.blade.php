@extends('backend/layouts/default')

{{-- Page content --}}
@section('content')


    {{--<section class="panel">--}}

        {{--<div class="panel-body">--}}
            {{--<ul class="nav nav-pills" >--}}
                {{--<li{{ Request::is('account/profile') ? ' class="active"' : '' }}><a href="{{ URL::route('profile') }}">@lang('form/title.Profile')</a></li>--}}
                {{--<li{{ Request::is('account/change-password') ? ' class="active"' : '' }}><a href="{{ URL::route('change-password') }}">@lang('form/title.change_password')</a></li>--}}
{{--<!--                <li{{ Request::is('account/change-email') ? ' class="active"' : '' }}><a href="{{ URL::route('change-email') }}">Change Email</a></li>-->--}}
                {{--<li{{ Request::is('account/change-mobile') ? ' class="active"' : '' }}><a href="{{ URL::route('change-mobile') }}">@lang('form/title.change_mobile')</a></li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</section>--}}
    <div class="innerT">
        <div class="media">

            <img src="{{ asset($user->avatar->url('medium')) }}" class="pull-left thumbnail" height="150" width="150">


            <div class="media-body innerAll half">
                <h3>
                    {{{ Input::old('first_name', $user->first_name) }}} &nbsp{{{ Input::old('last_name', $user->last_name) }}}
                    <span class="lead text-muted">
                    <?php foreach($user->getGroups() as $group){ ?>
                    {{ $group->name }}
                    <?php } ?>
                    </span>
                </h3>
                @if (Sentry::check() && (Sentry::getUser()->id==$user->id))
                <a href="{{ route('logout') }}" class="btn btn-default filled text-muted-dark">@lang('button.Logout')<i class="fa fa-sign-out fa-fw"></i></a>
                <a class="btn btn-default filled text-muted-dark" href="{{ URL::route('change-password') }}"><i class="fa fa-envelope"></i> @lang('form/title.change_password')</a>
                <a class="btn btn-default filled text-muted-dark" href="{{ URL::route('change-mobile') }}"><i class="fa fa-envelope"></i> @lang('form/title.change_mobile')</a>
                @endif
            </div>
        </div>
       </div>
    <div>
    </div>
@yield('account-content')



@stop
@section('body_bottom')

<script>
    $(document).ready(function(){
        @if (Sentry::check() && (Sentry::getUser()->id==$user->id))
        @else
        $('#receiver_mobile').val('{{$user->mobile}}');
        @endif
    });
    function get_user_messages(url,mob_no){

       @if (Sentry::check() && (Sentry::getUser()->id==$user->id))
        $('#receiver_mobile').val(mob_no);
        @endif

        $.ajax({
            url: url,
            success: function(data){
                $('#user_msg').html(data);
            }
        });

    }
</script>
@yield('account-body_bottom')
@stop
