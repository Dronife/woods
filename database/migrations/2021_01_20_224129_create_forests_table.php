<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::disableForeignKeyConstraints();
        Schema::create('forests', function (Blueprint $table) {
            $table->bigIncrements('id');
           
           // $table->integer('userid')->unsigned();
            $table->string('surname',30);
            $table->string('lastname',30);
            $table->string('phone',20);
            $table->integer('price');
            $table->integer('area');
            $table->string('idnum')->default('-');
            $table->string('email');
            $table->foreignId('userid')->constrained('users')->onDelete('cascade');;
            $table->integer('typeid')->unsigned();
            $table->integer('ageid')->unsigned();
            
            $table->timestamps();
        });

        Schema::table('forests', function($table) {
            $table->foreign('typeid')->references('id')->on('types')->onDelete('cascade');;
            $table->foreign('ageid')->references('id')->on('ages')->onDelete('cascade');;
            //$table->foreignId('userid')->constrained('users');
            // $table->foreign('userid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forests');
    }
}
