<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Tnx;
use App\Models\Merchants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MerchantSettlementExport;

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
        $tnxs = collect($data['data']['dataList']);
        $paymentCodes = $tnxs->pluck('paymentCode')->unique();
        //dd($paymentCodes);
        return view('Merchant.Settlement.index', compact('tnx','paymentCodes'));
    }

    private function getSettlementData($merchant)
    {
        $app_id = config('services.b2b.x_app_id');
        $xAppApiKey = config('services.b2b.x_app_api_key');
        $externalUrl2 = config('services.b2b.external_url_2');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => $xAppApiKey,
            'X-APP-ID' => $app_id,
        ])->post($externalUrl2, [
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

    private function getSettlementDetails($merchant, $id)
    {
        $app_id = config('services.b2b.x_app_id');
        $xAppApiKey = config('services.b2b.x_app_api_key');
        $externalUrl2 = config('services.b2b.external_url_2');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => $xAppApiKey,
            'X-APP-ID' => $app_id,
        ])->post($externalUrl2, [
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
        $settlement = $this->getSettlementDetails($merchant['merchant_id'], $id);
        $details = $settlement['data']['dataList'][0];
        $data = Tnx::where('tranref_no', $id)->first();
        return view('Merchant.Settlement.details', compact('data', 'details'));
    }

    public function export()
    {
        return Excel::download(new MerchantSettlementExport,'Settlement_data_' . now()->format('Y-m-d_H-i-s') . '.csv');
    }

    public function csvExport()
    {
        return Excel::download(new MerchantSettlementExport,'Settlement_data_' . now()->format('Y-m-d_H-i-s') . '.xlsx');
    }
}
