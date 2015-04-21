<?php namespace App\Providers;


// Events //
use App\Events\AccessTokenWasProvided;
// Events //



// Handlers //
use App\Handlers\Events\AccessTokenWasProvidedHandler;
// Handlers //


use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [

    'event.name' => [
        'EventListener',
    ],

      AccessTokenWasProvided::class => [
        AccessTokenWasProvidedHandler::class,
      ],

	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
