<form autocomplete="off" method="post" action="{{ route('form_materials',$activity->id) }}"
      class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    {{ Form::hidden( 'idea_id', Input::old('idea_id',$activity->idea_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'step_id', Input::old('step_id',$activity->idea_step_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'activity_id', Input::old('activity_id',$activity->id), array('class'=>'form-control')) }}

    <table id="tbl-material" class="table table-bordered table-striped table-white">
        <tbody>
        <tr id="0">
            <td class="col-sm-1">
                <a class="btn btn-danger" href="javascript:;" onclick="remove_material_row(this)">-</a>
            </td>
            <td>
                <table  class="table table-bordered table-condensed">
                    <tr>
                        <td>@lang('form/title.description')</td>
                        <td>
                            <input type="text" name="item[0][description]" placeholder="{{Lang::get('form/title.description')}}"   class="description form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('form/title.unit')</td>
                        <td>
                            <input type="text" name="item[0][unit]" placeholder="{{Lang::get('form/title.unit')}}"  class="unit inputmask-decimal form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('form/title.price')</td>
                        <td>
                            <input type="text" name="item[0][price]" placeholder="{{Lang::get('form/title.price')}}"  class="price inputmask-decimal form-control">
                        </td>
                    </tr>
                    <tr>
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
    <a class="btn btn-info" href="javascript:;" onclick="add_material_row()">+</a>
    <div class="separator"></div>

    <!-- Form actions -->
    <div class="form-actions  pull-right">
        <!--<button name="is_draft" value="0" type="submit" class="btn btn-success">@lang('button.publish')</button>-->
        <button name="is_draft" value="1" type="submit" class="btn btn-primary">@lang('button.publish')</button>
    </div>
    <div class="separator"></div>

</form>

<script>
    function add_material_row(){
        var $cln = $("#tbl-material > tbody > tr:last");

        var cnt = $cln.attr("id");
        cnt = parseInt(cnt)+1;

        var $new = $cln.clone();
        $new.attr("id",cnt);

        var $new_input = $new.find("input.description");
        $new_input.attr("name","item["+cnt+"][description]");
        $new_input.val("");

        $new_input = $new.find("a.btn");
        $new_input.show();

        $new_input = $new.find("input.comment");
        $new_input.attr("name","item["+cnt+"][comment]");
        $new_input.val("");

        $new_input = $new.find("input.unit");
        $new_input.attr("name","item["+cnt+"][unit]");
        $new_input.val("");

        $new_input = $new.find("input.price");
        $new_input.attr("name","item["+cnt+"][price]");
        $new_input.val("");

        $("#tbl-material").append($new);
        auto_init_components();
    }
    function remove_material_row(t){
        var cnt = $("#tbl-material > tbody > tr").length;
        if(cnt>1){
            var $tr = $(t).closest('tr');
            $tr.remove();
        }
        $('#tbl-material tr:first-child a.btn-danger').hide();
    }
    $(document).ready(function(){
        auto_init_components();
        $('#tbl-material tr:first-child a.btn-danger').hide();
    });
</script>

