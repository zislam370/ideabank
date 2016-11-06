@extends('backend/layouts/default')

{{-- Page content --}}
@section('content')


    {{--<section class="panel">--}}

        {{--<div class="panel-body">--}}
            {{--<ul class="nav nav-pills" >--}}
                {{--<li{{ Request::is('account/profile') ? ' class="active"' : '' }}><a href="{{ URL::route('profile') }}">@lang('form/title.Profile')</a></li>--}}
                {{--<li{{ Request::is('account/change-password') ? ' class="active"' : '' }}><a href="{{ URL::route('change-password') }}">@lang('form/title.change_password')</a></li>--}}
{{--<!--                <li{{ Request::is('account/change-email') ? ' class="active"' : '' }}><a href="{{ URL::route('change-email') }}">Change Email</a></li>-->--}}
                {{--<li{{ Request::is('account/change-mobile') ? ' class="active"' : '' }}><a href="{{ URL::route('change-mobile') }}">@lang('form/title.change_mobile')</a></li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</section>--}}
    <div class="innerT">

       </div>
    <div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="modal-compose">
   <div class="modal-dialog">
        <div class="modal-content">
                       <!-- Modal body -->
           <div class="modal-body padding-none">
            <h2>@lang('button.send_message')</h2>
            <br>
               <form class="form-horizontal" role="form" method="post" action="{{ route('create/message') }}" autocomplete="off">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                   <input type="hidden" name="redirect" value="profile" />
                   <div class="">
                       <div class="innerLR">
                           <div class="form-group">
                               {{ Form::label('to', Lang::get('button.to'), array('class'=>'col-sm-2 control-label')) }}
                               <div>
                                   <div class="input-group">
                                    @if ((Sentry::getUser()->id==$user->id))
                                    {{ Form::input('int', 'receiver_mobile', Input::old('receiver_mobile'), array('class'=>'form-control')) }}
                                    @else
                                    {{ Form::input('int', 'receiver_mobile', Input::old('receiver_mobile',$user->mobile), array('class'=>'form-control')) }}
                                       {{--<input name="to" type="text" class="form-control" id="to" value="{{{$user->mobile}}}">--}}
                                    @endif
                                   </div>
                               </div>
                           </div>
                           </div>
                           <div class="clearfix"></div>
                   </div>
                         <div class="form-group">
                             {{ Form::label('body', Lang::get('form/title.Body'), array('class'=>'col-sm-2 control-label')) }}
                             <div class="col-sm-8">
                               {{ Form::textarea('body', Input::old('body'), array('class'=>'form-control', 'placeholder'=>Lang::get('form/title.Body'))) }}
                             </div>
                         </div>
                         <!-- Form actions -->
                     <div class="control-group">
                         <div class="controls">
                             <button type="submit" class="btn btn-success">@lang('button.send')</button>
                         </div>
                     </div>
               </form>
           </div>
        </div>
   </div>
</div>

@yield('account-content')

<script>

//    $(document).ready(function(){
//        $( '#ck_body' ).ckeditor();
//        var editor = $('#ck_body').ckeditorGet();
//        editor.on( 'key', function( evt ){
//
//                    //evt.preventDefault();
//                    //console.debug(evt.editor.getData());
//                    var editorContent = $(editor.getData());
//                                    var plainEditorContent = editorContent.text().trim();
//                                    //console.log(plainEditorContent);
//                                    console.log("Length: "+plainEditorContent.length);
//                    if(plainEditorContent.length>10){
//                        evt.cancel();
//                    }
//                }, editor.element.$ );

//    });
</script>

@stop
