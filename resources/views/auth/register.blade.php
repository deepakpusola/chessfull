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
                            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                                @csrf

                                    <div class="form-register">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Enter Your Name" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif

                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter Your Email" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif

                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Enter Your Password"required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif

                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Re-Enter Your Password" required>
                                    </div>
                                    <div class="register-button-section">
                                        <button type="submit" class="btn btn-block mt-3 btn-lg text-dark">
                                            <b>{{ __('Register') }}</b>
                                        </button>
                                    </div>
                                        <p style="text-align: center;color: #fff;margin-top: 10px;"><a href="" style="color: #fff;"> By registration,you agree to our T&C</a></p>
                            </form>
                        </div>
                    </div>

    </div>
</div>
@endsection
