<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedNote extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'note_id', 'saved_at'];

    // Relacionamento com o model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
