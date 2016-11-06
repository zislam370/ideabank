<table class="table table-bordered">
    <tbody>
    <tr>
        <td></td>
        <td colspan="3">@lang('account/form.Cumulative') </td>
        <td>@lang('account/form.To_be_Completed')</td>
        <td>@lang('account/form.Completed')</td>
        <td>@lang('account/form.Not_Completed')</td>
        <td>@lang('account/form.To_be_Started')</td>
        <td>@lang('account/form.Started')</td>
        <td>@lang('account/form.Not_Started')</td>
    </tr>
    <tr>
        <td></td>
        <td>@lang('account/form.Application')</td>
        <td>@lang('account/form.Running')</td>
        <td>@lang('account/form.Completed')</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @foreach($capdev_div_idea_stat as $capdev_div_idea)
    <tr>
        <td>
            <a href="javascript:;" onclick="filter_capdev_stat_by_area({{$capdev_div_idea->id}});return false;">
                {{$capdev_div_idea->name}}
            </a>
        </td>
        <td bgcolor="#f08080">{{$capdev_div_idea->application?$capdev_div_idea->application:0}}</td>
        <td bgcolor="#90ee90">{{$capdev_div_idea->running?$capdev_div_idea->running:0}}</td>
        <td bgcolor="#3fb618">{{$capdev_div_idea->completed?$capdev_div_idea->completed:0}}</td>
        <td bgcolor="#90ee90">{{$capdev_div_idea->will_complete?$capdev_div_idea->will_complete:0}}</td>
        <td bgcolor="#3fb618">{{$capdev_div_idea->done?$capdev_div_idea->done:0}}</td>
        <td bgcolor="#CC0000">{{$capdev_div_idea->not_completed?$capdev_div_idea->not_completed:0}}</td>
        <td bgcolor="#90ee90">{{$capdev_div_idea->will_start?$capdev_div_idea->will_start:0}}</td>
        <td bgcolor="#3fb618">{{$capdev_div_idea->started?$capdev_div_idea->started:0}}</td>
        <td bgcolor="#CC0000">{{$capdev_div_idea->not_started?$capdev_div_idea->not_started:0}}</td>
    </tr>
    @endforeach

    </tbody>
</table>







