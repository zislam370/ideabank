<form autocomplete="off" method="post" action="{{ route('form_tcvs',$activity->id) }}"
      class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    {{ Form::hidden( 'idea_id', Input::old('idea_id',$activity->idea_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'step_id', Input::old('step_id',$activity->idea_step_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'activity_id', Input::old('activity_id',$activity->id), array('class'=>'form-control')) }}

    <table id="tbl-tcv" class="table table-bordered table-striped table-white">
        <tbody>
        <tr id="0" class="form-row">
            <td class="col-sm-1">
                <a class="btn btn-danger" href="javascript:;" onclick="remove_tcv_row(this)">-</a>
            </td>
            <td>
                <table  class="table table-condensed" style="margin: 0;">
                    <tr>
                        <td>
                            <input type="text" name="item[0][head]" placeholder="{{Lang::get('form/title.head')}}"  class="head form-control"/>
                        </td>
                    </tr>
                </table>
                <table  class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>@lang('form/title.timeafter')</th>
                            <th>@lang('form/title.timebefore')</th>
                            <th>@lang('form/title.timebenefit')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <b>@lang('form/title.time')</b>
                            </td>
                            <td>
                                {{ Form::select('item[0][time_type]', array('ঘণ্টা','দিন','সপ্তাহ','মাস','বসর'), Input::old('time_type'), array('class'=>'time_type form-controls')) }}
                            </td>
                            <td>
                                <input type="text" onchange="calculate_time(this)" name="item[0][timeafter]" placeholder="{{Lang::get('form/title.timeafter')}}"  class="timeafter inputmask-decimal form-control">
                            </td>
                            <td>
                                <input type="text" onchange="calculate_time(this)" name="item[0][timebefore]" placeholder="{{Lang::get('form/title.timebefore')}}"  class="timebefore inputmask-decimal form-control">
                            </td>
                            <td>
                                <input type="text" readonly="readonly" name="item[0][timebenefit]" placeholder="{{Lang::get('form/title.timebenefit')}}"  class="timebenefit  form-control">
                            </td>
                        </tr>
                        <tr>
                            <td><b>@lang('form/title.visit')</b></td>
                            <td></td>
                            <td>
                                <input type="text" onchange="calculate_visit(this)" name="item[0][visitafter]" placeholder="{{Lang::get('form/title.visitafter')}}"  class="visitafter inputmask-decimal form-control">
                            </td>
                            <td>
                                <input type="text" onchange="calculate_visit(this)" name="item[0][visitbefore]" placeholder="{{Lang::get('form/title.visitbefore')}}"  class="visitbefore inputmask-decimal form-control">
                            </td>
                            <td>
                                <input type="text" readonly="readonly" name="item[0][visitbenefit]" placeholder="{{Lang::get('form/title.visitbenefit')}}"  class="visitbenefit  form-control">
                            </td>
                        </tr>
                        <tr>
                            <td><b>@lang('form/title.cost')</b></td>
                            <td></td>
                            <td>
                                <input type="text" onchange="calculate_cost(this)"  name="item[0][costafter]" placeholder="{{Lang::get('form/title.costafter')}}"  class="costafter inputmask-decimal form-control">
                            </td>
                            <td>
                                <input type="text" onchange="calculate_cost(this)" name="item[0][costbefore]" placeholder="{{Lang::get('form/title.costbefore')}}"  class="costbefore inputmask-decimal form-control">
                            </td>
                            <td>
                                <input type="text" readonly="readonly" name="item[0][costbenefit]" placeholder="{{Lang::get('form/title.costbenefit')}}"  class="costbenefit  form-control">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <a class="btn btn-info" href="javascript:;" onclick="add_tcv_row()">+</a>
    <div class="separator"></div>

    <!-- Form actions -->
    <div class="form-actions  pull-right">
        <!--<button name="is_draft" value="0" type="submit" class="btn btn-success">@lang('button.publish')</button>-->
        <button name="is_draft" value="1" type="submit" class="btn btn-primary">@lang('button.publish')</button>
    </div>
    <div class="separator"></div>

</form>

<script>
    function add_tcv_row(){
        var $cln = $("#tbl-tcv > tbody > tr:last");

        var cnt = $cln.attr("id");
        cnt = parseInt(cnt)+1;

        var $new = $cln.clone();
        $new.attr("id",cnt);

        var $new_input = $new.find("input.head");
        $new_input.attr("name","item["+cnt+"][head]");
        $new_input.val("");

        $new_input = $new.find("a.btn");
        $new_input.show();

        $new_input = $new.find("select.time_type");
        $new_input.attr("name","item["+cnt+"][time_type]");
        $new_input.val("0");

        $new_input = $new.find("input.timeafter");
        $new_input.attr("name","item["+cnt+"][timeafter]");
        $new_input.val("0");

        $new_input = $new.find("input.timebefore");
        $new_input.attr("name","item["+cnt+"][timebefore]");
        $new_input.val("0");

        $new_input = $new.find("input.timebenefit");
        $new_input.attr("name","item["+cnt+"][timebenefit]");
        $new_input.val("0");

        $new_input = $new.find("input.timeafter");
        $new_input.attr("name","item["+cnt+"][timeafter]");
        $new_input.val("0");

        $new_input = $new.find("input.visitafter");
        $new_input.attr("name","item["+cnt+"][visitafter]");
        $new_input.val("0");

        $new_input = $new.find("input.visitbefore");
        $new_input.attr("name","item["+cnt+"][visitbefore]");
        $new_input.val("0");

        $new_input = $new.find("input.visitbenefit");
        $new_input.attr("name","item["+cnt+"][visitbenefit]");
        $new_input.val("0");

        $new_input = $new.find("input.costafter");
        $new_input.attr("name","item["+cnt+"][costafter]");
        $new_input.val("0");

        $new_input = $new.find("input.costbefore");
        $new_input.attr("name","item["+cnt+"][costbefore]");
        $new_input.val("0");

        $new_input = $new.find("input.costbenefit");
        $new_input.attr("name","item["+cnt+"][costbenefit]");
        $new_input.val("0");


        $("#tbl-tcv").append($new);
        auto_init_components();
    }
    function calculate_time(t){
        var $t = $(t).closest('tr.form-row');
        var v1 = parseFloat($t.find('.timeafter').val());
        var v2 = parseFloat($t.find('.timebefore').val());
        var v3 = v1 - v2;
        $t.find('.timebenefit').val(isNaN(v3)?0:v3);
    }
    function calculate_visit(t){
        var $t = $(t).closest('tr.form-row');
        var v1 = parseFloat($t.find('.visitafter').val());
        var v2 = parseFloat($t.find('.visitbefore').val());
        var v3 = v1 - v2;
        $t.find('.visitbenefit').val(isNaN(v3)?0:v3);
    }
    function calculate_cost(t){
        var $t = $(t).closest('tr.form-row');
        var v1 = parseFloat($t.find('.costafter').val());
        var v2 = parseFloat($t.find('.costbefore').val());
        var v3 = v1 - v2;
        $t.find('.costbenefit').val(isNaN(v3)?0:v3);
    }
    function remove_tcv_row(t){
        var cnt = $("#tbl-tcv > tbody > tr").length;
        if(cnt>1){
            var $tr = $(t).closest('tr');
            $tr.remove();
        }
        $('#tbl-tcv tr:first-child a.btn-danger').hide();
    }
    $(document).ready(function(){
        auto_init_components();
        $('#tbl-tcv tr:first-child a.btn-danger').hide();
    });
</script>

