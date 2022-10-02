<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('actor_movie', function(Blueprint $table) {
            $table->year('year');
            $table->unsignedInteger('age');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('actor_movie', function(Blueprint $table) {
            $table->dropColumn('year');
            $table->dropColumn('age');
        });
    }
};
