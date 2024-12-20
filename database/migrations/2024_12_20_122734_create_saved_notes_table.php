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
        Schema::create('saved_notes', function (Blueprint $table) {
            $table->id(); // ID da entrada
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relacionamento com Users
            $table->foreignId('note_id')->constrained()->onDelete('cascade'); // Relacionamento com Notes
            $table->timestamp('saved_at')->useCurrent();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_notes');
    }
};
