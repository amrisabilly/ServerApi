<?php

namespace App\Models\AplikasiCoffe;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'table_user';

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'auth_provider',
        'provider_id',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
