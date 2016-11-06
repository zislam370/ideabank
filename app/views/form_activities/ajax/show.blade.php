
@if($form_data)
<table class="table table-bordered table-white">
    <thead>
        <tr>
            <th>@lang('form/title.head')</th>
            <th>@lang('form/title.start_date')</th>
            <th>@lang('form/title.end_date')</th>
            <th>@lang('form/title.responsible_person')</th>
            <th>@lang('form/title.target_date')</th>
            <th>@lang('form/title.achieved_date')</th>
            <th>@lang('form/title.target')</th>
            <th>@lang('form/title.achieved')</th>
            <th>@lang('form/title.comment')</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;?>
        @foreach ($form_data->items as $item)
        <tr>
            <td>
                {{{$item->head}}}
            </td>
            <td>
                {{{$item->plan_start}}}
            </td>
            <td>
                {{{$item->plan_end}}}
            </td>
            <td>
                {{{$item->responsible_person}}}
            </td>
            <td>
                {{{$item->target_date}}}
            </td>
            <td>
                {{{$item->achieved_date}}}
            </td>
            <td>
                {{{$item->target}}}
            </td>
            <td>
                {{{$item->achieved}}}
            </td>
            <td>
                {{{$item->comments}}}
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