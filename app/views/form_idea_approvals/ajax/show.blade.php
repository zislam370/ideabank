@if($form_data)
<table>
    <tbody>
    <tr>
        <td>
            @if($form_data->approval_id==1)
                Approved
            @elseif($form_data->approval_id==2)
                Rejected
            @elseif($form_data->approval_id==3)
                Future Consideration
            @endif

        </td>
    </tr>
    <tr>
        <td>
            {{$form_data->comment}}
        </td>
    </tr>
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