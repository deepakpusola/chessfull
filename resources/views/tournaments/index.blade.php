@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="font-size: 22px;">Live Tournaments</div>

                <div class="card-body">
                   <table class="table table-striped custom-table">
                    <thead>
                        <tr  style="background: #ccc;color: #000;font-weight: 500;font-size: 17px;">
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

         <div class="col-md-12 mt-4">
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
                        <tr  style="background: #ccc;color: #000;font-weight: 500;font-size: 17px;">
                            <th>Name</th>
                            <th>Players</th>
                            <th>Starts at</th>
                            <th>Ends at</th>
                             <th></th>
                        </tr>
                    </thead>
                  <tbody>

                   @foreach($upcoming as $tournament)
                    <tr style="background: #fff;
    color: #000;
    font-size: 22px;
    font-weight: 700;">
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

        <div class="col-md-12 mt-4">
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
                        <tr  style="background: #ccc;color: #000;font-weight: 500;font-size: 17px;">
                            <th>Name</th>
                            <th>Players</th>
                            <th>Started at</th>
                            <th>Ended at</th>
                            <th></th>
                        </tr>
                    </thead>
                  <tbody>

                   @foreach($closed as $tournament)
                    <tr style="background: #fff;
                      color: #000;
                      font-size: 22px;
                      font-weight: 700;">
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
