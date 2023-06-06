<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'token_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /*
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    */
}
