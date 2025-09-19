<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllSettlementExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct($data = [])
    {
        $this->data = $data;
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
}
