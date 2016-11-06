<form autocomplete="off" method="post" action="{{ route('form_payment_disbursments',$form_payment_disbursment->activity_id) }}"
      class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    {{ Form::hidden( 'idea_id', Input::old('idea_id',$form_payment_disbursment->idea_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'step_id', Input::old('step_id',$form_payment_disbursment->step_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'activity_id', Input::old('step_id',$form_payment_disbursment->activity_id), array('class'=>'form-control')) }}

    <table id="tbl-payment_disbursment" class="table table-bordered table-white">
        <tbody>
        <?php $i = 0;?>
        @foreach ($form_payment_disbursment->items as $item)
        <tr id="{{$i}}">
            <td class="col-sm-1">
                <a class="btn btn-danger" href="javascript:;" onclick="remove_payment_disbursment_row(this)">-</a>
            </td>
            <td>
                <table  class="table table-bordered table-condensed">
                    <tr>
                        <td>@lang('form/title.Installment')</td>
                        <td>
                            {{ Form::selectRange('item['.$i.'][installment]', 1, 20, 1, ['class'=>'installment form-control'] ) }}
                        </td>
                    </tr><tr>
                        <td>{{Lang::get('form/title.Disburse_date')}}</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][disburse_date]" placeholder="{{Lang::get('form/title.Disburse_date')}}"  value="{{{$item->disburse_date}}}" class="disburse_date inputmask-date-3 datepicker1 form-control">
                        </td>
                    </tr><tr>
                        <td>@lang('form/title.amount')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][amount]" placeholder="{{Lang::get('form/title.amount')}}"  value="{{{$item->amount}}}" class="amount inputmask-decimal form-control">
                        </td>
                    </tr><tr>
                        <td>@lang('form/title.comment')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][comment]" placeholder="{{Lang::get('form/title.comment')}}" value="{{{$item->comment}}}" class="comment form-control">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php $i++ ?>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-info" href="javascript:;" onclick="add_payment_disbursment_row()">+</a>

    <div class="separator"></div>

    <!-- Form actions -->
    <div class="form-actions pull-right">
        <!--<button name="is_draft" value="0" type="submit" class="btn btn-success">@lang('button.publish')</button>-->
        <button name="is_draft" value="1" type="submit" class="btn btn-primary">@lang('button.publish')</button>
    </div>
    <div class="separator"></div>
</form>

<script>
    function add_payment_disbursment_row(){
        var $cln = $("#tbl-payment_disbursment > tbody > tr:last");

        var cnt = $cln.attr("id");
        cnt = parseInt(cnt)+1;

        var $new = $cln.clone();
        $new.attr("id",cnt);

        var $new_input = $new.find("select.installment");
        $new_input.attr("name","item["+cnt+"][installment]");

        $new_input = $new.find("a.btn");
        $new_input.show();

        $new_input = $new.find("input.disburse_date");
        $new_input.attr("name","item["+cnt+"][disburse_date]");
        $new_input.val("");

        $new_input = $new.find("input.amount");
        $new_input.attr("name","item["+cnt+"][amount]");
        $new_input.val("");

        $new_input = $new.find("input.comment");
        $new_input.attr("name","item["+cnt+"][comment]");
        $new_input.val("");

        $("#tbl-payment_disbursment").append($new);

        auto_init_components();
    }
    function remove_payment_disbursment_row(t){
        var cnt = $("#tbl-payment_disbursment > tbody > tr").length;
        if(cnt>1){
            var $tr = $(t).closest('tr');
            $tr.remove();
        }
        $('#tbl-payment_disbursment tr:first-child a.btn-danger').hide();
    }
    $(document).ready(function(){
        auto_init_components();
        $('#tbl-payment_disbursment tr:first-child a.btn-danger').hide();
    });
</script>
