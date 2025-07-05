<?php

namespace App\Exports;

use App\Models\Tnx;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MerchantTnxExport implements FromCollection ,WithHeadings

{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $created_by;

    public function __construct($created_by)
    {
        //dd($created_by);
        $this->created_by = $created_by;
    }
    public function collection()
    {
        //dd($this->created_by['merchant_id']);
        return Tnx::where('created_by',$this->created_by['merchant_id'])->select(
            'id',
            'tranref_no',
            'payment_user_name',
            'tnx_phonenumber',
            'currencyCode',
            'paymentCode',
            'payment_status',
            'req_amount',
            'txn_amount',
            'net_amount',
            'payment_expired_at',
            'payment_created_at',
            'tnx_tranref_no',
            'bank_tranref_no',
            'trans_date_time',
            'cardNumber',
            'expiryMonth',
            'expiryYear',
            'created_by',
            'created_at'
        )->get();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Invonic',
            'Name',
            'Tnx Phone Number',
            'Currency',
            'Pay With',
            'Status',
            'Req Amount',
            'Txn Amount',
            'Net Amount',
            'Expired At',
            'Created At',
            'Tnx Transfer Number',
            'Bank Transfer Number',
            'Bank Transfer Date Time',
            'cardNumber',
            'expiryMonth',
            'expiryYear',
            'created_by',
            'created_at'
        ];
    }
}
