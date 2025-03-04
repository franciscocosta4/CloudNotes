<?php

namespace App\Models;
use Illuminate\Support\Str; // Adicione esta linha

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

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($note) {
            //* o método Str::slug gera um slug para o titulo da anotaçao
            if (empty($note->slug)) {
                $note->slug = Str::slug($note->title);
            }
            
            $originalSlug = $note->slug;
            $count = 1;
            //* verifica se já existe um slug igual e caso exista adiciona um contador ao numero no final do slug
            while (Note::where('slug', $note->slug)->exists()) {
                $note->slug = $originalSlug . '-' . $count;
                $count++;
            }
        });

        static::updating(function ($note) {
            if (empty($note->slug)) {
                $note->slug = Str::slug($note->title);
            }
    
            // Garantir que o slug seja único durante a atualização
            $originalSlug = $note->slug;
            $count = 1;
            while (Note::where('slug', $note->slug)->exists()) {
                $note->slug = $originalSlug . '-' . $count;
                $count++;
            }
        });
    }
    

}