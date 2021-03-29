@extends('layouts.app-admin')

@section('content')
<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Add New Category:</h2>
            <hr>
            <form method="post" action="{{ route('admin-category-edited', ['id'=>$category->id]) }}}" >
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name </label>
                    <div class="col-sm-10">
                      <input type="text"  class="form-control" name="name" placeholder="Student Chapter" maxlength="20" value="{{ $category->name }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2" >
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    
  
</div>
@endsection
