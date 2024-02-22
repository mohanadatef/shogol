<?php

namespace Modules\Acl\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Setting\Service\NotificationService;

class NotificationMail extends Mailable
{
	use Queueable, SerializesModels;
	public $details,$user;
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($details,$user)
	{
		$this->details = $details;
		$this->user = $user;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->subject($this->details['title'][$this->user->lang])
			->view('acl::emails.NotificationMail');
	}
}
