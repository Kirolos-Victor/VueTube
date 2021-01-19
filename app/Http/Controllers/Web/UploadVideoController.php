<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Jobs\Videos\ConvertForStreaming;
use App\Jobs\Videos\CreateVideoThumbnail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadVideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $channel=Auth()->user()->channel;
        return view('web.upload.index',compact('channel'));
    }

    public function store(Request $request)
    {
        //sdd($request->title);
        $channel=Auth()->user()->channel;
        $path=$request->video->store('channels/'.$channel->id.'/videos');
        $video=$channel->videos()->create([
            'title'=>$request->title,
            'path'=>$path,
            //'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        //dd($video);

        $this->dispatch(New ConvertForStreaming($video));
        $this->dispatch(New CreateVideoThumbnail($video));

        return response()->json($video);
    }
}
