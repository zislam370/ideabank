<form autocomplete="off" method="post" action="{{ route('form_manpowers',$form_manpower->activity_id) }}"
      class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    {{ Form::hidden( 'idea_id', Input::old('idea_id',$form_manpower->idea_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'step_id', Input::old('step_id',$form_manpower->step_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'activity_id', Input::old('step_id',$form_manpower->activity_id), array('class'=>'form-control')) }}

    <table id="tbl-manpower" class="table table-bordered table-white">
        <tbody>
        <?php $i = 0;?>
        @foreach ($form_manpower->items as $item)
        <tr id="{{$i}}">
            <td class="col-sm-1">
                <a class="btn btn-danger" href="javascript:;" onclick="remove_manpower_row(this)">-</a>
            </td>
            <td>
                <table  class="table table-bordered table-condensed">
                    <tr>
                        <td>@lang('form/title.name')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][name]" placeholder="{{Lang::get('form/title.name')}}"  value="{{{$item->name}}}" class="name form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('form/title.designation')</td>
                        <td>
                            <input type="text" name="item[{{{$i}}}][designation]" placeholder="{{Lang::get('form/title.designation')}}" value="{{{$item->designation}}}" class="designation form-control">
                        </td>
                    </tr>
                    <tr>
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
    <a class="btn btn-info" href="javascript:;" onclick="add_manpower_row()">+</a>

    <div class="separator"></div>

    <!-- Form actions -->
    <div class="form-actions  pull-right">
        <!--<button name="is_draft" value="0" type="submit" class="btn btn-success">@lang('button.publish')</button>-->
        <button name="is_draft" value="1" type="submit" class="btn btn-primary">@lang('button.publish')</button>
    </div>
    <div class="separator"></div>
</form>

<script>
    function add_manpower_row(){
        var $cln = $("#tbl-manpower > tbody > tr:last");

        var cnt = $cln.attr("id");
        cnt = parseInt(cnt)+1;

        var $new = $cln.clone();
        $new.attr("id",cnt);

        var $new_input = $new.find("input.name");
        $new_input.attr("name","item["+cnt+"][name]");
        $new_input.val("");

        $new_input = $new.find("a.btn");
        $new_input.show();

        $new_input = $new.find("input.comment");
        $new_input.attr("name","item["+cnt+"][comment]");
        $new_input.val("");

        $new_input = $new.find("input.designation");
        $new_input.attr("name","item["+cnt+"][designation]");
        $new_input.val("");

        $("#tbl-manpower").append($new);
        auto_init_components();
    }
    function remove_manpower_row(t){
        var cnt = $("#tbl-manpower > tbody > tr").length;
        if(cnt>1){
            var $tr = $(t).closest('tr');
            $tr.remove();
        }
        $('#tbl-manpower tr:first-child a.btn-danger').hide();
    }
    $(document).ready(function(){
        auto_init_components();
        $('#tbl-manpower tr:first-child a.btn-danger').hide();
    });
</script>
