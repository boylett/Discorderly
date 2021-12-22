<?php

	namespace Discorderly\Response;

	final class OrphanedInstanceException extends \Discorderly\Response\Exception {
		/**
		 * Error message
		 * @var string
		 */
		protected $message = "Resource is missing its parent. Call \\Discorderly->adopt(\\Resource \$...) to adopt it first";
	}
