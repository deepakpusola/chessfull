@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 profile-hidden">
            <div class="card">
                <div class="card-body profile-card-section">
                    <nav class="nav flex-column nav-pills profile-update-section" id="nav">
                        <a class="nav-link active" href="/profile" id="profile" style=""><i class="fa fa-user"></i> Profile</a>
                        <a class="nav-link" href="/change-password" style="" id="password"><i class="fa fa-key"></i> Change Password</a>
                        <a class="nav-link" href="/wallet" style="" id="settings"><i class="fa fa-google-wallet" aria-hidden="true"></i> Wallet</a>
                        <a class="nav-link" href="/matche" style="" id="settings"><i class="fa fa-gamepad"></i> Matches</a>
                        <a class="nav-link" href="{{ route('logout') }}"   onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();" id="settings"><i class="fa fa-sign-out"></i> {{ __('Logout') }}</a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                          </form>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container-fluid responsive-profile">
            <ul class="nav nav-pills nav-fill">
                  <li class="nav-item">
                    <a class="nav-link active" href="/profile"><i class="fa fa-user"></i> Profile</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/change-password"><i class="fa fa-key"></i> Change Password</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/wallet"><i class="fa fa-google-wallet" aria-hidden="true"></i> Wallet</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/matche"><i class="fa fa-gamepad"></i> Matches</a>
                  </li>
            </ul>
        </div>
        <div class="col-md-8 responsive-profile-tab">
            <div class="card responsive-card-profile">
                <div class="card-body profile-card-section">
                    <form method="POST" action="/profile">
                        @csrf
                        <div class="form-group row">
                            <label for="Name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ auth()->user()->name ?? old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ auth()->user()->email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="rating"  class="col-md-4 col-form-label text-md-right">Rating</label>

                            <div class="col-md-6">
                                <input id="rating" value="{{ auth()->user()->rating }}" type="text" class="form-control" name="rating" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 register-button-section">
                                <button type="submit" class="btn btn-block mt-3 btn-lg text-dark">
                                            <b style="color: #fff;">Update</b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
