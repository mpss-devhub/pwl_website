<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    //
    protected $fillable = [
        'user_id',
        'merchant_id',
        'link_name',
        'link_amount',
        'link_description',
        'link_invoiceNo',
        'link_phone',
        'link_currency',
        'link_email',
        'link_type',
        'link_url',
        'link_status',
        'link_expiry_date',
        'link_created_at',
        'link_updated_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


}
