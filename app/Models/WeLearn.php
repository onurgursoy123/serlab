<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Comments;

class WeLearn extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'serlab.we_learn';

    public function comments()
    {
      return $this->hasMany(Comments::class, 'weLearn_id', 'id');
    }

}
