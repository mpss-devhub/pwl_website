<?php

namespace App\Exports;

use App\Models\tnx;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllMerchantTransactionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tnx::all();
    }
}
