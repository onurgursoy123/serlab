<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Products;

class Pages extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $hidden = [
      'created_at',
      'updated_at'
    ];

    public function products()
    {
      return $this->hasMany(Products::class, 'pages_id', 'id');
    }
    
}
