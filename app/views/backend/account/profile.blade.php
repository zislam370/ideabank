@extends('backend/layouts/account')

{{-- Page title --}}
@section('title')
@lang('account/title.editprofilesubtitle') ::
@parent
@stop

{{-- Account page content --}}
@section('account-content')

<div class="widget widget-tabs-content widget-tabs-responsive widget-none">
                <!-- Tabs Heading -->
        <div class="widget-head bg-background text-center">
            <ul>

                <li class="active">
                    <a class="glyphicons lock" href="javascript:;">
                        <i></i>@lang('form/title.Profile')
                    </a>
                </li>
                <li>
                <a  class="glyphicons lightbulb" href="{{ route('account/ideas',$user->id) }}">

                        <i></i>{{Lang::get('form/title.idea')}}
                    </a>
                </li>
                <li>
                    <a class="glyphicons envelope" href="{{ route('account/messages',$user->id) }}">
                       <i></i>{{Lang::get('form/title.Messages')}}
                    </a>
                </li>
                {{--<li>
                    <a class="glyphicons share_alt" href="user/history.html">
                        <i></i>History Log
                    </a>
                </li>--}}
            </ul>
        </div>
        <!-- // Tabs Heading END -->

       <div class="widget-body">

           <div class="row innerAll inner-2x">
               <a class="btn btn-success pull-right" href="{{ URL::route('editprofile',$user->id) }}">@lang('button.edit')</a>
               <div class="col-sm-12">

                   <div class="table-responsive">
                       <table class="table table-condensed table-responsive table-user-information">
                           <tbody>
                               <tr>
                                   <td>
                                       <strong>
                                           <span class="glyphicon glyphicon-asterisk"></span>
                                           @lang('form/title.name')
                                       </strong>
                                   </td>
                                   <td class="text-primary">
                                       {{{ $user->first_name }}}
                                   </td>
                               </tr>
                               <tr>
                                   <td>
                                       <strong>
                                           <span class="glyphicon glyphicon-envelope"></span>
                                           @lang('form/title.email')
                                       </strong>
                                   </td>
                                   <td class="text-primary">
                                       {{{ $user->email}}}
                                   </td>
                               </tr>
                               <tr>
                                   <td>
                                       <strong>
                                           <span class="glyphicon glyphicon-home"></span>
                                           @lang('form/title.Address')
                                       </strong>
                                   </td>
                                   <td class="text-primary">
                                       {{{ $user->address }}}
                                   </td>
                               </tr>
                               @if ($user->area_id)
                               <tr>
                                   <td>
                                       <strong>
                                           <span class="glyphicon glyphicon-home"></span>
                                           @lang('form/title.area')
                                       </strong>
                                   </td>
                                   <td class="text-primary">
                                       {{{ $user->area->name }}}
                                   </td>
                               </tr>
                               @endif
                               @if ($user->office_id)
                               <tr>
                                   <td>
                                       <strong>
                                           <span class="glyphicon glyphicon-home"></span>
                                           @lang('form/title.office')
                                       </strong>
                                   </td>
                                   <td class="text-primary">
                                       {{{ $user->office->name }}}
                                   </td>
                               </tr>
                               @endif
                               @if ($user->user_type=="Organization")
                               <tr>
                                   <td>
                                       <strong>
                                           <span class="glyphicon glyphicon-briefcase"></span>
                                           @lang('account/form.office_name')
                                       </strong>
                                   </td>
                                   <td class="text-primary">
                                       {{{ $user->office_name }}}
                                   </td>
                               </tr>
                               <tr>
                                   <td>
                                       <strong>
                                           <span class="glyphicon glyphicon-user"></span>
                                           @lang('account/form.representative_name')
                                       </strong>
                                   </td>
                                   <td class="text-primary">
                                       {{{ $user->representative_name }}}
                                   </td>
                               </tr>
                               <tr>
                                   <td>
                                       <strong>
                                           <span class="glyphicon glyphicon-phone"></span>
                                           @lang('account/form.contact_number')
                                       </strong>
                                   </td>
                                   <td class="text-primary">
                                       {{{ $user->contact_number }}}
                                   </td>
                               </tr>
                              <tr>
                                   <td>
                                       <strong>
                                           <span class="glyphicon glyphicon-calendar"></span>
                                           @lang('account/form.office_web_url')
                                       </strong>
                                   </td>
                                   <td class="text-primary">
                                       {{{ $user->office_web_url }}}
                                   </td>
                               </tr>
                               @endif
                           </tbody>

                       </table>
                   </div>
                </div>
            </div>
        </div>
</div>
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

@stop

