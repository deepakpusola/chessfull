@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body profile-card-section">
                    <nav class="nav flex-column nav-pills profile-update-section" id="nav">
                        <a class="nav-link" href="/profile" id="profile" style=""><i class="fa fa-user"></i> Profile</a>
                        <a class="nav-link active" href="/change_password" style="" id="password"><i class="fa fa-key"></i> Change Password</a>
                        <a class="nav-link" href="/wallet" style="" id="settings"><i class="fa fa-google-wallet" aria-hidden="true"></i> Wallet</a>
                        <a class="nav-link" href="matche" style="" id="settings"><i class="fa fa-gamepad"></i> Matches</a>
                        <a class="nav-link" href="{{ route('logout') }}"   onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();" id="settings"><i class="fa fa-sign-out"></i> {{ __('Logout') }}</a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                          </form>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body profile-card-section">
                    <form method="POST" action="/password">
                        @csrf
                        <div class="form-group row">
                            <label for="old_password" class="col-md-4 col-form-label text-md-right">Old Password</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control" name="old_password" placeholder="Enter old password" autocomplete="true" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right">New Password</label>

                            <div class="col-md-6">
                               <input id="new_password" type="password" class="form-control" name="password" placeholder="Enter new password" autocomplete="true" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="confirm_password" type="password" class="form-control" name="password_confirmation" placeholder="Enter Confirm password" autocomplete="true" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 register-button-section">
                                <button type="submit" class="btn btn-block mt-3 btn-lg text-dark">
                                            <b style="color: #fff;">Change Password</b>
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
