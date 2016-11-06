<form autocomplete="off" method="post" action="{{ route('form_idea_approvals',$activity->id) }}"
      class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

               <!-- // Widget heading END -->
            {{ Form::hidden( 'idea_id', Input::old('idea_id',$activity->idea_id), array('class'=>'form-control')) }}
            {{ Form::hidden( 'step_id', Input::old('step_id',$activity->idea_step_id), array('class'=>'form-control')) }}
            {{ Form::hidden( 'activity_id', Input::old('activity_id',$activity->id), array('class'=>'form-control')) }}



        <div class="form-group">
            {{ Form::label('approval_id', Lang::get('form/title.approval'), array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
                    @foreach ($heads as $head)
                    <div class="radio">
                        <label class="radio-custom">
                            <input type="radio" name="approval_id" value="{{{$head->id}}}">
                            <i class="fa fa-circle-o"></i> {{{$head->name}}}
                        </label>
                    </div>
                    @endforeach
            </div>
        </div>

<!--        <div class="form-group">-->
<!--            {{ Form::label('comment', Lang::get('form/title.comment'), array('class'=>'col-md-2 control-label')) }}-->
<!--            <div class="col-sm-10">-->
<!--              {{ Form::text('comment', Input::old('comment'), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.comment'))) }}-->
<!--            </div>-->
<!--        </div>-->


            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">@lang('button.submit')</button>
            </div>


</form>

<script>
    $(function () {
        $('.radio-custom > input[type=radio]').each(function () {
            var $this = $(this);
            if ($this.data('radio')) return;
            $this.radio($this.data());
        });
    });
</script>



