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
                  <table class="table">
                     <tbody>
                       @foreach($newsmedias as $newsmedia)
                       <tr>
                           <td><img alt="" src="http://localhost/Ideabank/public/system/User/avatars/000/000/004/medium/images (1).jpg" width="130"></td>
                           <td><b><a href="">{{ $newsmedia->title }}</a>&nbsp;by</b><br>
                                   {{ Str::limit($newsmedia->slide_title, 200) }}
                                   <br>
                               6554 Views | {{$newsmedia->created_at}}  | Social media share <a href=""><i class="fa fa-share-alt"></i></a>
                           </td>
                       </tr>
                       @endforeach
                       </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
@stop
