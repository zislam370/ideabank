@if($form_data)
<table class="table table-bordered table-white">
	<tbody>
		<tr>
			<td class="col-sm-2"><b>@lang('form/title.concept')</b></td><td>{{ $form_data->concept }}</td>
        </tr>
        <tr>
            <td><b>@lang('form/title.background')</b></td><td>{{ $form_data->background }}</td>
		</tr>
	</tbody>
</table>
<h5>@lang('form/title.Features')</h5>
<table id="features" class="table table-white">
    <?php $i = 0;?>
    @foreach ($form_data->items as $feature)
    <tr>
        <td class="col-sm-1">{{$i+1}}</td>
        <td>
            {{{$feature->feature}}}
        </td>
    </tr>
    <?php $i++;?>
    @endforeach
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