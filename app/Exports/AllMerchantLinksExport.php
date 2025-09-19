<?php

namespace App\Exports;

use App\Models\Links;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllMerchantLinksExport implements FromCollection
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Links::query()
            ->whereNotIn('id', function ($q) {
                $q->select('link_id')->from('tnxes');
            });

        if (!empty($this->filters['start_date'])) {
            $query->where('created_at', '>=', $this->filters['start_date']);
        }

        if (!empty($this->filters['end_date'])) {
            $query->where('created_at', '<=', $this->filters['end_date']);
        }

        if (!empty($this->filters['notification_type'])) {
            $query->where('link_type', $this->filters['notification_type']);
        }

        if (!empty($this->filters['status'])) {
            $query->where('link_status', $this->filters['status']);
        }

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('link_invoiceNo', 'like', "%{$search}%")
                  ->orWhere('link_name', 'like', "%{$search}%")
                  ->orWhere('link_amount', 'like', "%{$search}%");
            });
        }

        return $query->latest()->get();
    }
}
