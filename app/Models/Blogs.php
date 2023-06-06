<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Comments;

class Blogs extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'serlab.blogs';

    public function comments()
    {
      return $this->hasMany(Comments::class, 'blog_id', 'id');
    }

}
