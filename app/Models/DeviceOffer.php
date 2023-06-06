<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceOffer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'serlab.device_offer';

    protected $hidden = [
      'created_at',
      'updated_at'
    ];
    
}
