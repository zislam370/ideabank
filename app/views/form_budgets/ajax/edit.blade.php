<form autocomplete="off" method="post" action="{{ route('form_budgets',$form_budget->activity_id) }}"
      class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    {{ Form::hidden( 'idea_id', Input::old('idea_id',$form_budget->idea_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'step_id', Input::old('step_id',$form_budget->step_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'activity_id', Input::old('step_id',$form_budget->activity_id), array('class'=>'form-control')) }}

    <table id="tbl-budget" class="table table-bordered table-white">
        <tbody>
        <?php $i = 0;?>
        @foreach ($form_budget->items as $item)
        <tr id="{{$i}}">
            <td class="col-sm-1">
                <a class="btn btn-danger" href="javascript:;" onclick="remove_row(this)">-</a>
            </td>
            <td>
                <table  class="table table-bordered table-condensed">
                    <tr>
                        <td>@lang('form/title.head')</td>
                        <td>
                            <div class="select-editable">
                                {{ Form::select('item['.$i.'][head_id]', array(''=>'')+$heads, null, array('class'=>'head form-control','onchange'=>"this.nextElementSibling.value=this.value") ) }}
                                <input type="text" name="item[{{{$i}}}][head]" value="{{{$item->head}}}" class="head form-control"/>
                            </div>
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
    <!--<a class="btn btn-info" href="javascript:;" onclick="add_budget_row()">Add</a>-->
    <a class="btn btn-info" onclick="add_budget_row()" href="javascript:;">+</a>
    <div class="separator"></div>

    <!-- Form actions -->
    <div class="form-actions  pull-right">
        <!--<button name="is_draft" value="0" type="submit" class="btn btn-success">@lang('button.publish')</button>-->
        <button name="is_draft" value="1" type="submit" class="btn btn-primary">@lang('button.publish')</button>
    </div>
    <div class="separator"></div>
</form>

<script>
    function add_budget_row(){
        var $cln = $("#tbl-budget > tbody > tr:last");

        var cnt = $cln.attr("id");
        cnt = parseInt(cnt)+1;

        var $new = $cln.clone();
        $new.attr("id",cnt);

        var $new_input = $new.find("select.head");
        $new_input.attr("name","item["+cnt+"][head_id]");

        $new_input = $new.find("a.btn");
        $new_input.show();

        $new_input = $new.find("input.head");
        $new_input.attr("name","item["+cnt+"][head]");

        $new_input = $new.find("input.amount");
        $new_input.attr("name","item["+cnt+"][amount]");
        $new_input.val("");

        $new_input = $new.find("input.comment");
        $new_input.attr("name","item["+cnt+"][comment]");
        $new_input.val("");

        $("#tbl-budget").append($new);
        auto_init_components();

    }
    function remove_row(t){
        var cnt = $("#tbl-budget > tbody > tr").length;
        if(cnt>1){
            var $tr = $(t).closest('tr');
            $tr.remove();
            $('#tbl-budget tr:first-child a.btn-danger').hide();
        }
    }
    $(document).ready(function(){
        auto_init_components();
        $('#tbl-budget tr:first-child a.btn-danger').hide();
    });
</script>
