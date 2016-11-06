@extends('frontend/layouts/account')
{{-- Page title --}}
@section('title')
@lang('ideas/title.myideas') ::
@parent
@stop


{{-- Account page content --}}
@section('account-content')
<h3>
    @lang('account/title.myideas')
</h3>
<div class="well">
    <a href="{{ route('submit/idea','general') }}" class="btn btn-warning">@lang('button.submitidea')</a>
    @foreach ($adverts as $advert)
    <a href="{{ route('submit/idea',$advert->id) }}" class="btn btn-success">{{{$advert->link_title}}}</a>
    @endforeach
</div>
<div class="panel-body">

    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>@lang('form/title.Idea_Title')</th>
            <th>@lang('form/title.Submission_Date')</th>
            <th>@lang('form/title.Status')</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($ideas as $idea)
            <tr>
                <td>
                    @if ($idea->is_draft > 0)
                    <a href="{{route('update/idea',$idea->id)}}">{{{$idea->name}}}</a>
                    @elseif ($idea->is_sorted && $idea->is_opened)
                    <a href="{{route('view/idea',$idea->id)}}">{{{$idea->name}}}</a>
                    @else
                    <a href="{{route('view/idea',$idea->id)}}">{{{$idea->name}}}</a>
                    @endif
                </td>
                <td>{{{date( 'd-m-Y', strtotime( $idea->created_at ))}}}</td>
                <td>
                    @if ($idea->is_draft>0)
                    <span class="badge alert-primary">@lang('form/title.draft')</span>
                    @elseif ($idea->is_opened==null)
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
@stop
