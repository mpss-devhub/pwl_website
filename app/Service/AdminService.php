<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class AdminService
{

    public function getMerchantList()
    {

        //$http_response_header = ['X-API-KEY'=>'559fc83d-7eae-4e2f-abbe-1a637cf6d817','X-APP-ID'=>'000021'];
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => '559fc83d-7eae-4e2f-abbe-1a637cf6d817',
            'X-APP-ID' => '000021',
        ])->post('https://test.octoverse.com.mm/api/externalb2b/getMerchantList', [
            "pageNo" => "1",
            "pageSize" => "10",
            "orderBy" => "DESC",
            "searchObj" => [
                "merchantID" => "",
                "merchantName" => "",
                "merchantIntegrationType" => "",
                "status" => ""
            ]
        ]);
        $merchant = $response->json(); // already returns associative array
        //dd($merchants);
        return $merchant['data'] ?? [];
    }
}
