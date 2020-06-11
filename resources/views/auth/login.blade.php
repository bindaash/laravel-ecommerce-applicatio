@extends('site.app')
@section('title', 'Login')
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Login</h2>
        </div>
    </section>
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Sign In</h4>
                    </header>
                    <article class="card-body">
                        <form action="{{ route('login') }}" method="POST" role="form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" name="email" id="email" value="{{ old('email') }}">
                                @foreach ($errors->get('email') as $message)
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @endforeach        
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" name="password" id="password">
                                @foreach ($errors->get('password') as $message)
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @endforeach
                            </div>
                            <div class="form-group row mr-auto">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"> Login </button>
                            </div>
                        </form>
                        <h2 style="text-align:center">or</h2>
                        <p style="text-align:center"><strong>Login with Social Media</strong></p>
                    </article>
                    <div class="border-top card-body text-center">
                        <a href="redirect/facebook" class="fb btn">
                        <i class="fa fa-facebook fa-fw"></i> Login with Facebook
                        </a>
                        <a href="#" class="twitter btn">
                        <i class="fa fa-twitter fa-fw"></i> Login with Twitter
                        </a>
                        <a href="#" class="google btn"><i class="fa fa-google fa-fw">
                        </i> Login with Google+
                        </a>
                    </div>
                    <div class="border-top card-body text-center">Don't have an account? 
                        <a href="{{ url('register') }}">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop