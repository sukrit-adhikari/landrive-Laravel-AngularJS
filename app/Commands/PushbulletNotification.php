<?php namespace App\Commands;

use App\Commands\Command;
use Pushbullet\Pushbullet;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Log;


class PushbulletNotification extends Command implements SelfHandling {

    private $title="test";
    private $message="test";

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($push)
	{
		$this->message = $push['message'];
        $this->title = $push['title'];
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
      Log::info("Command");

      if(Config('landrive.pushbulletnotification')){

        $pb = new Pushbullet(Config('landrive.pushbulletapikey'));
        $pb->allDevices()->pushNote($this->title, $this->message );

      }

	}
}
