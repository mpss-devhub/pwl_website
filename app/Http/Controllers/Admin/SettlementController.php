<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tnx;
use App\Models\Merchants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SettlementController extends Controller
{
    //

    public function show(){
        $data = $this->getSettlementData();

        return view('Admin.Settlement.index',compact('data'));
    }


    private function getSettlementData()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => '559fc83d-7eae-4e2f-abbe-1a637cf6d817',
            'X-APP-ID' => '000021',
        ])->post('https://test.octoverse.com.mm/api/externalb2b/getMerchantTransactions', [
            "pageNo" => "",
            "pageSize" => "",
            "orderBy" => "DESC",
            "searchObj" => [
                "merchantID" => "",
                "status" => "",
                "settlementStatus" => "",
                "invoiceNo" => "",
                "paymentCode" => "",
                "fromDate" => "",
                "toDate" => ""
            ]
        ]);
        $merchant = $response->json();
        return $merchant ?? [];
    }

     private function getSettlementDetails($merchant,$id)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => '559fc83d-7eae-4e2f-abbe-1a637cf6d817',
            'X-APP-ID' => '000021',
        ])->post('https://test.octoverse.com.mm/api/externalb2b/getMerchantTransactions', [
            "pageNo" => "1",
            "pageSize" => "1",
            "orderBy" => "DESC",
            "searchObj" => [
                "merchantID" => "$merchant",
                "status" => "",
                "settlementStatus" => "",
                "invoiceNo" => "$id",
                "paymentCode" => "",
                "fromDate" => "",
                "toDate" => ""
            ]
        ]);
        $merchant = $response->json();
        return $merchant ?? [];
    }

    public function details($merchant,$id)
    {
        $settlement = $this->getSettlementDetails($merchant,$id);
        $details = $settlement['data']['dataList'][0];

        $data = Tnx::where('tranref_no', $details['merchantInvoiceNo'])->first();
        if(!$data){
            abort(404, 'Transaction not found');
        }
        return view('Admin.Settlement.details', compact('data','details'));
    }
}
