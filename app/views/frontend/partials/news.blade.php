<style>
    .news{
        padding: 0px 10px;
        margin: 0;
    }
    .news .image{
        margin-right: 10px;
    }
    .news .detail{
        word-wrap: break-word;
    }
    .news .detail h4{
        font-size: 1.5em;
    }
    .news .detail h4 span{
        color: #666;
        font-size: .8em;
        margin-left: 10px;
    }
    .news .venue{
        color: #888;
        font-size: .8em;
    }
</style>


<div id="carousel-example" class="carousel slide" data-ride="carousel">
<!-- Wrapper for slides -->
<div class="carousel-inner">
    <?php $i = 0 ?>
    @foreach($newsmedias as $newsmedia)
        @if($i%2==0)
            <div class="item {{$i==0?'active':''}}">
        @endif

                <div class="news col-lg-6">
                    <h4>{{{ $newsmedia->title }}}</h4>
                    @if (strpos($newsmedia->img->url('thumb'),'missing.png') === false )
                        <div class="image pull-left">
                            <img width="100" class="img-rounded" src="{{ asset($newsmedia->img->url('thumb')) }}">
                        </div>
                    @endif
                    <div class="detail">
                        {{{ $newsmedia->short_description }}}
                        <a  class="read-more-btn" href="{{ $newsmedia->url() }}">@lang('form/title.readmore')</a>
                    </div>
                </div>
        @if(($i+1)%2==0)
            </div>
        @endif
    <?php $i++;?>
    @endforeach
    @if(($i+1)%2==0)
        </div>
    @endif
    </div>
</div>


<div class="row">
    <div class="col-md-12 center-block">
        <!-- Controls -->
        <div class="controls pull-right" style="">
            <a class="left fa fa-chevron-left btn btn-sm btn-info btn-idbnk" href="#carousel-example"
               data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-sm btn-info btn-idbnk" href="#carousel-example"
                                        data-slide="next"></a>
            <a class="fa btn btn-sm btn-info btn-ass btn-idbnk" href="{{route('all_news_media')}}">@lang('form/title.show_all')</a>
        </div>
    </div>
</div>

