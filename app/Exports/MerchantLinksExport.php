<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Links;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MerchantLinksExport implements FromCollection, WithHeadings
{
    protected $filters;
    protected $merchant_id;

    public function __construct($created_by, $filters = [])
    {
        $this->merchant_id = $created_by['merchant_id'] ?? null;
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Links::where('created_by', $this->merchant_id)
                      ->whereNotIn('id', function ($q) {
                          $q->select('link_id')->from('tnxes');
                      });

        if (!empty($this->filters['start-date'])) {
            $start = Carbon::parse($this->filters['start-date'])->startOfDay();
            $query->where('created_at', '>=', $start);
        }

        if (!empty($this->filters['end-date'])) {
            $end = Carbon::parse($this->filters['end-date'])->endOfDay();
            $query->where('created_at', '<=', $end);
        }

        if (!empty($this->filters['status'])) {
            $query->where('link_status', $this->filters['status']);
        }

        if (!empty($this->filters['notification-type'])) {
            $query->where('link_type', $this->filters['notification-type']);
        }

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('link_invoiceNo', 'like', "%$search%")
                  ->orWhere('link_name', 'like', "%$search%")
                  ->orWhere('link_phone', 'like', "%$search%");
            });
        }

        return $query->select(
            'id',
            'link_invoiceNo',
            'link_name',
            'link_phone',
            'link_currency',
            'link_email',
            'link_description',
            'link_type',
            'link_url',
            'link_amount',
            'link_click_status',
            'link_expired_at',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Invoice No',
            'Name',
            'Customer Number',
            'Currency',
            'Email',
            'Description',
            'Sent With',
            'Payment Link',
            'Amount',
            'Click Status',
            'Expired At',
            'Created At',
        ];
    }
}
