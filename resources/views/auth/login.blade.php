@extends('layouts.login-app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="logreg-forms" id="customForm">
                <form class="form-signin" method="POST" action="{{ route('login') }}">
                    <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>
                    @csrf
                    <div class="input-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
            
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            
                    <div class="input-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
            
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <input class="form-check-input" type="checkbox" name="remember" checked hidden>
                    <div class="input-group">
                      <button class="btn btn-md btn-rounded btn-block form-control submit" type="submit"><i class="fas fa-sign-in-alt"></i> Sign in</button>
                    </div>
            
                    <a href="#" id="forgot_pswd">Forgot password?</a>
                    <hr>
                    <!-- <p>Don't have an account!</p>  -->
                    <button class="btn btn-primary btn-block" onclick="window.location.href='#signup'" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button>
                    </form>
            
                    <form method="POST" action="{{ route('password.email') }}" class="form-reset" id="signup">
                        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Forget Passowrd</h1>
                        @csrf
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
    
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                        <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
                    </form>
            
                    <form method="POST" action="{{ route('register') }}" class="form-signup">
                        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign Up</h1>
                        @csrf
                        <div class="input-group mb-1">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                        <div class="input-group mb-1">
                            <select class="form-control" id="role" name="role">
                                <option value="1">Student</option>
                                <option value="2">Teacher</option>
                                <option value="3">Alumni</option>
                            </select>
    
                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-1">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                        <div class="input-group mb-1">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                        <div class="input-group mb-1">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>
                        
                        <div class="input-group">
                        <button class="btn btn-md btn-block submit" type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
                        </div>
            
                        <a href="#" id="cancel_signup"><i class="fa fa-angle-left"></i> Back</a>
                    </form>
                    <br>
            
                    <script>
                        function toggleResetPswd(e){
                            e.preventDefault();
                            $('#customForm .form-signin').toggle() // display:block or none
                            $('#customForm .form-reset').toggle() // display:block or none
                        }
            
                        function toggleSignUp(e){
                            e.preventDefault();
                            $('#customForm .form-signin').toggle(); // display:block or none
                            $('#customForm .form-signup').toggle(); // display:block or none
                        }
            
                        $(()=>{
                            // Login Register Form
                            $('#customForm #forgot_pswd').click(toggleResetPswd);
                            $('#customForm #cancel_reset').click(toggleResetPswd);
                            $('#customForm #btn-signup').click(toggleSignUp);
                            $('#customForm #cancel_signup').click(toggleSignUp);
                        })

                        $(document).ready(function() {
                            if (window.location.href.indexOf("signup") > -1) {
                                $('#customForm .form-signin').toggle(); // display:block or none
                                $('#customForm .form-signup').toggle(); // display:block or none
                            }
                        });
                    </script>
            </div>
        </div>
        <a href="{{ route('welcome') }}" class="backHome" > Home </a>
    </div>
</div>


@endsection
