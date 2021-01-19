<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
        {
            $this->middleware(['auth'])->only('store');
        }
    public function index(Video $video)
    {
     return $video->comments()->paginate(5);
    }
    public function store(Request $request,Video $video){
     if(Auth::check())
     {
         $data= Auth()->user()->comments()->create([
             'text'=>$request->text,
             'video_id'=>$video->id,
             //you have to use fresh() to load the relation you defined in the comment model ...
         ])->fresh();
         return response()->json($data);
     }

    }
}
