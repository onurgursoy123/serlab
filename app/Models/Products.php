<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Comments;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'serlab.products';

    public function comments()
    {
      return $this->hasMany(Comments::class, 'product_id', 'id');
    }

    public function same_products()
    {
      return $this->hasMany($this, 'parent_id', 'parent_id')->limit(4);
    }

}
