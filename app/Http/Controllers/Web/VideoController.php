<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function show(Video $video){

       if(Request()->wantsJson())
       {
           return response()->json($video);
       }

        return view('web.video.single',compact('video'));
    }
    public function updateViews(Video $video){
        if(Auth::check())
        {
            if(Auth()->user()->id != $video->channel->user_id)
            {
                $video->increment('views');

            }
        }
        else{
            $video->increment('views');

        }


    }

}
