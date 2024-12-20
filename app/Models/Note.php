<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    // Define os campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'user_id', 
        'title', 
        'subject', 
        'topic_difficulty', 
        'content', 
        'file_path',
    ];

    // Relacionamento com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
