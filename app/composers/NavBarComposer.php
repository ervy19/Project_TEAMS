<?php

use repositories\NotificationRepository;

class NavBarComposer {

	protected $notification

	public function __construct(NotificationRepository $notification)
	{
		$this->notification = $notification
	}

	public function compose($view)
	{
		$view->with('notifications', $this->$notification->getAll())
			->with('name', $this->$notification->getName());
	}
}