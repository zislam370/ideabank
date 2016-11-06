<style>
    .projects{
        border-bottom: 1px solid #eee;
        padding: 0 0 10px;
        float: none;
        display: table;
    }
    .projects .image{
        margin-right: 10px;
    }
    .projects .detail h4{
        margin: 0;
        font-size: 1.2em;
    }
    .projects .detail .org{
        font-size: .9em;
        color: #666;
    }

</style>
@foreach($running_ideas as $idea)
<div class="row">
    <div class="projects col-lg-10 center-block">
        <h4><a href="{{ URL::route('show-idea',$idea->id) }}">{{$idea->name}}</a></h4>

        <div class="image pull-left">
            <img alt="Profile" class="" width="32" src="{{ asset($idea->author->avatar->url('medium')) }}">
        </div>
        <div class="detail">
            <div class="org">
                {{$idea->beneficaries}}
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="row" style="margin-top: 10px">
    <div class="col-lg-8 center-block" style="float: none;">
        <!-- Controls -->
        <div class="controls pull-right">
            <a class="fa btn btn-sm btn-info btn-ass" href="{{route('all_ideas')}}">@lang('form/title.show_all')</a>
        </div>
    </div>
</div>
