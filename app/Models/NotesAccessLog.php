<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotesAccessLog extends Model
{
    // Permite a atribuição em massa para os campos especificados (nao sei bem o porque de ser preciso )
    protected $fillable = ['user_id', 'note_id', 'created_at'];

    //* Relação entre NotesAccessLog e Note
    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
