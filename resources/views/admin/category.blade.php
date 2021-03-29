@extends('layouts.app-admin')

@section('content')
<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Add New Category:</h2>
            <hr>
            <form method="post" action="{{ route('admin-category-new') }}" >
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name </label>
                    <div class="col-sm-10">
                      <input type="text"  class="form-control" name="name" placeholder="Student Chapter" maxlength="20" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2" >
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center">

        @if(count($category)>0)
        <div class="col-md-12">
            <h2>All Categories</h2>
            <hr>
        </div>
            @foreach($category as $category)
                <div class="col-md-4">
                    <div class="card card-body justify-content-center">
                        <h3>{{ $category->name }}</h3>
                        <div class="btn-group">
                            <a href="{{ route('admin-category-edit', ['id'=>$category->id]) }}" class="btn btn-success btn-sm">Edit</a>
                            <a href="{{ route('admin-category-delete', ['id'=>$category->id]) }}" class="btn btn-primary btn-sm">Delete</a>
                            <a href="{{ route('admin-category-delete-post', ['id'=>$category->id]) }}" class="btn btn-danger btn-sm">Delete(With Posts)</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>

    
  
</div>
@endsection
