<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriveTables extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('systemdrives', function(Blueprint $table)
    {
      $table->increments('systemdriveid');
      $table->string('root');
      $table->string('path');
      $table->integer('userid');
      $table->foreign('userid')
            ->references('id')->on('users')
            ->onDelete('cascade');

    });


    Schema::create('userdrives', function(Blueprint $table)
    {
      $table->increments('userdriveid');

      $table->integer('userid');
      $table->foreign('userid')
            ->references('id')->on('users')
            ->onDelete('cascade');

      $table->string('name');

      $table->integer('systemdriveid');
      $table->foreign('systemdriveid')
            ->references('systemdriveid')->on('systemdrives')
            ->onDelete('cascade');

      $table->string('relativepath');

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('systemdrives');
    Schema::drop('userdrives');
  }

}
