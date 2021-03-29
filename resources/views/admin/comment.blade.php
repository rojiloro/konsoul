@extends('layouts.app-admin')

@section('content')
<div class="container">
    

    <div class="row justify-content-center mt-5">
        @if(count($comments))
        <div class="col-md-12">
            <h2>Flag Posts Review: </h2>
            <hr>
        </div>

            @foreach($comments as $comment)
                <div class="col-md-12 mt-4">
                    <div class="card">
                       
                        <div class="card-body">{{  $comment->comment }}</div>
                        <div class="card-footer">
                            <br>
                            <a href="{{ route('admin-comment-delete',['id'=>$comment->id]) }}" class="btn btn-danger btn-sm">Delete</a>
                            <a href="{{ route('admin-comment-flag-remove',['id'=>$comment->id]) }}" class="btn btn-primary btn-sm mr-4">Remove Flag</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        <div class="col-md-12">
            <h2>No new flag Comment for review</h2>
        </div>
        @endif

        <div class="d-flex justify-content-center mt-4">
            {!! $comments->links() !!}
        </div>
    </div>

</div>
@endsection
