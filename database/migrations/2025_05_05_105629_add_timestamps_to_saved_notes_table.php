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
        Schema::table('saved_notes', function (Blueprint $table) {
            // Remover a coluna saved_at
            $table->dropColumn('saved_at');
            
            // Adicionar as colunas created_at e updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saved_notes', function (Blueprint $table) {
            // Voltar a adicionar a coluna saved_at
            $table->timestamp('saved_at')->useCurrent();
            
            // Remover as colunas created_at e updated_at
            $table->dropTimestamps();
        });
    }
};
