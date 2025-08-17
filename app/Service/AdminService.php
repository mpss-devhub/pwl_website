<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class AdminService
{

    public function getMerchantList($merchant)
    {

        //$http_response_header = ['X-API-KEY'=>'559fc83d-7eae-4e2f-abbe-1a637cf6d817','X-APP-ID'=>'000021'];
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
