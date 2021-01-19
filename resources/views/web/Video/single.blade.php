@extends('layouts.app')
@section('styles')
    <!--Video js -->
    <link href="https://unpkg.com/video.js/dist/video-js.min.css" rel="stylesheet">
    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <script src="https://unpkg.com/video.js/dist/video.min.js"></script>@endsection
@section('content')
    <div class="show-top-grids">
        <div class="col-sm-8 single-left">
            <div class="song">
                <div class="video-grid">
                    <video
                        style="cursor: pointer"
                        id="my-video"
                        class="video-js"
                        controls
                        preload="auto"
                        width="640"
                        height="264"
                        data-setup='{ "autoplay": false}'
                    >
                        <source src="{{asset("videos/{$video->id}/{$video->id}.m3u8")}}" type="application/x-mpegURL" />
                    </video>
                    <div class="song-info" style="margin-top: 10px;">
                        <h3>{{$video->title}}</h3>
                        <p style="color: gray;  font-size: 16px;padding-top: 30px; margin-bottom: -20px;">{{$video->views}} {{Illuminate\Support\Str::plural('view',$video->views)}} •
                            {{$video->created_at->toFormattedDateString()}}</p>
                    </div>
                    <hr>
                   <img src="{{asset($video->channel->image()?$video->channel->image():$video->channel->image)}}" style="width: 50px;height: 50px; border-radius: 50%;margin-right: 10px;"><a href="{{route('channel.show',$video->channel->id)}}" style="font-weight: bold;color: black; font-size: 18px">{{$video->channel->name}}</a>
                    <p style="color: gray;margin-top: -10px; margin-left: 65px; font-size: 14px">{{$video->channel->subscribers()->count()}} subscribers</p>
                </div>
            </div>
            <div class="song-grid-right">
                <div class="share">
                    <h5>Share this</h5>
                    <ul>
                        <li><a href="#" class="icon fb-icon">Facebook</a></li>
                        <li><a href="#" class="icon dribbble-icon">Dribbble</a></li>
                        <li><a href="#" class="icon twitter-icon">Twitter</a></li>
                        <li><a href="#" class="icon pinterest-icon">Pinterest</a></li>
                        <li><a href="#" class="icon whatsapp-icon">Whatsapp</a></li>
                        <li><a href="#" class="icon like">Like</a></li>
                        <li><a href="#" class="icon comment-icon">Comments</a></li>
                        <li class="view" >200 Views</li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"> </div>
            <comments-form :video="{{$video}}"></comments-form>

        </div>
        <div class="clearfix"> </div>
    </div>

@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#my-video").one('click',function(){
                $.ajax({
                    url:"{{route('video.increment.views',$video->id)}}",
                    type: 'PUT',
                    data:{
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        console.log('Load was performed.');
                    }
                });
            });
        });
    </script>

    <script src="https://vjs.zencdn.net/7.8.4/video.js"></script>

@endsection
