<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_works', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('post');
            $table->string('place');
            $table->string('city')->nullable();
            $table->longtext('description')->nullable();
            $table->string('start_at');
            $table->integer('state');
            $table->string('end_at')->nullable();
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
        Schema::dropIfExists('alumni_works');
    }
}