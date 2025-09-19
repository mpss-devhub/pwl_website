<?php

namespace App\Exports;

use App\Models\Tnx;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MerchantTnxExport implements FromCollection, WithHeadings
{
    protected $created_by;
    protected $filters;

    public function __construct($created_by, $filters = [])
    {
        $this->created_by = $created_by;
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Tnx::where('created_by', $this->created_by['merchant_id'])
            ->select(
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
            );


        if (!empty($this->filters['start_date'])) {
            $query->where('created_at', '>=', $this->filters['start_date']);
        }

        if (!empty($this->filters['end_date'])) {
            $query->where('created_at', '<=', $this->filters['end_date']);
        }

        if (!empty($this->filters['payment_method'])) {
            $query->where('paymentCode', $this->filters['payment_method']);
        }

        if (!empty($this->filters['status'])) {
            $query->where('payment_status', $this->filters['status']);
        }

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('tranref_no', 'like', "%$search%")
                  ->orWhere('payment_user_name', 'like', "%$search%")
                  ->orWhere('tnx_phonenumber', 'like', "%$search%");
            });
        }

        return $query->get();
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
            'Card Number',
            'Expiry Month',
            'Expiry Year',
            'Created By',
            'Created At'
        ];
    }
}
