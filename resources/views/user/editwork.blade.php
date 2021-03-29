@extends('layouts.app')

@section('content')
<div class="container">
    

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Edit Work</h2>
            <hr>
            <form method="POST" action={{ route('alumni-work-updated',['workId'=>$work->id]) }}>
                @csrf
                <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Post </label>
                  <div class="col-sm-10">
                    <input type="text"  class="form-control" name="post" placeholder="Director" value="{{ $work->post }}" required>
                  </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Working At</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="place" placeholder="My Company" value="{{ $work->place }}" required>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">City</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="city" placeholder="City" value="{{ $work->city }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea name="description" rows="4" maxlength="255" style="width:100%;resize: none">{{ $work->description }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Start at</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" name="start_at" value="{{ $work->start_at }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label"> </label>
                    <div class="col-sm-auto">
                        <label for="male">Currently working</label>
                        <input type="radio" id="state" name="state" onclick="workingAt(1)" value="1" required>
                    </div>
                    <div class="col-sm-auto">
                        <label for="male">Passed</label>
                        <input type="radio" id="state" name="state" onclick="workingAt(0)" value="0">
                    </div>
                </div>

                <div class="form-group row" id="endatdiv">
                    <label for="inputPassword" class="col-sm-2 col-form-label">End at</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" name="end_at" value="{{ $work->end_at }}" >
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2" >
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>

            <script>
                function workingAt(i){
                    if(i==1){
                        $('#endatdiv').css({"display":"none"})
                    }else{
                        $('#endatdiv').css({"display":"flex"})
                    }
                }
            </script>
        </div>
    </div>

    
</div>
@endsection
