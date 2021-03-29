@extends('layouts.app')

@section('content')
<div class="container">
    
    
        @if(count($posts)>0)
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                @if($p==null)
                <h2>My Favourite Posts</h2>
                @else
                <h2>{{ $name }} Posts</h2>
                @endif
                <hr>
            </div>
            @foreach($posts as $post)
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <b>{{ $post->title }}</b> 
                        </div>
                        <div class="card-body">{{ Str::limit($post->content, 300) }}</div>
                        <div class="card-footer">
                            @if($post->category==0)
                               Cat: Undefined
                            @else
                               Cat: {{ $category[$post->category -1]->name }}
                            @endif
                            <br>
                            <a href="{{ route('postView',['id'=>$post->id]) }}"><b>View Full Post...</b></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
            @if($p!=null)
            <div class="d-flex justify-content-center mt-4">
                {!! $posts->links() !!}
            </div>
            @endif
        @else
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                @if($p==null)
                <h2>No favourite</h2>
                @else
                <h2>No post aviavle for {{ $name }} </h2>
                @endif
                <hr>
            </div>
        </div>
        @endif
    
</div>
@endsection
