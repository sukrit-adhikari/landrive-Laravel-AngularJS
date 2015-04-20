<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class AccessTokenWasProvided extends Event {

	use SerializesModels;

    public $notification;
    public $accessDetail;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($accessDetail,$notification)
	{
      $this->accessDetail = $accessDetail;
      $this->notification = $notification;
	}

}
