<?php

namespace App\Models;

use App\Models\Links;
use Illuminate\Database\Eloquent\Model;

class Merchants extends Model
{
    //

    protected $fillable = [
        'status',
        'merchant_id',
        'user_id',
        'merchant_datakey',
        'merchant_secretkey',
        'merchant_name',
        'merchant_Cname',
        'merchant_Cphone',
        'merchant_Cemail',
        'merchant_frontendURL',
        'merchant_backendURL',
        'merchant_address',
        'merchant_notifyemail',
        'merchant_remark',
        'merchant_logo',
        'merchant_registration',
        'merchant_shareholder',
        'merchant_dica',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
