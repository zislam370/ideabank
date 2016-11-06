@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('form/title.Idea_step_activity') ::
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="innerT  pull-right">
    <a class="btn btn-primary" href="{{ route('show/idea',$idea_step_activity->idea->id) }}">@lang('button.back_to_project')</a>
</div>
<h3>Activity :: {{{$idea_step_activity->workflow_step_activity->name}}}</h3>
<div class="clearfix"></div>
<div class="separator"></div>

@if ($idea_step_activity->is_opened)

<div class="col-xs-12 widget widget-none">
    <div class="widget-body col-xs-12">
        <div class="col-xs-8">
<!--            <p class="lead">{{{$idea_step_activity->description}}}</p>-->
<!--            <p><label>{{Lang::get('form/title.Target')}}</label> {{{$idea_step_activity->targeted}}}</p>-->
                <label>{{Lang::get('form/title.Initiate_date')}}</label>{{{date( 'd-m-Y', strtotime( $idea_step_activity->initiate_date ))}}}
<!--                <label>{{Lang::get('form/title.Due_date')}}</label> {{{$idea_step_activity->due_date}}}-->
<!--            </p>-->
        </div>
<!--        <form method="post" action="{{ route('achieve/idea_step_activity',$idea_step_activity->id) }}">-->
<!--            <div class="col-md-12">-->
<!--                <div class="innerAll">-->
<!---->
<!--                    <p>Achieved:</p>-->
<!--                    <div class="">-->
<!--                        {{ Form::input('text', 'achived', Input::old('achived'), array('class'=>'form-control')) }}-->
<!--                    </div>-->
<!--                    <div class="separator bottom"></div>-->
<!---->
<!--                    <button class="btn btn-success" type="submit">Update</button>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </form>-->
        @if ($idea_step_activity->is_opened && !$idea_step_activity->is_closed)
        <div class="pull-right">
            <a href="#modal-close-activity" data-toggle="modal" class="btn btn-danger"> <i class="fa fa-cross"></i>  @lang('button.close')</a>
        </div>
        @endif

    </div>
</div>
@endif
<div class="row">
    @if (!$idea_step_activity->is_opened)


    <div class="col-md-9">
        <div class="widget widget-heading-simple widget-body-white">
            <div class="widget-head">
                <h4 class="heading">@lang('form/title.Initiate_Activity')</h4>
            </div>
            <div class="widget-body padding-none">
                <div class="row row-merge">
                    <form method="post" action="{{ route('open/idea_step_activity',$idea_step_activity->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="col-md-6">
                            <div class="innerAll">
                                <p>This Activity is not initiated yet. Please fill the input boxes where appropriate.
                                   Other wise leave the field empty.
                                </p>
                                <button class="btn btn-success" type="submit">@lang('form/title.Initiate')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @else

    <div class="col-md-8">

        <div class="relativeWrap">
            <div class="widget widget-tabs widget-tabs-double-2 widget-tabs-responsive">


                <!-- Tabs Heading -->
                <div class="widget-head">
                    <ul>
                        <?php $i=0;?>
                        @foreach ($activity_forms as $form)
                        @if ($i==0)
                        <li class="active">
                        @else
                        <li>
                        @endif

                            <a data-toggle="tab" href="#{{{$form->action_uri}}}" class="glyphicons list"><i></i><span>{{{$form->name}}}</span></a>
                        </li>
                        <?php $i++?>
                        @endforeach
                    </ul>
                </div>
                <!-- // Tabs Heading END -->

                <div class="widget-body">
                    <div class="tab-content">

                        <!-- Tab content -->
                        <?php $i=0;?>
                        @foreach ($activity_forms as $form)
                            @if ($i==0)
                                <div class="tab-pane active widget-body-regular" id="{{{$form->action_uri}}}"></div>
                        <script>
                            $(function() {
                                $( "#{{{$form->action_uri}}}" ).load( "{{route($form->action_uri,$idea_step_activity->id)}}" );
                            });
                        </script>
                            @else
                                <div class="tab-pane active widget-body-regular" id="{{{$form->action_uri}}}"></div>

                        <script>
                            $(function() {
                                $(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
                                    if($("#{{{$form->action_uri}}}").html()==""){
                                        $.ajax({
                                            url: "{{route($form->action_uri,$idea_step_activity->id)}}",
                                            success: function(data){
                                                $('#{{{$form->action_uri}}}').html(data);
                                            }
                                        });
                                    }
                                })
                            });
                            //                                $( "#{{{$form->action_uri}}}" ).load( "{{route($form->action_uri,$idea_step_activity->id)}}" );
                        </script>
                            @endif
                            <?php $i++?>
                        @endforeach
                        <!-- // Tab content END -->
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="col-md-4">
        <div class="widget widget-primary widget-small">
            <div class="widget-body">
                <h4 class="strong innerB half">@lang('form/title.Attachments')
                <a href="#modal-attachment" data-toggle="modal" class="btn-add-files">
                    <i class="fa fa-plus fa-fw"></i>
                </a>
                </h4>
                <ul class="list-group bg-gray margin-none">

                    @foreach ($activity_attachments as $attachment)
                    <li class="list-group-item">
                        <a class="close" href="{{ route('confirm-delete/idea_step_activity_attachment', $attachment->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-times "></i></a>
                        <label class="checkbox-custom checkbox-custom-2">
                            <?php
                            $ext = explode('.',$attachment->attachment_file_name);
                            $ext = $ext[sizeof($ext)-1];
                            ?>
                            <a class="glyphicons-filetype {{{$ext}}}"
                               href="{{ asset($attachment->attachment->url('original')) }}">
                                <i></i>
                            @if ($attachment->head)
                                {{ $attachment->head->name}}
                            @else
                                {{ $attachment->comment}}
                            @endif
                            </a>
                        </label>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>

    </div>

    @endif
</div>

<!-- CREATE TASK MODAL -->
<div class="modal fade" id="modal-close-activity">

    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">@lang('form/title.Close_Activity')</h3>
            </div>
            <!-- // Modal heading END -->

            <!-- Modal body -->
            <div class="modal-body">

                <div class="innerAll">
                    <form class="margin-none innerLR inner-2x" method="post" action="{{ route('close/idea_step_activity',$idea_step_activity->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
<!--                        <div class="form-group">-->
<!--                            <label>@lang('form/title.Achieved')</label>-->
<!--                            <input name="achived" type="text" placeholder="Achieved" class="form-control">-->
<!--                        </div>-->
                        @if (!empty($next_activities))
                        <div class="form-group">
                            <label class="control-label">@lang('form/title.Next_Activity')</label>
                            @if (array_key_exists($idea_step_activity->workflow_activity_id,$next_activities))
                            {{ Form::select('next_activity',$next_activities,null, array('class'=>'selectpicker')) }}
                            @else
                            {{ Form::select('next_activity',$next_activities,null, array('class'=>'selectpicker')) }}
                            @endif
                        </div>
                        @endif
                        <div class="text-center innerAll">
                            <a href="" class="btn btn-default" data-dismiss="modal" aria-hidden="true">@lang('button.cancel')</a>
                            <button class="btn btn-danger" type="submit">@lang('button.ok')</button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- // Modal body END -->

        </div>
    </div>

</div>
<!-- // Modal END -->

<!-- CREATE ATTACHMENT MODAL -->
<div class="modal fade" id="modal-attachment">

    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">@lang('form/title.Upload_File')</h3>
            </div>
            <!-- // Modal heading END -->

            <!-- Modal body -->
            <div class="modal-body">

                <div class="innerAll">
                    <form class="margin-none innerLR inner-2x" method="post"
                          action="{{ route('create/idea_step_activity_attachment',$idea_step_activity->id) }}" enctype="multipart/form-data" id="form-modal-attachment">
                        <input type="hidden" name="idea_step_activity_id" value="{{{$idea_step_activity->id}}}" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label>@lang('form/title.File_Title')</label>
                            <input id="comment" name="comment" type="text" placeholder="{{Lang::get('form/title.File_Title')}}" class="form-control">
                        </div>
                        <!-- Solution Attachment -->
                        <div class="form-group {{ $errors->first('attachment', 'has-error') }}">
                            <label for="attachment" class="">@lang('idea_step_activities/form.attachment')</label>
                            {{ Form::file('attachment',array('id'=>'attachment','class'=>'form-control')) }}
                            {{ $errors->first('attachment', '<span class="help-block">:message</span>') }}
                        </div>
                        <label>@lang('general.all_file_size_type')</label>
                        <div class="text-center innerAll">
                            <a href="" class="btn btn-default" data-dismiss="modal" aria-hidden="true">@lang('button.cancel')</a>
                            <button class="btn btn-danger" type="submit" onclick="validate_attachment();">@lang('button.save')</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- // Modal body END -->
        </div>
    </div>

</div>
<!-- // Modal END -->
@stop
@section('body_bottom')
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>
    $(function () {
        $('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});
        $( "#form-modal-attachment" ).submit(function( event ) {
            var t = $('#comment').val();
            if(!t.trim() && t.length < 1){
                alert( "Please enter a form title!!!" );
                event.preventDefault();
            }
            var f = $('#attachment').val();
            if(!f.trim()){
                alert( "Please enter a file!!!" );
                event.preventDefault();
            }
        });
    });
</script>
@stop
