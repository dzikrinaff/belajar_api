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
    public function up()
    {
        Schema::create('actor_films', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_actor');
            $table->unsignedBigInteger('id_film');
            $table->foreign('id_actor')->references('id')->on('actors')
            ->onDelete('cascade');
            $table->foreign('id_film')->references('id')->on('films')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actor_films');
    }
};
