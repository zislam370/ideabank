@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
@lang('account/title.editprofilesubtitle') ::
@parent
@stop

{{-- Account page content --}}
@section('account-content')
<section class="well panel panel-default">
    <div class="row">
        <div class="col-lg-2 text-center">
            <img src="{{ asset($user->avatar->url('medium')) }}" alt="" class="center-block img-circle img-thumbnail img-responsive">
        </div>
        <div class="col-lg-10">
            <h3>
                {{{ $user->first_name }}}
                <a class="btn btn-sm btn-success pull-right" href="{{ URL::route('editprofile',$user->id) }}"><span class="fa fa-edit"></span> @lang('button.edit')</a>
            </h3>
            <div class="col-md-10">
                <h4><span class="fa fa-list-alt"></span> @lang('account/form.profile_info')</h4>
                <table class="table table-striped table-hover ">
                    <tbody>
                       <tr>
                            <td class="col-md-4"><span class="glyphicon glyphicon-asterisk"></span> @lang('account/form.type')</td>
                            <td class="col-md-8 text-primary"> {{{$user->user_type}}}</td>
                        </tr>
                        <tr>
                            <td><span class="fa fa-tablet"></span> @lang('account/form.mobile')</td>
                            <td class="text-primary"> {{{ $user->mobile }}}</td>
                        </tr>
                        <tr>
                            <td><span class="fa fa-envelope"></span> @lang('account/form.email')</td>
                            <td class="text-primary"> {{{ $user->email }}}</td>
                        </tr>
                        <tr>
                            <td><span class="fa fa-anchor"></span> @lang('account/form.address')</td>
                            <td class="text-primary"> {{{ $user->address }}}</td>
                        </tr>
                        @if ($user->user_type == "Organization" )
                        <tr>
                            <td><span class="fa fa-briefcase"></span> @lang('account/form.organization_type')</td>
                            <td class="text-primary"> {{{$user->organization_type}}}</td>
                        </tr>
                        <tr>
                            <td><span class="fa fa-building-o"></span> @lang('account/form.office_name')</td>
                            <td class="text-primary"> {{{$user->office_name}}}</td>
                        </tr>

                        <tr>
                            <td><span class="fa fa-user"></span> @lang('account/form.representative_name')</td>
                            <td class="text-primary"> {{{$user->representative_name}}}</td>
                        </tr>
                        <tr>
                           <td><span class="fa fa-phone"></span> @lang('account/form.contact_number')</td>
                            <td class="text-primary"> {{{$user->contact_number}}}</td>
                        </tr>
                        <tr>
                            <td><span class="fa fa-link"></span> @lang('account/form.office_web_url')</td>
                            <td class="text-primary"> {{{$user->office_web_url}}}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>
@stop
@section('body_bottom')


@stop