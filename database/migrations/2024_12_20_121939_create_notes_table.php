<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id(); // ID da anotação
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relacionamento com Users
            $table->string('title');
            $table->string('subject');
            $table->enum('topic_difficulty', ['Fácil', 'Moderada', 'Difícil'])->default('Moderada');
            $table->longText('content')->nullable(); //* para suportar até  4gb de texto 
            $table->string('file_path')->nullable(); // Caminho do arquivo (caso a nota seja um arquivo)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
