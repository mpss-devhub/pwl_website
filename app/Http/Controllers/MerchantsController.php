<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Merchants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MerchantsController extends Controller
{
    public function mdr()
    {
        $id = Auth::user()->user_id;
        $merchant = Merchants::where('user_id', $id)->value('merchant_id');
        $merchant = $this->getMDR($merchant);
        $Ewallet = $merchant['data']['dataList'][0]['paymentMdrInfoList'][0]['payments'] ?? [];
        $QR = $merchant['data']['dataList'][0]['paymentMdrInfoList'][1]['payments'] ?? [];
        $Web = $merchant['data']['dataList'][0]['paymentMdrInfoList'][2]['payments'] ?? [];
        $L_C = $merchant['data']['dataList'][0]['paymentMdrInfoList'][3]['payments'] ?? [];
        $G_C = $merchant['data']['dataList'][0]['paymentMdrInfoList'][4]['payments'] ?? [];
        return view('Merchant.profile.details', compact('Ewallet', 'QR', 'Web', 'L_C', 'G_C'));
    }

    private function getMDR($merchant)
    {
         $app_id = config('services.b2b.x_app_id');
        $xAppApiKey = config('services.b2b.x_app_api_key');
        $externalUrl = config('services.b2b.external_url');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => $xAppApiKey,
            'X-APP-ID' => $app_id,
        ])->post($externalUrl, [
            "pageNo" => "1",
            "pageSize" => "10",
            "orderBy" => "DESC",
            "searchObj" => [
                "merchantID" => "$merchant",
                "merchantName" => "",
                "merchantIntegrationType" => "",
                "status" => ""
            ]
        ]);
        $merchant = $response->json();
        return $merchant ?? [];
    }
}
