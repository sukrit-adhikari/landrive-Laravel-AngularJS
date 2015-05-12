<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrivePermissionTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('permission', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('userid');
      $table->string('permission');
      $table->dateTime('expiry');
      $table->foreign('userid')
            ->references('id')->on('users')
            ->onDelete('cascade');

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('permission');
  }

}
