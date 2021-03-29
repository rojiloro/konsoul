@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 ofset-2">
            <form method="GET" action={{ route('UserSearch') }}>
                <div class="form-row">
                  <div class="col-7">
                    <input type="text" class="form-control" name="name" placeholder="Search">
                  </div>
                  <div class="col">
                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                  </div>
                  
                </div>
            </form>
              <hr>
        </div>

        <div class="col-md-9 offset-md-3 mb-5">
            @if(count($users)>0)
                @if($search!=null)
                    <h3>Result for {{ $search }}</h3>
                @endif
            @else
                @if($search!=null)
                    <h3>No result for {{ $search }}</h3>
                @endif
            @endif
        </div>
        <div class="col-md-8">
            <div class="row">
                @foreach($users as $user)
                    <div class="col-md-12 mt-2">
                        <div class="row">
                            <div class="col-md-3 col-4 d-flex justify-content-end">
                                @if($user->path==null)
                                
                                <img src={{ URL::asset( "img/avatar_default.png" ) }} class="rounded-circle img-thumbnail img-fluid"  width="90%">
                                @else
                                <img src={{ URL::asset( "img/profile-img/".$user->path ) }} class="rounded-circle img-thumbnail img-fluid"  width="90%">
                                @endif
                            </div>

                            <div class="col-md-9 col-8 d-flex justify-content-start align-items-center" >
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <a href="{{ route('userProfileView',['id'=>$user->id]) }}" class="navbar-brand"><h2>{{ $user->name }}</h2></a>
                                    </div>
                                    <div class="col-md-12">
                                        @if($user->role==1)
                                        <h5>Student</h5>
                                        @elseif($user->role==2)
                                        <h5>Teacher</h5>
                                        @elseif($user->role==3)
                                        <h5>Alumni</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                @endforeach

                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <h3 class="mb-4">Users:</h3>
            <a href="{{ route("allUserStudent") }}">Students</a>
            <hr>
            <a href="{{ route("allUserTeacher") }}">Teacher</a>
            <hr>
            <a href="{{ route("allUserAlumni") }}">Alumni</a>
        </div>
    </div>
</div>
@endsection
