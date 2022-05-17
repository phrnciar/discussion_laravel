<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'name', 'message'];

    
    /**
     * Relationship: comments has many replies
     *
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
