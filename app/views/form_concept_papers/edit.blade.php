@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('form_concept_papers/title.edit') ::
@parent
@stop


{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form_concept_papers/title.edit')
    <div class="pull-right">
        <a href="{{ route('show/idea_step_activity',$activity->id) }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back to activity</a>
    </div>
</h1>
@stop


{{-- Page content --}}
@section('content')

<form autocomplete="off" method="post" class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Widget -->
    <div class="widget">

        <!-- Widget heading -->
        <div class="widget-head">
            <h4 class="heading">@lang('form_concept_papers/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">

            {{ Form::hidden( 'idea_id', Input::old('idea_id',$form_concept_paper->idea_id), array('class'=>'form-control')) }}
            {{ Form::hidden( 'step_id', Input::old('step_id',$form_concept_paper->step_id), array('class'=>'form-control')) }}
            {{ Form::hidden( 'activity_id', Input::old('activity_id',$form_concept_paper->activity_id), array('class'=>'form-control')) }}


        <div class="form-group">
            {{ Form::label('concept', 'Concept:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('concept', Input::old('concept',$form_concept_paper->concept), array('class'=>'wysihtml5 form-control', 'placeholder'=>'Concept')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('background', 'Background:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('background', Input::old('background',$form_concept_paper->background), array('class'=>'wysihtml5 form-control', 'placeholder'=>'Background')) }}
            </div>
        </div>

            <div class="form-group">
                {{ Form::label('background', 'Features:', array('class'=>'col-md-2 control-label')) }}

                <div class="col-sm-10">

                    <table id="features" class="col-sm-10">
                        <?php $i = 0;?>
                        @foreach ($form_concept_paper->features as $feature)
                        <tr>
                            <td>
                                <input type="text" value="{{{$feature->feature}}}" name="features[{{{$i}}}]" class="form-control">
                                <a class="btn btn-link" onclick="remove_feature_row(this);" href="javascript:;">remove</a>
                            </td>
                        </tr>
                        <?php $i++;?>
                        @endforeach
                    </table>
                    <div class="col-sm-12"><a class="btn btn-link" onclick="add_feature_row();" href="javascript:;">add</a></div>
                </div>
            </div>

            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('form_concept_papers') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>
        </div>
    </div>
</form>
@stop

{{-- script --}}
@section('body_bottom')

<script>
    function add_feature_row(){
        var cnt = $("#features").find("tr").length;
        var $cln = $("#features").find("tr:first");
        var $new = $cln.clone();
        var $new_input = $new.find("input");
        $new_input.attr("name","features["+cnt+"]");
        $new_input.val("");
        $("#features").append($new);
    }
    function remove_feature_row(t){
        var cnt = $("#features").find("tr").length;
        if(cnt>1){
            var $tr = $(t).closest('tr');
            $tr.remove();
        }
    }
</script>
@stop
