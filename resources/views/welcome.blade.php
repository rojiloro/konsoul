<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
</head>
<body>

    
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth

                        @if(Auth::user()->role!=0 && Auth::user()->role!=1)
                        <li class="nav-item">
                            <a class="dropdown-item" href={{ route('mypost') }}>Konsulan Murid</a> 
                        </li>

                        <li class="nav-item">
                            <a class="dropdown-item" href={{ route('myFavPost') }}>Favorit Konsul</a>
                        </li>

                        <li class="nav-item">
                            <a class="dropdown-item" href={{ route('allUser') }}>Data Murid</a>
                        </li>
                        
                        @elseif(Auth::user()->role==1)                     
                        <li class="nav-item">
                            <a class="dropdown-item" href={{ route('mypost') }}>My Posts</a>
                        </li>

                        <li class="nav-item">
                            <a class="dropdown-item" href={{ route('myFavPost') }}>Favourite Posts</a>
                        </li>

                        @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('home') }}">Setting</a>
                                    <a class="dropdown-item" href="{{ route('PasswordUpdate') }}">Change Password</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    @if(count($posts)>0)
                        <div class="row justify-content-center mt-5">
                            <div class="col-md-12">
                                <h2>All Posts:</h2>
                                <hr>
                            </div>
                            @foreach($posts as $post)
                                <div class="col-md-12 mt-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <b><a href="{{ route('postView',['id'=>$post->id]) }}">{{ $post->title }}</a></b> 
                                            
                                        </div>
                                        <div class="card-body">{!! Str::limit($post->content, 200) !!}</div>
                                        <div class="card-footer">
                                            @if($post->category==0)
                                            Cat: Undefined
                                            @else
                                            Category: 
                                            @endif
                                            | <a href="{{ route('postView',['id'=>$post->id]) }}"><b>Read more...</b></a>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {!! $posts->links() !!}
                        </div>
                    @endif
                </div>

                <div class="col-md-3">
                    @if(count($category)>0)
                        <div class="row justify-content-center mt-5">
                            <div class="col-md-12">
                                <h2>All Categories</h2>
                                <hr>
                            </div>

                            <div class="col-md-12 mt-3">
                            @foreach($category as $cat)
                                    <ul class="list-group">
                                        <a href="{{ route('CategoryPosts',['id'=>$cat->id]) }}"
                                            class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $cat->name }}
                                            <span class="badge badge-secondary badge-pill">{{ $cat->total }}</span>
                                        </a>
                                    </ul>
                            @endforeach
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    
</body>
</html>
