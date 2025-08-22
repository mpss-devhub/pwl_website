<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tnx;
use App\Models\Merchants;
use Illuminate\Http\Request;
use App\Exports\AllSettlementExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class SettlementController extends Controller
{
    //

    public function show()
    {
        $data = $this->getSettlementData();
        $tnx = collect($data['data']);
        $tnxs = collect($data['data']['dataList']);
        $paymentCodes = $tnxs->pluck('paymentCode')->unique();
        //dd($paymentCodes);
        return view('Admin.Settlement.index', compact('data','paymentCodes'));
    }


    private function getSettlementData()
    {
        $app_id = config('services.b2b.x_app_id');
        $xAppApiKey = config('services.b2b.x_app_api_key');
        $externalUrl = config('services.b2b.external_url_2');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => $xAppApiKey,
            'X-APP-ID' => $app_id,
        ])->post($externalUrl, [
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

    public function details($merchant, $id)
    {
        $settlement = $this->getSettlementDetails($merchant, $id);
        $details = $settlement['data']['dataList'][0];

        $data = Tnx::where('tranref_no', $details['merchantInvoiceNo'])->first();
        if (!$data) {
            abort(404, 'Transaction not found');
        }
        return view('Admin.Settlement.details', compact('data', 'details'));
    }

    public function export()
    {
        return Excel::download(new AllSettlementExport, 'settlement_data_' . now()->format('Y-m-d_H-i-s') . '.xlsx');
    }

    public function exportCsv()
    {
        return Excel::download(new AllSettlementExport, 'settlement_data_' . now()->format('Y-m-d_H-i-s') . '.csv');
    }
}
