@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
         <div class="col-md-6">
            <div class="card-body card-register-content">
                <img src="/img/rupee.png">
                <h2>Cash bonus inside</h2>
                <h3>The Best Chess Experience</h3>
                <div class="register-content">
                    <img src="/img/chess.png">
                    <h2>Play chess on mobile</h2>
                </div>
                 <div class="register-content">
                    <img src="/img/coins.png">
                    <h2>Win cash prizes instantly</h2>
                </div>
                 <div class="register-content">
                    <img src="/img/friendship.png">
                    <h2>Invite friends.Get cash bonus</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
                        <div class="">

                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                    @csrf
                                            <div class="form-register">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif

                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif

                                            <div class="checkbox" style="margin-top: 12px;">
                                                <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>

                                    <div class="form-group mb-0">
                                        <div class="register-button-section">
                                            <button type="submit" class="btn btn-block mt-3 btn-lg text-dark">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                            <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #fff;">
                                                {{ __('Forgot Your Password?') }}
                                            </a>

                                    </div>
                                </form>
                            </div>
            </div>
        </div>
    </div>
</div>
@endsection
