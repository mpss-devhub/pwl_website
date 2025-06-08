<?php

namespace App\Models;

use App\Models\Permissions;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'user_id',
        'email',
        'password',
        'phone',
        'permission_id',
        'role',
        'email_verified_at',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',

    ];


    public function merchant() {
        return $this->hasOne(Merchants::class,'user_id');
    }

    public function Links() {
        return $this->hasMany(Links::class);
    }


    public function permission() {
      return $this->belongsTo(Permissions::class, 'permission_id');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
