<form autocomplete="off" method="post" action="{{ route('form_evaluations',$form_evaluation->activity_id) }}"
      class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    {{ Form::hidden( 'idea_id', Input::old('idea_id',$form_evaluation->idea_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'step_id', Input::old('step_id',$form_evaluation->step_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'activity_id', Input::old('step_id',$form_evaluation->activity_id), array('class'=>'form-control')) }}

    <table id="tbl-evaluation" class="table table-bordered table-white">
        <tbody>
        <?php $i = 0;?>
        @foreach ($form_evaluation->items as $item)
        <tr id="{{$i}}">
            <td class="col-sm-1">
                <a class="btn btn-danger" href="javascript:;" onclick="remove_evaluation_row(this)">-</a>
            </td>
            <td>
                <table  class="table table-bordered table-condensed">
                    <tr>
                        <td>@lang('form/title.head')</td>
                        <td>
                            <div class="select-editable">
                                {{ Form::select('item['.$i.'][task_id]', array(''=>'')+$heads, null, array('class'=>'task form-control','onchange'=>"this.nextElementSibling.value=this.value") ) }}
                                <input type="text" name="item[{{{$i}}}][task]" value="{{{$item->task}}}" class="task form-control"/>
                            </div>
                        </td>
                    </tr><tr>
                        <td>@lang('form/title.Due_date')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][due_date]" placeholder="{{Lang::get('form/title.Due_date')}}"  value="{{{$item->due_date}}}" class="due_date inputmask-date-3 datepicker1 form-control">
                        </td>
                    </tr><tr>
                        <td>@lang('form/title.Target')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][target]" placeholder="{{Lang::get('form/title.Target')}}"  value="{{{$item->target}}}" class="target form-control">
                        </td>
                    </tr><tr>
                        <td>@lang('form/title.Achieved')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][achieved]" placeholder="{{Lang::get('form/title.Achieved')}}"  value="{{{$item->achieved}}}" class="achieved form-control">
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
    <a class="btn btn-info" href="javascript:;" onclick="add_evaluation_row()">+</a>

    <div class="separator"></div>

    <!-- Form actions -->
    <div class="form-actions  pull-right">
        <!--<button name="is_draft" value="0" type="submit" class="btn btn-success">@lang('button.publish')</button>-->
        <button name="is_draft" value="1" type="submit" class="btn btn-primary">@lang('button.publish')</button>
    </div>
    <div class="separator"></div>
</form>

<script>
    function add_evaluation_row(){
        var $cln = $("#tbl-evaluation > tbody > tr:last");

        var cnt = $cln.attr("id");
        cnt = parseInt(cnt)+1;

        var $new = $cln.clone();
        $new.attr("id",cnt);

        var $new_input = $new.find("select.task");
        $new_input.attr("name","item["+cnt+"][task_id]");

        $new_input = $new.find("a.btn");
        $new_input.show();

        $new_input = $new.find("input.task");
        $new_input.attr("name","item["+cnt+"][task]");

        $new_input = $new.find("input.due_date");
        $new_input.attr("name","item["+cnt+"][due_date]");
        $new_input.val("");

        $new_input = $new.find("input.target");
        $new_input.attr("name","item["+cnt+"][target]");
        $new_input.val("");

        $new_input = $new.find("input.achieved");
        $new_input.attr("name","item["+cnt+"][achieved]");
        $new_input.val("");

        $new_input = $new.find("input.comment");
        $new_input.attr("name","item["+cnt+"][comment]");
        $new_input.val("");

        $("#tbl-evaluation").append($new);
        auto_init_components();
    }
    function remove_evaluation_row(t){
        var cnt = $("#tbl-evaluation > tbody > tr").length;
        if(cnt>1){
            var $tr = $(t).closest('tr');
            $tr.remove();
            $('#tbl-evaluation tr:first-child a.btn-danger').hide();
        }
    }
    $(document).ready(function(){
        auto_init_components();
        $('#tbl-evaluation tr:first-child a.btn-danger').hide();
    });
</script>
