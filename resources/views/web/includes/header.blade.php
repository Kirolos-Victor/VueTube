<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"><h1><img src="{{asset("assets/site/images/logo.png")}}" alt="" /></h1></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <search-form></search-form>
            <div class="header-top-right">
                @auth()
                <div class="file">
                    <a href="{{route('upload.index')}}">Upload</a>
                </div>
                <div class="signin">
                    <!--Error use channel instance not channel()  -->
                    <a href="{{route('channel.show',Auth()->user()->channel->id)}}" class="play-icon popup-with-zoom-anim">{{auth()->user()->channel->name}}</a>
                </div>
                   <div class="signin" >
                       <form method="post" action="{{route('logout')}}">
                           @csrf
                           <button type="submit" class="btn btn-danger">Logout</button>
                       </form>
                   </div>
                @endauth
                @guest()
                <div class="signin">
                    <a href="{{route('register')}}" class="play-icon popup-with-zoom-anim">Sign Up</a>
                </div>
                <div class="signin">
                    <a href="{{route('login')}}" class="play-icon popup-with-zoom-anim">Sign In</a>
                </div>
                    @endguest
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</nav>
