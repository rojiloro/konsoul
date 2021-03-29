@extends('layouts.app-admin')

@section('content')



<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-3  mt-1">
            <a href="{{ route('admin-users') }}" class="card-link">
                <div class="card">
                    <div class="card-header">New Users</div>
                    <div class="card-body">
                        <h2>{{ count($new_user) }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3  mt-1">
            <a href="#" class="card-link">
                <div class="card">
                    <div class="card-header">Alumni</div>
                    <div class="card-body">
                        <h2>{{ count($alumni) }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3  mt-1">
            <a href="#" class="card-link">
                <div class="card">
                    <div class="card-header">Teachers</div>
                    <div class="card-body">
                        <h2>{{ count($teacher) }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3  mt-1">
            <a href="#" class="card-link">
                <div class="card" >
                    <div class="card-header">Students</div>
                    <div class="card-body">
                        <h2>{{ count($student) }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mt-1">
            <a href="{{ route('admin-post') }}" class="card-link">
                <div class="card">
                    <div class="card-header">Posts</div>
                    <div class="card-body">
                        <h2>{{ count($post) }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3  mt-1">
            <a href="{{ route('admin-category') }}" class="card-link">
                <div class="card">
                    <div class="card-header">Category</div>
                    <div class="card-body">
                        <h2>{{ count($category) }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3  mt-1">
            <a href="#" class="card-link">
                <div class="card">
                    <div class="card-header">Comments</div>
                    <div class="card-body">
                        <h2>0</h2>
                    </div>
                </div>
            </a>
        </div>

    </div>

    
</div>


@endsection
