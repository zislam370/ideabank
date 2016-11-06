<form autocomplete="off" method="post" action="{{ route('form_activities',$form_activity->activity_id) }}"
      class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    {{ Form::hidden( 'idea_id', Input::old('idea_id',$form_activity->idea_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'step_id', Input::old('step_id',$form_activity->step_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'activity_id', Input::old('step_id',$form_activity->activity_id), array('class'=>'form-control')) }}

    <table id="tbl-activity" class="table table-bordered table-white">
        <tbody>
        <?php $i = 0;?>
        @foreach ($form_activity->items as $item)
        <tr id="{{$i}}">
            <td class="col-sm-1">
                <a class="btn btn-danger" href="javascript:;" onclick="remove_activity_row(this)">-</a>
            </td>
            <td>
                <table  class="table table-bordered table-condensed">
                    <tr>
                        <td>@lang('form/title.head')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][head]" value="{{{$item->head}}}" placeholder="{{Lang::get('form/title.head')}}"   class="head form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('form/title.start_date')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][plan_start]" value="{{{$item->plan_start}}}" placeholder="{{Lang::get('form/title.start_date')}}"   class="plan_start inputmask-date-3 datepicker1 form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('form/title.end_date')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][plan_end]" value="{{{$item->plan_end}}}" placeholder="{{Lang::get('form/title.end_date')}}"   class="plan_end inputmask-date-3 datepicker1 form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('form/title.responsible_person')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][responsible_person]" value="{{{$item->responsible_person}}}" placeholder="{{Lang::get('form/title.responsible_person')}}"   class="responsible_person form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('form/title.target_date')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][target_date]" value="{{{$item->target_date}}}" placeholder="{{Lang::get('form/title.target_date')}}"   class="target_date inputmask-date-3 datepicker1 form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('form/title.achieved_date')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][achieved_date]" value="{{{$item->achieved_date}}}" placeholder="{{Lang::get('form/title.achieved_date')}}"   class="achieved_date inputmask-date-3 datepicker1 form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('form/title.target')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][target]" value="{{{$item->target}}}" placeholder="{{Lang::get('form/title.target')}}"   class="target form-control">
                        </td>
                    </tr><tr>
                        <td>@lang('form/title.achieved')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][achieved]" value="{{{$item->achieved}}}" placeholder="{{Lang::get('form/title.achieved')}}"   class="achieved form-control">
                        </td>
                    </tr><tr>
                        <td>@lang('form/title.comment')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][comments]" value="{{{$item->comments}}}" placeholder="{{Lang::get('form/title.comment')}}"   class="comments form-control">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php $i++ ?>
        @endforeach
        </tbody>
    </table>
    <!--<a class="btn btn-info" href="javascript:;" onclick="add_activity_row()">Add</a>-->
    <a class="btn btn-info" onclick="add_activity_row()" href="javascript:;">+</a>
    <div class="separator"></div>

    <!-- Form actions -->
    <div class="form-actions  pull-right">
        <!--<button name="is_draft" value="0" type="submit" class="btn btn-success">@lang('button.publish')</button>-->
        <button name="is_draft" value="1" type="submit" class="btn btn-primary">@lang('button.publish')</button>
    </div>
    <div class="separator"></div>
</form>

<script>
    function add_activity_row(){
        var $cln = $("#tbl-activity > tbody > tr:last");

        var cnt = $cln.attr("id");
        cnt = parseInt(cnt)+1;

        var $new = $cln.clone();
        $new.attr("id",cnt);

        $new_input = $new.find("a.btn");
        $new_input.show();

        $new_input = $new.find("input.head");
        $new_input.attr("name","item["+cnt+"][head]");
        $new_input.val("");

        $new_input = $new.find("input.plan_start");
        $new_input.attr("name","item["+cnt+"][plan_start]");
        $new_input.val("");

        $new_input = $new.find("input.plan_end");
        $new_input.attr("name","item["+cnt+"][plan_end]");
        $new_input.val("");

        $new_input = $new.find("input.responsible_person");
        $new_input.attr("name","item["+cnt+"][responsible_person]");
        $new_input.val("");

        $new_input = $new.find("input.target_date");
        $new_input.attr("name","item["+cnt+"][target_date]");
        $new_input.val("");

        $new_input = $new.find("input.achieved_date");
        $new_input.attr("name","item["+cnt+"][achieved_date]");
        $new_input.val("");

        $new_input = $new.find("input.target");
        $new_input.attr("name","item["+cnt+"][target]");
        $new_input.val("");

        $new_input = $new.find("input.achieved");
        $new_input.attr("name","item["+cnt+"][achieved]");
        $new_input.val("");

        $new_input = $new.find("input.comments");
        $new_input.attr("name","item["+cnt+"][comments]");
        $new_input.val("");

        $("#tbl-activity").append($new);
        auto_init_components();
    }
    function remove_activity_row(t){
        var cnt = $("#tbl-activity > tbody > tr").length;
        if(cnt>1){
            var $tr = $(t).closest('tr');
            $tr.remove();
            $('#tbl-activity tr:first-child a.btn-danger').hide();
        }
    }
    $(document).ready(function(){
        auto_init_components();
        $('#tbl-activity tr:first-child a.btn-danger').hide();
    });
</script>
