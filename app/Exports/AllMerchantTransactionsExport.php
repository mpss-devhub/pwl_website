<?php

namespace App\Exports;

use App\Models\Tnx;
use Maatwebsite\Excel\Concerns\FromCollection;


class AllMerchantTransactionsExport implements FromCollection
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Tnx::query();

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                    ->orWhere('tranref_no', 'like', "%{$search}%")
                    ->orWhere('tnx_tranref_no', 'like', "%{$search}%")
                    ->orWhere('payment_user_name', 'like', "%{$search}%")
                    ->orWhere('req_amount', 'like', "%{$search}%")
                    ->orWhere('tnx_phonenumber', 'like', "%{$search}%");
            });
        }

        if (!empty($this->filters['status'])) {
            $query->where('payment_status', $this->filters['status']);
        }

        if (!empty($this->filters['payment_method'])) {
            $query->where('paymentCode', $this->filters['payment_method']);
        }

        if (!empty($this->filters['start_date'])) {
            $query->where('created_at', '>=', $this->filters['start_date']);
        }

        if (!empty($this->filters['end_date'])) {
            $query->where('created_at', '<=', $this->filters['end_date']);
        }

        return $query->get();
    }
}

