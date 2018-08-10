@extends('layouts.app')

@section('content')

    <!-- <div class="mt-5">
        <div class="container">
            <h4 class="text-white">User Ballance : Rs. {{ auth()->user()->wallet_balance }}</h4>

            <button class="btn btn-primary" data-target="#addMoney" data-toggle="modal">Add Cash</button>

            <button class="btn btn-success" data-target="#widthdrawMoney" data-toggle="modal">Withdraw Money</button>
        </div>
    </div> -->
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 profile-hidden">
            <div class="card">
                <div class="card-body profile-card-section">
                    <nav class="nav flex-column nav-pills profile-update-section" id="nav">
                        <a class="nav-link" href="/profile" id="profile" style=""><i class="fa fa-user"></i> Profile</a>
                        <a class="nav-link" href="/change-password" style="" id="password"><i class="fa fa-key"></i> Change Password</a>
                        <a class="nav-link active" href="/wallet" style="" id="settings"><i class="fa fa-google-wallet" aria-hidden="true"></i> Wallet</a>
                        <a class="nav-link" href="/matche" id="settings"><i class="fa fa-gamepad"></i> Matches</a>
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
                    <a class="nav-link" href="/profile"><i class="fa fa-user"></i> Profile</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/change-password"><i class="fa fa-key"></i> Change Password</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="/wallet"><i class="fa fa-google-wallet" aria-hidden="true"></i> Wallet</a>
                  </li>
            </ul>
        </div>
        <div class="col-md-8 responsive-profile-tab">
            <div class="card responsive-card-profile">
                <div class="card-body profile-card-section wallet-card-section" >
                  <div class="card">
                    <div class="card-body text-center" style="background-color: #fff;color: #000;">
                        <h1 class="text-warning;"><i class="fa fa-inr"></i> {{ auth()->user()->wallet_balance }}</b></h1>
                        <h3><b>Wallet Balance</h3>
                             <div class="wallet-button">
                                <button class="btn btn-primary" data-target="#addMoney" data-toggle="modal">Add Cash</button>

                                <button class="btn btn-success" data-target="#widthdrawMoney" data-toggle="modal">Withdraw Money</button>
                            </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- Modal -->


@endsection