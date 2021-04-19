@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(count($new_posts))
        <div class="col-md-12">
            <h2>New Posts: </h2>
            <hr>
        </div>
        @foreach($new_posts as $post)
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <b>{{ $post->title }}</b> 
                    @if($post->state==0) 
                    <span class="badge badge-secondary">Not Approve</span>
                    @else 
                    <span class="badge badge-primary">Approved</span>
                    @endif
                </div>
                <div class="card-body">{!! Str::limit($post->content, 300) !!}</div>
                <div class="card-footer">
                    @if($post->category==0)
                       Cat: Undefined
                    @else
                       Cat: {{ $category[$post->category -1]->name }}
                    @endif
                    <br>
                    <a href="{{ route('admin-post-approve',['id'=>$post->id]) }}" class="btn btn-primary btn-sm">Approve</a>
                    <a href="{{ route('admin-post-delete',['id'=>$post->id]) }}" class="btn btn-danger btn-sm mr-4">Delete</a>
                    <a href="{{ route('postView',['id'=>$post->id]) }}"><b>View Full Post...</b></a>
                </div>
            </div>
        </div>
        @endforeach
        
        @else
        <div class="col-md-12">
            <h2>No new post for approval</h2>
        </div>
        @endif
    </div>
    <div class="d-flex justify-content-center mt-4">
        {!! $new_posts->links() !!}
    </div>

    <div class="row justify-content-center mt-5">
        @if(count($flag_posts))
        <div class="col-md-12">
            <h2>Flag Posts Review: </h2>
            <hr>
        </div>

            @foreach($flag_posts as $post)
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <b>{{ $post->title }}</b> 
                            @if($post->state==0) 
                            <span class="badge badge-secondary">Not Approve</span>
                            @else 
                            <span class="badge badge-primary">Approved</span>
                            @endif
                        </div>
                        <div class="card-body">{!! Str::limit($post->content, 300) !!}</div>
                        <div class="card-footer">
                            @if($post->category==0)
                               Cat: Undefined
                            @else
                               Cat: {{ $category[$post->category -1]->name }}
                            @endif
                            <br>
                            <a href="{{ route('admin-post-delete',['id'=>$post->id]) }}" class="btn btn-danger btn-sm">Delete</a>
                            <a href="{{ route('admin-post-removeFlag',['id'=>$post->id]) }}" class="btn btn-primary btn-sm mr-4">Remove Flag</a>
                            <a href="{{ route('postView',['id'=>$post->id]) }}"><b>View Full Post...</b></a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        <div class="col-md-12">
            <h2>No new flag post for review</h2>
        </div>
        @endif

        <div class="d-flex justify-content-center mt-4">
            {!! $flag_posts->links() !!}
        </div>
    </div>


    <div class="row justify-content-center mt-5">
        @if(count($posts))
        <div class="col-md-12">
            <h2>All Post: </h2>
            <hr>
        </div>

            @foreach($posts as $post)
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <b>{{ $post->title }}</b> 
                            @if($post->state==0) 
                            <span class="badge badge-secondary">Not Approve</span>
                            @else 
                            <span class="badge badge-primary">Approved</span>
                            @endif
                        </div>
                        <div class="card-body">{!! Str::limit($post->content, 300) !!}</div>
                        <div class="card-footer">
                            @if($post->category==0)
                               Cat: Undefined
                            @else
                               Cat: {{ $category[$post->category -1]->name }}
                            @endif
                            <br>
                            <a href="{{ route('admin-post-delete',['id'=>$post->id]) }}" class="btn btn-danger btn-sm mr-4">Delete</a>
                            <a href="{{ route('postView',['id'=>$post->id]) }}"><b>View Full Post...</b></a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        <div class="col-md-12">
            <h2>No post avialable</h2>
        </div>
        @endif
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $posts->links() !!}
    </div>
</div>
@endsection
