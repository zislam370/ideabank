@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
All Events ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div id="boder1" class="widget-small">
    <div id="boder" class="widget-heading"><h3>Inovation news and medias</h3></div>
      <div class="well ">
          <div class="media">
              <div class="" >
                  <div class="pull-right">
                  </div>
                  <table class="table">
                     <tbody>
                      @foreach($events as $event)
                            <div id="boder3" class="well">
                                <div id="boder2" class="thumb pull-left">
                                    <img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/index(1).png" width="60">
                                </div>
                                <div class="media-body">
                                    <p><b><font color="green"><a href="">{{ $event->link_title }}</a></font></b></p>
                                    Duration : {{$event->start}}  From  {{$event->end}}
                                    <p><h5>Vanue: BIAM Foundation New Eskaton,Dhaka.</h5></p>
                                </div>
                            </div>
                          @endforeach
                       </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
@stop
