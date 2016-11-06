<form autocomplete="off" method="post" action="{{ route('form_richtexts',$form_richtext->activity_id) }}"
      class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    {{ Form::hidden( 'idea_id', Input::old('idea_id',$activity->idea_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'step_id', Input::old('step_id',$activity->idea_step_id), array('class'=>'form-control')) }}
    {{ Form::hidden( 'activity_id', Input::old('activity_id',$activity->id), array('class'=>'form-control')) }}

    <div class="form-group">
        {{ Form::textarea('body', Input::old('body', $form_richtext->body), array('class'=>'ckeditor form-control', 'placeholder'=>Lang::get('form/title.Content'))) }}
    </div>

    <div class="separator"></div>

    <!-- Form actions -->
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
    </div>
</form>
<script>
    $(document).ready(function(){
        $( '.ckeditor' ).ckeditor();
        auto_init_components();
    });
</script>
