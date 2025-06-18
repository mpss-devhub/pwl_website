<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tnx extends Model
{
    //

    protected $fillable = [
        'link_id',
        'paymentCode',
        'payment_status',
        'payment_expired_at',
        'payment_created_at',
        'tranref_no',
        'payment_logo',
        'req_amount',
        'tnx_tranref_no',
        'tnx_phonenumber',
        'cardNumber',
        'expiryMonth',
        'expiryYear',
        'secuirtyNumber',
        'bank_tranref_no',
        'txn_amount',
        'net_amount',
        'payment_user_name',
        'currencyCode',
        'trans_date_time',
        'created_by',
        'deleted_by',
        'updated_by',
        'deleted_at',

    ];


}
