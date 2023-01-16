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
            Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('describe');
            $table->text('path_file');
            $table->dateTime('startTask');
            $table->dateTime('endTask');
            $table->boolean('todo')->default(0);
            $table->integer('userId');
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
        //
    }
};
