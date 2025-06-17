<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sms extends Model
{
    //
    protected $fillable = [
        'merchant_id',
        'sms_url',
        'sms_token',
        'sms_from',
        'created_by',
        'deleted_by',
        'updated_by',
    ];
}
