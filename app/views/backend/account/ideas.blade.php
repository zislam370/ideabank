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
                <li>
                @if (Sentry::check() && (Sentry::getUser()->id==$user->id))
                    <a class="glyphicons lock" href="{{ route('profile') }}">
                        <i></i>@lang('form/title.Profile')
                    </a>
                @else
                    <a class="glyphicons lock" href="{{ route('profile',$user->id) }}">
                        <i></i>@lang('form/title.Profile')
                    </a>
                @endif
                </li>
                <li  class="active">
                <a  class="glyphicons lightbulb" href="{{ route('account/ideas',$user->id) }}">

                        <i></i>{{Lang::get('form/title.idea')}}
                    </a>
                </li>
                <li>
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
                {{--<li>
                    <a class="glyphicons share_alt" href="{{ route('account/ideas',$user->id) }}">
                        <i></i>History Log
                    </a>
                </li>--}}
            </ul>
        </div>
        <!-- // Tabs Heading END -->

       <div class="widget-body">

           <div class="row innerAll inner-2x">
               <div class="col-sm-12">

                   <div class="table-responsive">

                           <table class="table table-striped table-hover ">
                               <thead>
                               <tr>
                                   <th>@lang('form/title.Categories')</th>
                                   <th>@lang('form/title.Idea_Title')</th>
                                   <th>@lang('form/title.Short_Description')</th>
                                   <th>@lang('form/title.Submission_Date')</th>
                                   <th>@lang('form/title.Status')</th>
                               </tr>
                               </thead>
                               <tbody>
                                   @foreach ($ideas as $idea)
                                   <tr>
                                       <td>
                                           @if ($idea->category)
                                           <span class="label label-warning">{{{$idea->category->name}}}</span>
                                           @else

                                           @endif
                                       </td>
                                       <td>
                                           @if ($idea->is_sorted && $idea->is_opened)
                                           <a href="{{route('show/idea',$idea->id)}}">{{{$idea->name}}}</a>
                                           @else
                                           <a href="{{route('view/idea',$idea->id)}}">{{{$idea->name}}}</a>
                                           @endif
                                       </td>
                                       <td>{{{$idea->short_desc}}}</td>
                                       <td>{{{date( 'd-m-Y', strtotime( $idea->created_at ))}}}</td>
                                       <td>
                                           @if ($idea->is_opened==null)
                                           <span class="badge alert-primary">@lang('form/title.Processing')</span>
                                           @elseif ($idea->is_accepted)
                                           <span class="badge alert-success">@lang('form/title.Accepted')</span>
                                           @elseif ($idea->rejected)
                                           <span class="badge alert-danger">@lang('form/title.Rejected')</span>
                                           @elseif ($idea->is_funded)
                                           <span class="badge alert-info">@lang('form/title.Funded')</span>
                                           @elseif ($idea->is_opened && $idea->is_closed)
                                           <span class="badge alert-success">@lang('form/title.Completed')</span>
                                           @else
                                           <span class="badge alert-warning">@lang('form/title.In_Progress')</span>
                                           @endif
                                       </td>
                                   </tr>
                                   @endforeach
                               </tbody>
                           </table>
                   </div>
                </div>
            </div>
        </div>
</div>
@stop


