<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCasenumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casenums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('daycase');
            $table->integer('norcase');
            $table->integer('midcase');
            $table->integer('dancase');
            $table->integer('death');
            $table->integer('recover');
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
        Schema::dropIfExists('casenums');
    }
}
