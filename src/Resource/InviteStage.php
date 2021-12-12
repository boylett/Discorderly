<?php

	namespace Discorderly\Resource;

	class InviteStage extends \Discorderly\Resource\AbstractStaticResource {
		/**
		 * The members speaking in the Stage
		 * @var array
		 */
		public NULL|array $members = [];
		
		/**
		 * the number of users in the Stage
		 * @var int
		 */
		public NULL|int $participant_count = 0;
		
		/**
		 * the number of users speaking in the Stage
		 * @var int
		 */
		public NULL|int $speaker_count = 0;
		
		/**
		 * the topic of the Stage instance (1-120 characters)
		 * @var string
		 */
		public NULL|string $topic = "";
	}
