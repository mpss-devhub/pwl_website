<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Merchants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tnx;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SettlementController extends Controller
{
    //
    public function show()
    {
        $merchant = Merchants::where('user_id', Auth::user()->user_id)->select('merchant_id')->first();
        if (!$merchant) {
            return redirect()->back()->with('error', 'Merchant not found.');
        }
        $data = $this->getSettlementData($merchant->merchant_id);
        if (empty($data)) {
            return redirect()->back()->with('error', 'No settlement data found.');
        }
        $tnx = collect($data['data']);

        //dd( $tnx['dataList']);
        return view('Merchant.Settlement.index', compact('tnx'));
    }

    private function getSettlementData($merchant)
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
                "merchantID" => "$merchant",
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

    private function getSettlementDetails($merchant , $id)
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

    public function details($id)
    {
        $merchant = Merchants::where('user_id', Auth::user()->user_id)->select('merchant_id')->first();
        $settlement = $this->getSettlementDetails($merchant['merchant_id'],$id);
        $details = $settlement['data']['dataList'][0];
        $data = Tnx::where('tranref_no', $id)->first();
        return view('Merchant.Settlement.details', compact('data','details'));
    }
}
