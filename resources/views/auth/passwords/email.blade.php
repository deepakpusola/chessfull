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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="text-white">{{ __('Reset Password') }}</h3>
                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <div class="form-register">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter Your Email" style="border-bottom: none;" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                                <button type="submit" class="btn btn-block btn-primary mt-3 btn-lg text-dark">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                    </form>
                </div>
            </div>
        </div>

</div>
@endsection
