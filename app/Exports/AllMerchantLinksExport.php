<?php

namespace App\Exports;

use App\Models\Links;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllMerchantLinksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Links::all();
    }
}
