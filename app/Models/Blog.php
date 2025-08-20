<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = ['name', 'description'];

    // One blog has many posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
