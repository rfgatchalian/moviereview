<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('cast')->nullable();
            $table->string('description')->nullable();
            $table->string('trailer')->nullable();
            $table->string('director')->nullable();
            $table->string('file')->nullable();
            $table->string('genres')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
