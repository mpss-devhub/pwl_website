<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class announcement extends Model
{
    //
    protected $fillable = [
        'title',
        'letter',
        'content',
        'merchant_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
