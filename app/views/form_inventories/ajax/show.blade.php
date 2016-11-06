@if($form_data)
<table class="table table-bordered table-white">
    <thead>
        <tr>
            <th>@lang('form/title.name')</th>
            <th>@lang('form/title.description')</th>
            <th>@lang('form/title.quantity')</th>
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
                {{{$item->description}}}
            </td>
            <td>
                {{{$item->quantity}}}
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