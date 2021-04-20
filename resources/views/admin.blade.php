@extends('layouts.app-admin')

@section('content')



<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-3  mt-1">
            <a href="{{ route('admin-users') }}" class="card-link">
                <div class="card">
                    <div class="card-header">New Users</div>
                    <div class="card-body">
                        <h2>{{ $new_user }}</h2>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-3  mt-1">
            <a href="{{ route('admin-users-teacher') }}" class="card-link">
                <div class="card">
                    <div class="card-header">Guru</div>
                    <div class="card-body">
                        <h2>{{ $teacher }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3  mt-1">
            <a href="{{ route('admin-users-student') }}" class="card-link">
                <div class="card" >
                    <div class="card-header">Siswa</div>
                    <div class="card-body">
                        <h2>{{ $student }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mt-1">
            <a href="{{ route('admin-post') }}" class="card-link">
                <div class="card">
                    <div class="card-header">membuat postingan</div>
                    <div class="card-body">
                        <h2>{{ $post }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3  mt-1">
            <a href="{{ route('admin-category') }}" class="card-link">
                <div class="card">
                    <div class="card-header">Category</div>
                    <div class="card-body">
                        <h2>{{ $category }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3  mt-1">
            <a href="{{ route('admin-comment') }}" class="card-link">
                <div class="card">
                    <div class="card-header">Balasan</div>
                    <div class="card-body">
                        <h2>{{ $comment }}</h2>
                    </div>
                </div>
            </a>
        </div>

    </div>

    
</div>


@endsection
