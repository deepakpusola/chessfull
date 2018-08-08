@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="container-fluid responsive-profile">
        <div class="card-body profile-card-section profile-matches-tab">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"> Open</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"> Upcoming</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"> Closed</a>
                  </li>
            </ul>
        </div>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="col-md-12 responsive-tournamet-section">
                <div class="card">
                    <div class="card-header" style="font-size: 22px;">Live Tournaments</div>

                    <div class="card-body">
                       <table class="table table-striped custom-table">
                        <thead>
                            <tr  style="">
                                <th>Name</th>
                                <th>Players</th>
                                <th>Started at</th>
                                 <th>Ends at</th>
                                 <th></th>
                            </tr>
                        </thead>
                      <tbody>
                       @foreach($live as $tournament)
                        <tr>
                          <td><a href="/tournaments/{{$tournament->id}}" style="color: #000;">{{ $tournament->name }}</a></td>
                           <td>{{ count($tournament->players) }}</td>
                            <td>{{ $tournament->starttime }}</td>
                            <td>{{ $tournament->endtime }}</td>
                            <td><a href="/tournaments/{{$tournament->id}}" class="btn btn-primary">View</a></td>
                        </tr>
                       @endforeach
                      </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
           <div class="col-md-12 responsive-tournamet-section">
              <div class="card">
                  <div class="card-header" style="font-size: 22px;">Upcoming Tournaments</div>

                  <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif


                      <table class="table table-striped custom-table">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Players</th>
                              <th>Starts at</th>
                              <th>Ends at</th>
                               <th></th>
                          </tr>
                      </thead>
                    <tbody>

                     @foreach($upcoming as $tournament)
                      <tr>
                        <td><a href="/tournaments/{{$tournament->id}}" style="color: #000;">{{ $tournament->name }}</a></td>
                         <td>{{ count($tournament->players) }}</td>
                          <td>{{ $tournament->starttime }}</td>
                          <td>{{ $tournament->endtime }}</td>
                          <td><a href="/tournaments/{{$tournament->id}}" class="btn btn-primary">View</a></td>
                      </tr>
                     @endforeach
                    </tbody>
                  </table>


                  </div>
              </div>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
          <div class="col-md-12 responsive-tournamet-section">
              <div class="card">
                  <div class="card-header" style="font-size: 22px;">Closed Tournaments</div>

                  <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif


                      <table class="table table-striped custom-table">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Players</th>
                              <th>Started at</th>
                              <th>Ended at</th>
                              <th></th>
                          </tr>
                      </thead>
                    <tbody>

                     @foreach($closed as $tournament)
                      <tr>
                        <td><a href="/tournaments/{{$tournament->id}}" style="color: #000;">{{ $tournament->name }}</a></td>
                         <td>{{ count($tournament->players) }}</td>
                          <td>{{ $tournament->starttime }}</td>
                          <td>{{ $tournament->endtime }}</td>
                          <td><a href="/tournaments/{{$tournament->id}}" class="btn btn-primary">View</a></td>
                      </tr>
                     @endforeach
                    </tbody>
                  </table>

                </div>
                  </div>
              </div>
          </div>
        </div>
        </div>
    </div>

        <div class="col-md-12 tournamet-desktop-view">
            <div class="card">
                <div class="card-header" style="font-size: 22px;">Live Tournaments</div>

                <div class="card-body">
                   <table class="table table-striped custom-table">
                    <thead>
                        <tr  style="">
                            <th>Name</th>
                            <th>Players</th>
                            <th>Started at</th>
                             <th>Ends at</th>
                             <th></th>
                        </tr>
                    </thead>
                  <tbody>
                   @foreach($live as $tournament)
                    <tr>
                      <td><a href="/tournaments/{{$tournament->id}}" style="color: #000;">{{ $tournament->name }}</a></td>
                       <td>{{ count($tournament->players) }}</td>
                        <td>{{ $tournament->starttime }}</td>
                        <td>{{ $tournament->endtime }}</td>
                        <td><a href="/tournaments/{{$tournament->id}}" class="btn btn-primary">View</a></td>
                    </tr>
                   @endforeach
                  </tbody>
                </table>

                </div>
            </div>
        </div>

         <div class="col-md-12 mt-4 tournamet-desktop-view">
            <div class="card">
                <div class="card-header" style="font-size: 22px;">Upcoming Tournaments</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Players</th>
                            <th>Starts at</th>
                            <th>Ends at</th>
                             <th></th>
                        </tr>
                    </thead>
                  <tbody>

                   @foreach($upcoming as $tournament)
                    <tr>
                      <td><a href="/tournaments/{{$tournament->id}}" style="color: #000;">{{ $tournament->name }}</a></td>
                       <td>{{ count($tournament->players) }}</td>
                        <td>{{ $tournament->starttime }}</td>
                        <td>{{ $tournament->endtime }}</td>
                        <td><a href="/tournaments/{{$tournament->id}}" class="btn btn-primary">View</a></td>
                    </tr>
                   @endforeach
                  </tbody>
                </table>


                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4 tournamet-desktop-view">
            <div class="card">
                <div class="card-header" style="font-size: 22px;">Closed Tournaments</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Players</th>
                            <th>Started at</th>
                            <th>Ended at</th>
                            <th></th>
                        </tr>
                    </thead>
                  <tbody>

                   @foreach($closed as $tournament)
                    <tr>
                      <td><a href="/tournaments/{{$tournament->id}}" style="color: #000;">{{ $tournament->name }}</a></td>
                       <td>{{ count($tournament->players) }}</td>
                        <td>{{ $tournament->starttime }}</td>
                        <td>{{ $tournament->endtime }}</td>
                        <td><a href="/tournaments/{{$tournament->id}}" class="btn btn-primary">View</a></td>
                    </tr>
                   @endforeach
                  </tbody>
                </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
