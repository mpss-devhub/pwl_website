<?php

namespace App\Exports;

use App\Models\Merchants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MerchantSettlementExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct()
    {
        $this->data = $this->getSettlementData();
    }

    public function array(): array
    {
        return collect($this->data)->map(function ($item) {
            return [
                $item['merchantID'] ?? '',
                $item['merchantName'] ?? '',
                $item['status'] ?? '',
                $item['settlementStatus'] ?? '',
                $item['settlementDate'] ?? '',
                $item['merchantInvoiceNo'] ?? '',
                $item['paymentCode'] ?? '',
                $item['responseMsg'] ?? '',
                $item['transactionStart'] ?? '',
                $item['transactionEnd'] ?? ''
            ];
        })->toArray();
    }

    public function headings(): array
    {
        return ['Merchant ID', 'Merchant Name', 'Status', 'Settlement Status', 'Settlement Date', 'Invoice No', 'Payment Code', 'Response', 'Start At', 'End At'];
    }

    private function getSettlementData()
    {
        $id = Auth::user()->user_id;
        $merchant = Merchants::where('user_id', $id)->select('merchant_id')->first();
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
                "merchantID" => $merchant['merchant_id'],
                "status" => "",
                "settlementStatus" => "",
                "invoiceNo" => "",
                "paymentCode" => "",
                "fromDate" => "",
                "toDate" => ""
            ]
        ]);

        $data = $response['data']['dataList'];

        return $data;
    }
}
