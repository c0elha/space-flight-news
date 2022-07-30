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
        Schema::create('article_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('article_id');
            $table->uuid('event_id');
            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_events');
    }
};
