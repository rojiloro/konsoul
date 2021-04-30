@extends('layouts.app')

@section('content')
<div class="container">
    

    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2><b>{{ $post->title }}</b></h2>
            <b>Kategori:</b> @if($category!=null) {{ $category->name }} @else Undefine Category @endif
            <br><img src="{{ URL::asset( $pp_img ) }}" class="rounded-circle img-fluid" height="30px" width="30px"  alt="Cinque Terre"> <a href={{route('userProfileView',['id'=>$user->id])}}>{{ $user->name }}</a>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            {!! $post->content !!}
            <hr>
            <button class="btn btn-primary btn-sm" onclick="likeUnlike()"><span id="count">0</span> <span id="like">Suka</span></button>
            <!-- @if($own==0)
                @if($fav==0)
                <a href="{{ route("AddFavourite",["id"=>$post->id]) }}" class="btn btn-success btn-sm ml-2">Add as Favourite</a>
                @else
                <a href="{{ route("RemoveFavourite",["id"=>$post->id]) }}" class="btn btn-danger btn-sm ml-2">Remove from Favourite</a>
                @endif
            @endif -->
        </div>

        <div class="col-md-12 mt-5">
            <form method="post" action="{{ route("Comment",["id"=>$post->id]) }}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="4" name="comment" maxlength="255" style="width:100%;resize: none"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 " >
                        <button type="submit" class="btn btn-primary">Balas</button>
                    </div>
                </div>
            </form>
        </div>

        @if(count($comments)>0)
        @foreach($comments as $comment)
        <div class="col-md-12">
            <div class="row">
                <div class="col-12">
                    <h4> <a href={{route('userProfileView',['id'=>$comment->user_id])}}>{{ $comment->name }}</a> </h4>
                </div>

                <div class="col-md-12">
                    <p><i>{{ $comment->comment }}</i></p>
                </div>

                @auth
                    @if(Auth::user()->id == $post->user_id)
                        <div class="col-md-12">
                            <a href="{{ route("CommentDelete",["id"=>$comment->id,"postId"=>$post->id]) }}" class="btn btn-danger btn-sm">Hapus</a>
                        </div>
                    @elseif($comment->user_id==Auth::user()->id)
                    <div class="col-md-12">
                        <a href="{{ route("CommentDelete",["id"=>$comment->id,"postId"=>$post->id]) }}" class="btn btn-danger btn-sm">Hapus</a>
                    </div>
                    @endif
                @endauth
            </div>

            <hr>
        </div>
        @endforeach
        @else
        <div class="col-md-12">
            <p>Tidak ada komentar di postingan ini</p>
        </div>
        @endif
    </div>


    <script>
        var liked=0
        likeCount()
        likeCheck()

        function likeUnlike(){
            if(liked==0){
                like()
            }else if(liked==1){
                unlike()
            }
        }
        
        function likeCount(){
            let url = '{{ route("postLikeCount",["id"=>$post->id]) }}';
            fetch(url)
            .then(res => res.json())
            .then((out) => {
                document.getElementById("count").innerHTML =out['count']
                
            })
            .catch(err => { throw err });
        }

        function likeCheck(){
            let url = '{{ route("postLikeCheck",["id"=>$post->id]) }}';
            fetch(url)
            .then(res => res.json())
            .then((out) => {
                if(out['liked']==0){
                    document.getElementById("like").innerHTML ="Suka"
                    liked=0

                }else if(out['liked']==1){
                    document.getElementById("like").innerHTML ="Tidak suka"
                    liked=1;
                }
                
            })
            .catch(err => { throw err });
        }

        function like(){
            let url = '{{ route("postLike",["id"=>$post->id]) }}';
            fetch(url)
            .then(res => res.json())
            .then((out) => {
                likeCount();
                likeCheck()
            })
            .catch(err => { throw err });
        }

        function unlike(){
            let url = '{{ route("postUnLike",["id"=>$post->id]) }}';
            fetch(url)
            .then(res => res.json())
            .then((out) => {
                likeCount();
                likeCheck()
            })
            .catch(err => { throw err });
        }
    </script>

 
</div>
@endsection
