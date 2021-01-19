<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Channels\UpdateChannelRequest;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only('update');
    }

    public function index(Channel $channel)
    {
        $data =$channel->subscribers()->count();
        return response()->json($data);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Channel $channel)
    {

        return view('web.channel.show',compact('channel'));
    }


    public function edit($id)
    {
        //
    }


    public function update(UpdateChannelRequest $request, Channel $channel)
    {

        if($request->hasFile('image')){
            $channel->clearMediaCollection('channel_image');
            $channel->addMediaFromRequest('image')
            ->toMediaCollection('channel_image');
        }
        //dd($channel->image());
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
    public function count(Channel $channel)
    {
        $data = $channel->subscribers()->count();
        return response()->json($data);
    }
}
