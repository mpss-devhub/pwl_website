<?php

namespace App\Exports;

use App\Models\Links;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MerchantLinksExport implements FromCollection, WithHeadings
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
        return Links::where('created_by',$this->created_by['merchant_id'])->select(
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
            'created_at',
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Invonic',
            'Name',
            'Cus Number',
            'Currency',
            'Email',
            'Description',
            'Sent With',
            'Payment Link',
            'Amount',
            'Click_Status',
            'Expired At',
            'Created At',
        ];
    }
}
