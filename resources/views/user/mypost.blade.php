@extends('layouts.app')

@section('content')
<div class="container">
    

    @auth

    @if(Auth::user()->role!=0 && Auth::user()->role!=2)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action={{ route('newPost') }} enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Judul </label>
                    <div class="col-sm-10">
                      <input type="text"  class="form-control" name="title" min="2" maxlength="50" placeholder="Masukan Judul" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Isi </label>
                    <div class="col-sm-10">
                        <textarea class="ckeditor form-control" minlength="10" maxlength="4000" name="wysiwyg-editor"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Kategori </label>
                    <div class="col-sm-10">
                        <select class="form-control" id="category" name="category">
                            <option value="0">Undefine Category</option>
                            @foreach($category as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            Buat Postingan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>

    <script type="text/javascript">
        CKEDITOR.replace('wysiwyg-editor', {
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    @endif
    @endauth

        @if(count($posts)>0)
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <h2>Semua Post Saya:</h2>
                <hr>
            </div>
            @foreach($posts as $post)
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <b>{{ $post->title }}</b> 
                            @if($post->state==0) 
                            <span class="badge badge-secondary">Belum disetujui</span>
                            @else 
                            <span class="badge badge-primary">Disetujui</span>
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
                        @auth
                            @if(Auth::user()->role!=0 && Auth::user()->role!=2)
                            <a href="{{ route('postDelete',['id'=>$post->id]) }}" class="btn btn-danger btn-sm mr-4">Hapus</a>
                            @endif
                        @endauth                            
                            <a href="{{ route('postView',['id'=>$post->id]) }}"><b>Lihat Postingan...</b></a>
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
@endsection
