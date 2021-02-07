<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSympsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symps', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('symp_id')->unsigned();
            $table->foreign('symp_id')->references('id')->on('symp_degs')->onDelete('cascade');

            $table->integer('Patient_id')->unsigned();
            $table->foreign('Patient_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->date('date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('symps');
    }
}
