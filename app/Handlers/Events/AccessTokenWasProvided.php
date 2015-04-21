<?php namespace App\Handlers\Events;

use App\Events\AccessTokenWasProvided;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Bus;
use App\Commands\PushbulletNotification;
use Illuminate\Support\Facades\Queue;


class AccessTokenWasProvidedHandler implements ShouldBeQueued {


    use InteractsWithQueue;

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
	public function handle(AccessTokenWasProvided $event)
	{
//      Bus::dispatch(
//        new PushbulletNotification($event->notification)
//      );

      Queue::push(new PushbulletNotification($event->notification) );

	}

}
