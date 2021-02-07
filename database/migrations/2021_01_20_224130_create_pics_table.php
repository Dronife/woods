<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        //Schema::disableForeignKeyConstraints();
        Schema::create('pics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dir', 45);
            //$table->integer('forest_id')->unsigned();
            //$table->foreign('forest_id')->references('id')->on('forests');
           // $table->integer('forest_id')->unsigned();
           // $table->foreignId('forest_id')->constrained('forests');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('forest_id')->constrained('forests');
            $table->timestamps();
           
        });

        // Schema::table('pics', function($table) {
        //     $table->foreign('forest_id')->references('id')->on('forests')->onDelete('cascade');
        //     //$table->foreignId('userid')->constrained('users');
        //     // $table->foreign('userid')->references('id')->on('users');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pics');
    }
}
