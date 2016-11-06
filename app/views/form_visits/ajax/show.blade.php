@if($form_data)
<table class="table table-bordered table-white">
    <thead>
        <tr>
            <th>@lang('form/title.Location')</th>
            <th>@lang('form/title.Purpose')</th>
            <th>@lang('form/title.Start')</th>
            <th>@lang('form/title.End')</th>
            <th>@lang('form/title.Outcome')</th>
            <th>@lang('form/title.comment')</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;?>
        @foreach ($form_data->items as $item)
        <tr>
            <td>
                {{{$item->location}}}
            </td>
            <td>
                {{{$item->purpose}}}
            </td>
            <td>
                {{{$item->start}}}
            </td>
            <td>
                {{{$item->end}}}
            </td>
            <td>
                {{{$item->outcome}}}
            </td>
            <td>
                {{{$item->comment}}}
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