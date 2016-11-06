@foreach ($user_msg as $msg)
    @if($msg->in_out=="IN")
        <div class="innerAll border-bottom bg-gray text-center">
            <div class="btn-group btn-group-sm">
            <a href="#modal-compose" data-toggle="modal" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
        </div>
        <div class="col-sm-12 bg-gray">
            <div class="messageL col-sm-10">
                <small class=" pull-left">{{$msg->created_at}}</small>
                <div class="clearfix"></div>
                <h5 class=" text-weight-normal">{{$msg->body}}</h5>
            </div>
        </div>
        @else
        <div class="col-sm-12 bg-gray">
            <div class="messageR col-sm-10">
                <small class=" pull-right">{{$msg->created_at}}</small>
                <div class="clearfix"></div>
                <h5 class="text-weight-normal ">{{$msg->body}}</h5>
            </div>
        </div>
    @endif
@endforeach

