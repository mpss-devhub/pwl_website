<?php

namespace App\Exports;

use App\Models\Tnx;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllMerchantTransactionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tnx::all();
    }
}
