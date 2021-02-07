<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->bigInteger('phone');
            $table->string('password');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->date('birthdate')->nullable();
            $table->integer('currentstate')->default(2); 
            $table->date('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('image')->nullable();
            $table->integer('docid')->default(0)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        Schema::table('users',function(Blueprint $table){
            $table->dropColumn('phone');
        });
    }
}
