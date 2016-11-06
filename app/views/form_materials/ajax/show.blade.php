@if($form_data)
<table class="table table-bordered table-white">
    <thead>
        <tr>
            <th>@lang('form/title.description')</th>
            <th>@lang('form/title.unit')</th>
            <th>@lang('form/title.price')</th>
            <th>@lang('form/title.comment')</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;?>
        @foreach ($form_data->items as $item)
        <tr>
            <td>
                {{{$item->description}}}
            </td>
            <td>
                {{{$item->unit}}}
            </td>
            <td>
                {{{$item->price}}}
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