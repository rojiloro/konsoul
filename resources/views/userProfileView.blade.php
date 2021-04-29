@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 col-4 d-flex justify-content-end">
                    <img src={{ URL::asset( $pp_img ) }} class="rounded-circle img-thumbnail img-fluid"  width="90%">
                </div>

                <div class="col-md-9 col-8 d-flex justify-content-start align-items-center" >
                    <div class="row">
                        <div class="col-md-12">
                            <h2>{{ $user->name }}</h2>
                        </div>
                        <div class="col-md-12">
                            @if($user->role==1)
                                <h5>Student</h5>
                            @elseif($user->role==2)
                                <h5>Teacher</h5>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 mt-4"><h2>Profile Info:</h2><hr></div>
                        <div class="col-3 col-md-4"><b><h5>Name:</h5></b> </div> <div class="col-9 col-md-8"><h5>{{ $user->name }}</h5></div>
                        <div class="col-3 col-md-4"><b><h5>Email:</h5></b> </div> <div class="col-9 col-md-8"><h5>{{ $user->email }}</h5></div>
                        <div class="col-3 col-md-4"><b><h5>Phone:</h5></b> </div> <div class="col-9 col-md-8"><h5>{{ $user->phone }}</h5></div>
                        <div class="col-3 col-md-4"><b><h5>Current City</h5></b> </div> <div class="col-9 col-md-8"><h5>{{ $user->current_city }}</h5></div>
                        <div class="col-3 col-md-4"><b><h5>Home Town</h5></b> </div> <div class="col-9 col-md-8"><h5>{{ $user->home_town }}</h5></div>
                    </div>
                </div>
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
                                            <b>{{ $post->title }}</b> 
                                            
                                        </div>
                                        <div class="card-body">{{ Str::limit($post->content, 200) }}</div>
                                        <div class="card-footer">
                                            @if($post->category==0)
                                            Cat: Undefined
                                            @else
                                            Cat: {{ $category[$post->category -1]->name }}
                                            @endif
                                            | <a href="{{ route('postView',['id'=>$post->id]) }}"><b>View Full Post...</b></a>
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

            </div>
        </div>
    </div>
</div>
@endsection