@if($form_data)
<table class="table table-bordered table-white">
    <thead>
        <tr>
            <th>@lang('form/title.name')</th>
            <th>@lang('form/title.designation')</th>
            <th>@lang('form/title.comment')</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;?>
        @foreach ($form_data->items as $item)
        <tr>
            <td>
                {{{$item->name}}}
            </td>
            <td>
                {{{$item->designation}}}
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