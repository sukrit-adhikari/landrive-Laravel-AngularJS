<?php namespace App\Handlers\Events;

use App\Events;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Bus;
use App\Commands\PushbulletNotification;


class AccessTokenWasProvided {
	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  Events  $event
	 * @return void
	 */
	public function handle(Events $event)
	{
      Bus::dispatch(
        new PushbulletNotification($event->notification)
      );
	}

}
