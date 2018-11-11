<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
          $table->increments( 'id' );
          $table->integer( 'pwd' );
          $table->string( 'name' );
          $table->string('online');
          $table->float( 'time' );
          $table->string( 'indication' );
          $table->string( 'comments' );
          $table->integer( 'plataform_id' )->unsigned();
          $table->foreign( 'plataform_id' )->references('id')->on( 'plataforms' );
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
        Schema::dropIfExists('games');
    }
}
