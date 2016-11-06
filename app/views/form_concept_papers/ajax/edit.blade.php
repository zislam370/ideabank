
<form autocomplete="off" method="post" action="{{ route('form_concept_papers',$form_concept_paper->activity_id) }}"
      class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    {{ Form::hidden( 'idea_id', Input::old('idea_id',$form_concept_paper->idea_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'step_id', Input::old('step_id',$form_concept_paper->step_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'activity_id', Input::old('activity_id',$form_concept_paper->activity_id), array('class'=>'form-control')) }}


    <div class="form-group">
        {{ Form::label('concept', Lang::get('form/title.concept'), array('class'=>'control-label')) }}
        {{ Form::textarea('concept', Input::old('concept',$form_concept_paper->concept), array('class'=>'ckeditor form-control', 'placeholder'=>Lang::get('form/title.concept'))) }}
    </div>

    <div class="form-group">
        {{ Form::label('background', Lang::get('form/title.background'), array('class'=>'control-label')) }}
        {{ Form::textarea('background', Input::old('background',$form_concept_paper->background), array('class'=>'ckeditor form-control', 'placeholder'=>Lang::get('form/title.background'))) }}
    </div>

    <div class="form-group">
        {{ Form::label('background', Lang::get('form/title.Features'), array('class'=>'col-md-2 control-label')) }}
        <div class="col-sm-10">
            <table id="items" class="table col-sm-12">
                <?php $i = 0;?>
                @foreach ($form_concept_paper->items as $feature)
                <tr>
                    <td>
                        <div class="input-group">
                        <input type="text" value="{{{$feature->feature}}}" name="items[{{{$i}}}]" class="form-control">
                            <div class="input-group-btn">
                                <a style="float: left" onclick="remove_feature_row(this)" href="javascript:;" class="btn btn-danger">-</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php $i++;?>
                @endforeach
            </table>
            <div class="col-sm-12">
                <a onclick="add_feature_row(this)" href="javascript:;" class="btn btn-success">+</a>
            </div>
        </div>

        <div class="separator"></div>

        <!-- Form actions -->
        <div class="form-actions  pull-right">
            <!--        <button name="is_draft" value="0" type="submit" class="btn btn-success">@lang('button.publish')</button>-->
            <button name="is_draft" value="1" type="submit" class="btn btn-primary">@lang('button.publish')</button>
        </div>
</form>

<script>
    function add_feature_row(){
        var cnt = $("#items").find("tr").length;
        var $cln = $("#items").find("tr:first");
        var $new = $cln.clone();
        var $new_input = $new.find("input");
        $new_input.attr("name","items["+cnt+"]");
        $new_input.val("");
        $new_input = $new.find("a.btn");
        $new_input.show();

        $("#items").append($new);
        auto_init_components();

    }
    function remove_feature_row(t){
        var cnt = $("#items").find("tr").length;
        if(cnt>1){
            var $tr = $(t).closest('tr');
            $tr.remove();
            $('#items tr:first-child a.btn-danger').hide();
        }
    }

    $(document).ready(function(){
        $( '.ckeditor' ).ckeditor();
        auto_init_components();
        $('#items tr:first-child a.btn-danger').hide();
    });
</script>