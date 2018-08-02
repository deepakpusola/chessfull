@extends('layouts.app')

@section('content')

    <div class="mt-5">
        <div class="container">
            <h4 class="text-white">User Ballance : Rs. {{ auth()->user()->wallet_balance }}</h4>

            <button class="btn btn-primary" data-target="#addMoney" data-toggle="modal">Add Cash</button>

            <button class="btn btn-success" data-target="#widthdrawMoney" data-toggle="modal">Withdraw Money</button>
        </div>
    </div>



    <!-- Modal -->


@endsection