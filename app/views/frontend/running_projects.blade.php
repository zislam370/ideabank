@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
All Ideas ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div id="boder1" class="widget-small">
    <div id="boder" class="widget-heading"><h3>Inovation news and medias</h3></div>
      <div class="well ">
          <div class="media">
              <div class="media-body" >
                  <div class="pull-right">
                  </div>
                 <div id="boder5" class="well-info">
                   <h4 class="well-title">Running Project</h4>
                 </div>
                     @foreach($workflow_categories as $workflow_category)
                       <div id="boder4" class="well">
                           <div id="boder2" class="thumb pull-left">
                               <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/SIF.jpg" width="60">
                           </div>
                           <div class="media-body">
                               <p><p>{{$workflow_category->name}}<b>
                               {{$workflow_category->workflow_name}}
                               </b></p></p>
                           </div>
                       </div>
                       @endforeach
                   </div>
              </div>
          </div>
      </div>
  </div>
@stop
