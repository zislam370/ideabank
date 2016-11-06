@if($form_data)
<table class="table table-bordered table-white">
    <thead>
        <tr>
            <th colspan="3">@lang('form/title.time')</th>
            <th colspan="3">@lang('form/title.visit')</th>
            <th colspan="3">@lang('form/title.cost')</th>
        </tr>
        <tr>
            <th>@lang('form/title.timeafter')</th>
            <th>@lang('form/title.timebefore')</th>
            <th>@lang('form/title.timebenefit')</th>
            <th>@lang('form/title.visitafter')</th>
            <th>@lang('form/title.visitbefore')</th>
            <th>@lang('form/title.visitbenefit')</th>
            <th>@lang('form/title.costafter')</th>
            <th>@lang('form/title.costbefore')</th>
            <th>@lang('form/title.costbenefit')</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;?>
        @foreach ($form_data->items as $item)
        <tr>
            <td>
                {{{$item->timeafter}}}
            </td>
            <td>
                {{{$item->timebefore}}}
            </td>
            <td>
                {{{$item->timebenefit}}}
            </td>
            <td>
                {{{$item->visitafter}}}
            </td>
            <td>
                {{{$item->visitbefore}}}
            </td>
            <td>
                {{{$item->visitbenefit}}}
            </td>
            <td>
                {{{$item->costafter}}}
            </td>
            <td>
                {{{$item->costbefore}}}
            </td>
            <td>
                {{{$item->costbenefit}}}
            </td>
        </tr>
        <?php $i++ ?>
        @endforeach
    </tbody>
</table>
@else
<table>
    <tbody>
    <tr>
        <td>
            No Data Found
        </td>
    </tr>
    </tbody>
</table>

@endif