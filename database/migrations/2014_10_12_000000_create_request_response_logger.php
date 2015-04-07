<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestResponseLogger extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('LanDriveLog', function(Blueprint $table)
		{
			$table->increments('logid');
            $table->text('requestcode');
            $table->text('requestorresponse');
            $table->dateTime('datetime');
            $table->text('url');
            $table->longText('data');
			$table->text('clientipaddress');
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
		Schema::drop('LanDriveLog');
	}

}
