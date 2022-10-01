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
        Schema::create('actor_movie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('actor_id');
            $table->unsignedBigInteger('movie_id');
            $table->foreign('actor_id')->references('id')->on('actor')
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;
            $table->foreign('movie_id')->references('id')->on('movie')
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('actor_movie');
    }
};
