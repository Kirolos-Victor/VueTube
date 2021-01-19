@extends('layouts.app')
<style>

</style>
@section('content')
    <div class="show-top-grids">
        <!-- Main content -->
        @if($channel->editable())
        <form id="channel-form" action="{{route('channel.update',$channel->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <section class="content" style="margin-left: 20px; margin-bottom: 300px">
                <div class="row">
                    <div class="col-md-6">
                                <h3 class="card-title">Channel</h3>

                        <div class="form-group">
                           <div class="channel-avatar">
                               <div class="channel-avatar-overlay" onclick="document.getElementById('image').click()">
                                   @include('svgImg')
                           </div>
                               <img src="{{asset($channel->image())}}" style="border-radius: 50px;width: 100px;height: 100px;">

                           </div>
                            <input style="display: none" onchange="document.getElementById('channel-form').submit()" type="file" id="image" name="image">
                            @error('image')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            <div class="form-group">
                                    <label for="inputName">Channel Name</label>
                                    <input type="text" id="inputName" class="form-control" name="name" value="{{$channel->name}}">
                                </div>
                            @error('name')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                                <div class="form-group">
                                    <label for="inputDescription">Channel Description</label>
                                    <textarea id="inputDescription" class="form-control" rows="4" name="description">{{$channel->description??''}}</textarea>
                                </div>
                            @error('description')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            <button type="submit" class="btn btn-dark">Save</button>

                    </div>
                </div>
                </div>
            </section>


        </form>
    @else
           <div style="margin-left: 20px; margin-bottom: 500px; margin-right: 200px">
               <div class="card card-primary card-outline">
                   <div class="card-body box-profile">
                       <div class="text-center">
                           <img class="profile-user-img img-fluid img-circle" style="width: 200px; height: 200px;" src="{{$channel->image()}}" alt="User profile picture">
                       </div>

                       <h3 class="profile-username text-center">{{$channel->name}}</h3>

                       <p class="text-muted text-center">{{$channel->description??'bio'}}</p>

                      <subscribe-button  :channel="{{$channel}}" :subscribers="{{$channel->subscribers}}">
                      </subscribe-button>
                   </div>
                   <!-- /.card-body -->
               </div>
           </div>
    @endif
        <!-- /.content -->    </div>
@endsection
