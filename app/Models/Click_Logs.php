<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Click_Logs extends Model
{
    //
    protected $table = 'link_click_logs';

    protected $casts = [
        'info' => 'array',
    ];
    protected $fillable = [
        'link_id',
        'ip_address',
        'info',
    ];
}
