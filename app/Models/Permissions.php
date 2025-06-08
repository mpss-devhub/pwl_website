<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    //
    protected $fillable = ['user_group','permission','allowed'];

    public function users() {
      return $this->hasMany(User::class, 'permission_id');
    }

}
