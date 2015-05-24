<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemoteMusicPlayer extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('remotemusicplayer', function(Blueprint $table)
		{

			$table->increments('id');

			$table->integer('userid')->unique()->default(1); // Whose playlist to listen to

            $table->foreign('userid')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->text('playlist')->default(json_encode([]));
			$table->integer('playposition')->default(0); //
            $table->integer('seekposition')->default(0);
			$table->string('volume')->default('1');
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
		Schema::drop('remotemusicplayer');
	}

}
