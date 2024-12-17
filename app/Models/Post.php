<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'art_type',
        'title',
        'description',
    ];


    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}

   

// $table->id();
// $table->string('name');
// $table->integer('age');
// $table->string('title');
// $table->string('description');
// $table->string('date_published');
// $table->string('email')->unique();
