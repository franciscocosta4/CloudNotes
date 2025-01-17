<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddSlugToNotesTable extends Migration
{
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable();
        });

        // Atualizar os slugs vazios para valores únicos
        \DB::table('notes')->whereNull('slug')->orWhere('slug', '')->update([
            'slug' => \DB::raw('UUID()'),
        ]);
    }

    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
