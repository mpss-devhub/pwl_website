<?php

namespace App\Http\Controllers;

use App\Service\PaymentService;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    //
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function Auth(Request $request){
        $this->paymentService->Auth($request->all());
        dd($data);

        return view('checkout.paymentlist');

    }
}
