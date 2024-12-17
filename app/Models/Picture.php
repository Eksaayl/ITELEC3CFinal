<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Picture extends Model
{
    use HasFactory;

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'user_id',
    ];

    /**
     * Define a relationship with the `User` model.
     * A picture belongs to a specific user (uploader).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define a relationship with the `Comment` model.
     * A picture can have multiple comments.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);

    }
}
