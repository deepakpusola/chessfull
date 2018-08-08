@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 profile-hidden">
            <div class="card">
                <div class="card-body profile-card-section">
                    <nav class="nav flex-column nav-pills profile-update-section" id="nav">
                        <a class="nav-link" href="/profile" id="profile" style=""><i class="fa fa-user"></i> Profile</a>
                        <a class="nav-link" href="/change-password" style="" id="password"><i class="fa fa-key"></i> Change Password</a>
                        <a class="nav-link" href="/wallet" style="" id="settings"><i class="fa fa-google-wallet" aria-hidden="true"></i> Wallet</a>
                        <a class="nav-link active" href="/matche" style="" id="settings"><i class="fa fa-gamepad"></i> Matches</a>
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
                    <a class="nav-link" href="/wallet"><i class="fa fa-google-wallet" aria-hidden="true"></i> Wallet</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="/matche"><i class="fa fa-gamepad"></i> Matches</a>
                  </li>
            </ul>
        </div>
        <div class="col-md-8">
            <div class="card responsive-card-profile">
                <div class="card-body profile-card-section profile-matches-tab">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Games Played</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Games Won</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Games Lost</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                          <table class="table my-account-setting" style="margin-top: 10px;">
                                <thead>
                                    <tr style="background-color: #ccc;color: #000000;">
                                        <th>#</th>
                                        <th>Players</th>
                                        <th>Winner</th>
                                        <th>Rank</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                                <tbody style="overflow-y: scroll;height: 30px;">
                                    <tr>
                                        <td><b>1</b></td>
                                        <td><b>Akshara Jadhav  vs  Ankita Bhavsar</b></td>
                                        <td><b>Akshara Jadhav</b></td>
                                        <td>1</td>
                                        <td>10.50</td>
                                    </tr>
                                    <tr>
                                        <td><b>2</b></td>
                                        <td><b>Akshara Jadhav  vs  Ankita Bhavsar</b></td>
                                        <td><b>Ankita Bhavsar</b></td>
                                        <td>5</td>
                                        <td>10.50</td>
                                    </tr>
                                    <tr>
                                        <td><b>3</b></td>
                                        <td><b>Akshara Jadhav  vs  Ankita Bhavsar</b></td>
                                        <td><b>Akshara Jadhav</b></td>
                                        <td>4</td>
                                        <td>10.50</td>
                                    </tr>

                                </tbody>
                            </table>
                      </div>
                      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                          <table class="table my-account-setting" style="margin-top: 10px;">
                                <thead>
                                    <tr style="background-color: #ccc;color: #000000;">
                                        <th>#</th>
                                        <th>Players</th>
                                        <th>Won</th>
                                        <th>Rank</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                                <tbody style="overflow-y: scroll;height: 30px;">
                                    <tr>
                                        <td><b>1</b></td>
                                        <td><b>Akshara Jadhav  vs  Ankita Bhavsar</b></td>
                                        <td><b>Akshara Jadhav</b></td>
                                        <td>1</td>
                                        <td>10.50</td>
                                    </tr>
                                    <tr>
                                        <td><b>2</b></td>
                                        <td><b>Akshara Jadhav  vs  Ankita Bhavsar</b></td>
                                        <td><b>Ankita Bhavsar</b></td>
                                        <td>5</td>
                                        <td>10.50</td>
                                    </tr>
                                    <tr>
                                        <td><b>3</b></td>
                                        <td><b>Akshara Jadhav  vs  Ankita Bhavsar</b></td>
                                        <td><b>Akshara Jadhav</b></td>
                                        <td>4</td>
                                        <td>10.50</td>
                                    </tr>

                                </tbody>
                            </table>
                      </div>
                      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                          <table class="table my-account-setting" style="margin-top: 10px;">
                                <thead>
                                    <tr style="background-color: #ccc;color: #000000;">
                                        <th>#</th>
                                        <th>Players</th>
                                        <th>Rank</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                                <tbody style="overflow-y: scroll;height: 30px;">
                                    <tr>
                                        <td><b>1</b></td>
                                        <td><b>Akshara Jadhav  vs  Ankita Bhavsar</b></td>
                                        <td>1</td>
                                        <td>10.50</td>
                                    </tr>
                                    <tr>
                                        <td><b>2</b></td>
                                        <td><b>Akshara Jadhav  vs  Ankita Bhavsar</b></td>
                                        <td>5</td>
                                        <td>10.50</td>
                                    </tr>
                                    <tr>
                                        <td><b>3</b></td>
                                        <td><b>Akshara Jadhav  vs  Ankita Bhavsar</b></td>
                                        <td>4</td>
                                        <td>10.50</td>
                                    </tr>

                                </tbody>
                            </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
