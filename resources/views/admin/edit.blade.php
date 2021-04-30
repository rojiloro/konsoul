@extends('layouts.app-admin')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action={{ route('admin-users-edited', ['id'=>$user->id]) }}>
                @csrf
                <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text"  class="form-control" name="name" placeholder="Name" value="{{ $user->name }}">
                  </div>
                </div>


                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="role" name="role">
                        <option value="1" @if($user->role==1)selected @endif >Siswa</option>
                        <option value="2" @if($user->role==2)selected @endif>Guru</option>
                    </select>
                    </div>
                </div>

               
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Kota Asal</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="home_town" placeholder="Kota Asal" value="{{ $user->home_town }}">
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Kota Sekarang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="current_city" placeholder="Kota Sekarang" value="{{ $user->current_city }}">
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
  
</div>
@endsection
