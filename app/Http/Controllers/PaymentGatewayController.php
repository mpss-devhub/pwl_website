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

    public function Auth(Request $request)
    {
        $data = $this->paymentService->show($request->all());
        $link_data = $this->paymentService->link($request->all());
        $link = $link_data['link'] ?? null;
        $merchant = $link_data['merchant'] ?? null;
        $Ewallet = $data[0]['payments'] ?? null;
        $QR = $data[1]['payments'] ?? null;
        $Web = $data[2]['payments'] ?? null;
        $L_C = $data[3]['payments'] ?? null;
        $G_C = $data[4]['payments'] ?? null;
        return view('checkout.paymentlist', compact('link', 'merchant', 'Ewallet', 'QR', 'Web', 'L_C', 'G_C'));
    }

    public function Pwl(Request $request)
    {
        $data = $this->paymentService->Auth($request->all());
         $this->paymentService->store($request->all());
        $link_data = $this->paymentService->link($request->all());
        $link = $link_data['link'] ?? null;
        $merchant = $link_data['merchant'] ?? null;
        return view('checkout.pay', compact('data', 'link', 'merchant'));
    }

    public function paymentBackendCallback(Request $request,$user_id)
    {
        $this->paymentService->backendCallback($request->all(),$user_id);
        return response()->json(['status' => 'success', 'message' => 'Payment processed successfully']);
    }
}
