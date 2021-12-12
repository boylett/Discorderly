<?php

	namespace Discorderly\Resource;

	class ThreadMember extends \Discorderly\Resource\AbstractStaticResource {
		/**
		 * The id of the thread
		 * @var int
		 */
		public $id = 0;
		
		/**
		 * The id of the user
		 * @var int
		 */
		public NULL|int $user_id = 0;
		
		/**
		 * The time the current user last joined the thread
		 * @var \DateTime
		 */
		public NULL|\DateTime $join_timestamp = NULL;
		
		/**
		 * Any user-thread settings, currently only used for notifications
		 * @var int
		 */
		public NULL|int $flags = 0;
	}
