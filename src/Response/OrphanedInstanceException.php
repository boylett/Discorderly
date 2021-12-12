<?php

	namespace Discorderly\Response;

	final class OrphanedInstanceException extends \Discorderly\Response\Exception {
		/**
		 * Error message
		 * @var string
		 */
		protected $message = "You should not instantiate \\Discorderly\\Resource instances outside of the built-in \\Discorderly::<Resource>() methods";
	}
