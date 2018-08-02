<?php

namespace App\Models;

use App\User;
use Softon\Indipay\Facades\Indipay;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $parameters;

    protected $order;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function build($amount)
    {
         $tid = rand(10000, 99999);
         $orderId = static::count() + 1;

         $this->user_id = auth()->id();
         $this->transaction_id = $tid;
         $this->amount = $amount;

         $this->parameters = [
            'tid' => $tid,
            'order_id' => $orderId,
            'amount' => $amount,
            'purpose' => 'Add Wallet Ballance',
            'buyer_name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => '9922367414',
          ];
    }

    public function prepare()
    {
        $this->order = Indipay::prepare($this->parameters);
    }

    public function process()
    {
        $this->save();
        return Indipay::process($this->order);
    }
}
