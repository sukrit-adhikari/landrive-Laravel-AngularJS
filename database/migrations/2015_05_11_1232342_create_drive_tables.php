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
    Schema::create('drives', function(Blueprint $table)
    {
      $table->increments('driveid');
      $table->string('alias');
      $table->string('type'); // System Drive = sd and user created drive = ud
      $table->string('root');
      $table->string('path')->nullable();
      $table->string('relativepath')->nullable();// Relative path to the "root:\\path" if the drive is created by user

      $table->integer('ownerid');
      $table->foreign('ownerid')
            ->references('id')->on('users')
            ->onDelete('cascade');

      $table->integer('referencedrive'); // If the drive is created by user
      $table->foreign('referencedrive')
        ->references('driveid')->on('drives')
        ->onDelete('cascade');
      $table->timestamps();
    });


//    Schema::create('userdrives', function(Blueprint $table)
//    {
//      $table->increments('userdriveid');
//
//      $table->integer('userid');
//      $table->foreign('userid')
//            ->references('id')->on('users')
//            ->onDelete('cascade');
//
//      $table->string('name');
//
//      $table->integer('systemdriveid');
//      $table->foreign('systemdriveid')
//            ->references('systemdriveid')->on('systemdrives')
//            ->onDelete('cascade');
//
//      $table->string('relativepath');
//
//    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('systemdrives');
//    Schema::drop('userdrives');
  }

}
