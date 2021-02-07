<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('Patient_id')->unsigned();
            $table->foreign('Patient_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('Doc_id')->unsigned();
            $table->foreign('Doc_id')->references('id')->on('docs')->onDelete('cascade');

            $table->smallInteger('sender');//0 doc 1 pat

            $table->text('message');

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
        Schema::dropIfExists('messages');
    }
}
