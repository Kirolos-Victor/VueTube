<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $query=$request->search;
        if($query)
        {
            $videos=Video::where('title','LIKE',"%{$query}%")->Latest()->get();
        }
        else{
            $videos=Video::Latest()->get();

        }
        return view('web.home',compact('videos'));
    }
    public function search(Request $request)
    {
        $query=$request->search;
        $titles=Video::where('title','LIKE',"%{$query}%")->Latest()->pluck('title')->take(4);
        return response()->json($titles);
    }
}
