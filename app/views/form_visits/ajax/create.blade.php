<form autocomplete="off" method="post" action="{{ route('form_visits',$activity->id) }}"
      class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    {{ Form::hidden( 'idea_id', Input::old('idea_id',$activity->idea_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'step_id', Input::old('step_id',$activity->idea_step_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'activity_id', Input::old('activity_id',$activity->id), array('class'=>'form-control')) }}

    <table id="tbl-visit" class="table table-bordered table-striped table-white">
        <tbody>
        <tr id="0">
            <td class="col-sm-1">
                <a class="btn btn-danger" href="javascript:;" onclick="remove_visit_row(this)">-</a>
            </td>
            <td>
                <table  class="table table-bordered table-condensed">
                    <tr>
                        <td>@lang('form/title.Location')</td>
                        <td>
                            <input type="text" name="item[0][location]"   placeholder="{{Lang::get('form/title.Location')}}" class="location form-control"/>
                        </td>
                    </tr><tr>
                        <td>@lang('form/title.Purpose')</td>
                        <td>
                            <input type="text" name="item[0][purpose]" placeholder="{{Lang::get('form/title.Purpose')}}"   class="purpose form-control">
                        </td>
                    </tr><tr>
                        <td>@lang('form/title.Start')</td>
                        <td>
                            <input type="text" name="item[0][start]" placeholder="{{Lang::get('form/title.Start')}}"   class="start inputmask-date-3 datepicker1 form-control">
                        </td>
                    </tr><tr>
                        <td>@lang('form/title.End')</td>
                        <td>
                            <input type="text" name="item[0][end]" placeholder="{{Lang::get('form/title.End')}}"   class="end inputmask-date-3 datepicker1 form-control">
                        </td>
                    </tr><tr>
                        <td>@lang('form/title.Outcome')</td>
                        <td>
                            <input type="text" name="item[0][outcome]" placeholder="{{Lang::get('form/title.Outcome')}}"   class="outcome form-control">
                        </td>
                    </tr><tr>
                        <td>@lang('form/title.comment')</td>
                        <td>
                            <input type="text" name="item[0][comment]" placeholder="{{Lang::get('form/title.comment')}}"  class="comment form-control">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <a class="btn btn-info" href="javascript:;" onclick="add_visit_row()">Add</a>
    <div class="separator"></div>

    <!-- Form actions -->
    <div class="form-actions pull-right">
        <!--<button name="is_draft" value="0" type="submit" class="btn btn-success">@lang('button.publish')</button>-->
        <button name="is_draft" value="1" type="submit" class="btn btn-primary">@lang('button.publish')</button>
    </div>
    <div class="separator"></div>

</form>

<script>
    function add_visit_row(){
        var $cln = $("#tbl-visit > tbody > tr:last");

        var cnt = $cln.attr("id");
        cnt = parseInt(cnt)+1;

        var $new = $cln.clone();
        $new.attr("id",cnt);

        var $new_input = $new.find("input.location");
        $new_input.attr("name","item["+cnt+"][location]");

        $new_input = $new.find("a.btn");
        $new_input.show();

        $new_input = $new.find("input.purpose");
        $new_input.attr("name","item["+cnt+"][purpose]");
        $new_input.val("");

        $new_input = $new.find("input.start");
        $new_input.attr("name","item["+cnt+"][start]");
        $new_input.val("");

        $new_input = $new.find("input.end");
        $new_input.attr("name","item["+cnt+"][end]");
        $new_input.val("");

        $new_input = $new.find("input.outcome");
        $new_input.attr("name","item["+cnt+"][outcome]");
        $new_input.val("");

        $new_input = $new.find("input.comment");
        $new_input.attr("name","item["+cnt+"][comment]");
        $new_input.val("");

        $("#tbl-visit").append($new);
        auto_init_components();
    }
    function remove_visit_row(t){
        var cnt = $("#tbl-visit > tbody > tr").length;
        if(cnt>1){
            var $tr = $(t).closest('tr');
            $tr.remove();
        }
        $('#tbl-visit tr:first-child a.btn-danger').hide();
    }
    $(document).ready(function(){
        auto_init_components();
        $('#tbl-visit tr:first-child a.btn-danger').hide();
    });
</script>

