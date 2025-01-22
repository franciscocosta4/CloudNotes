<?php

namespace App\Models;
use Illuminate\Support\Str; // Adicione esta linha
  //* NECESSÁRIO PARA O SCOUT
  use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'user_id', 
        'title', 
        'subject', 
        'topic_difficulty', 
        'content', 
        'file_path',
    ];


    // Relacionamento com o model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use Searchable;
    public function toSearchableArray()
    {
        return [
            'user_id' => $this->user_id,  // Referência ao id do usuário
            'title' => $this->title,
            'subject' => $this->subject,
            'topic_difficulty' => $this->topic_difficulty,
            'content' => $this->content,
            'file_path' => $this->file_path,
        ];
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($note) {
            if (empty($note->slug)) {
                $note->slug = Str::slug($note->title);
            }
        });

        static::updating(function ($note) {
            if (empty($note->slug)) {
                $note->slug = Str::slug($note->title);
            }
        });
    }

}
