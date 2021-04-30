@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>Ganti Password: </h2>
            <hr>
        </div>

            @if (Session::has('message'))
            <div class="col-md-6 offset-2 alert alert-danger d-flex justify-content-center">{{ Session::get('message') }}</div>
            @endif

        <div class="col-md-8">
            
            <form method="POST" action={{ route('PasswordUpdateCheck') }}>
                @csrf
                <div class="form-group row">
                  <label for="name" class="col-sm-3 col-form-label">Password Lama</label>
                  <div class="col-sm-9">
                    <input type="password"  class="form-control" minlength="8" maxlength="20" name="password" placeholder="Password Lama" required>
                  </div>
                </div>

                
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Password Baru</label>
                    <div class="col-sm-9">
                      <input type="password"  class="form-control" minlength="8" maxlength="20" name="n_password" placeholder="Password Baru" required>
                    </div>
                  </div>
    
                  <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Confirm Password</label>
                    <div class="col-sm-9">
                      <input type="password"  class="form-control" minlength="8" maxlength="20" name="c_password" placeholder="Confirm Password" required>
                    </div>
                  </div>

                

                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-3" >
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection