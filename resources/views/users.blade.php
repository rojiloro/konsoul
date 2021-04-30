@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <img src="{{ URL::asset( $pp_img ) }}" class="rounded-circle img-thumbnail img-fluid" height="300px" width="300px"  alt="Cinque Terre"> 
        </div>
        <div class="col-md-6">
            <form action={{ route('imgChange') }}  method="POST"  enctype="multipart/form-data">
                @csrf
                
                <div class="form-group row">
                    <label for="profile_image" class="col-md-4 col-form-label text-md-right">Foto Profil</label>
                    <div class="col-md-6">
                        <input id="image" type="file" class="form-control" name="image" accept="image/*" required>
                    </div>
                </div>
                <div class="form-group row mb-0 ">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">Ganti Poto Profil</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Info Profil</h2>
            <hr>
            <form method="POST" action={{ route('users-edited') }}>
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
