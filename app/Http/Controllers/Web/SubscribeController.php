<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Channel;


class SubscribeController extends Controller
{
public function __construct(){
    $this->middleware(['auth']) ;
}

    public function store(Channel $channel)
    {
        $currentUser=Auth()->user();
        if($channel->user_id != $currentUser->id)
        {
         $data=$currentUser->toggleSubscribe()->toggle([
               'channel_id'=>$channel->id,
            ]);
            return response()->json($data);

        }
        else{
            return 'error';
        }
    }

    public function destroy($id)
    {
        //
    }
}
