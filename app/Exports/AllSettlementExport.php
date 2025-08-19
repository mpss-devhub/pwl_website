<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Http;

class AllSettlementExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct()
    {
        $this->data = $this->getSettlementData();
    }

    public function array(): array
    {
        return collect($this->data)->map(function($item) {
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
        return ['Merchant ID', 'Merchant Name','Status', 'Settlement Status','Settlement Date' ,'Invoice No', 'Payment Code', 'Response','Start At', 'End At'];
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

        $data = $response['data']['dataList'];

        return $data;
    }
}
