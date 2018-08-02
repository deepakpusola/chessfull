<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;

class WalletController extends Controller
{

    public function index()
    {
        return view('profile.wallet');
    }

    public function add()
    {
         $payment = new Payment;

         $payment->build(request('amount'));

         $payment->prepare();

         return $payment->process();

    }

    public function response(Request $request)

    {
        // For default Gateway
        $response = Indipay::response($request);

        if($response->success)
        {
            auth()->user()->wallet_balance +=  $response->payment_request->amount;
            auth()->user()->save();
            // show success message
        } else {
            // show falied message
        }

        return redirect('profile/wallet');

    }
}
