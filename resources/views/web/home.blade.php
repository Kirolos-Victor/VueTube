@extends('layouts.app')
@section('content')
    @if($videos->count() >0)
    <div class="main-grids" style="margin-bottom: 15%">
        <div class="top-grids">
            <div class="recommended-info">
                <h3>Recent Videos</h3>
            </div>
            @foreach($videos as $video)
                <div class="col-md-4 resent-grid recommended-grid slider-top-grids">
                    <div class="resent-grid-img recommended-grid-img">
                        <a href="{{route('videos',$video->id)}}"><img src="{{asset($video->thumbnail)}}" alt="" /></a>
                        <div class="time" style="top: 90% !important;">
                            <p>{{ gmdate("i:s",$video->duration) }}</p>
                        </div>
                        <div class="clck" style="padding-right: 5px;">
                            <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="resent-grid-info recommended-grid-info">
                        <h3><a href="{{route('videos',$video->id)}}" class="title title-info">{{$video->title}}</a></h3>
                        <ul>
                            <li><p class="author author-info"><a href="{{route('channel.show',$video->channel->id)}}" class="author">{{$video->channel->name}}</a></p></li>
                            <li class="right-list"><p class="views views-info">{{$video->views}} {{Illuminate\Support\Str::plural('view',$video->views)}}</p></li>
                        </ul>
                    </div>
                </div>
            @endforeach

            <div class="clearfix"> </div>
        </div>
    </div>
    @endif
@endsection
