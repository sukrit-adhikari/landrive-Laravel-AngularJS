<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandriveLogger extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('landrivelog', function(Blueprint $table)
		{
			$table->increments('logID');
            $table->text('RequestCode');
            $table->text('LogType');
            $table->dateTime('datetime');
            $table->text('url');
            $table->longText('data');
			$table->text('ClientIPaddress');
            $table->text('header');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('landrivelog');
	}

}
