<?php

	namespace Discorderly\Resource;

	class GuildPreview extends \Discorderly\Resource\AbstractStaticResource {
		/**
		 * Guild id
		 * @var int
		 */
		public $id = 0;
		
		/**
		 * Guild name (2-100 characters)
		 * @var string
		 */
		public NULL|string $name = "";
		
		/**
		 * Icon hash
		 * @var string
		 */
		public NULL|string $icon = "";
		
		/**
		 * Splash hash
		 * @var string
		 */
		public NULL|string $splash = "";
		
		/**
		 * Discovery splash hash
		 * @var string
		 */
		public NULL|string $discovery_splash = "";
		
		/**
		 * Custom guild emojis
		 * @var array
		 */
		public NULL|array $emojis = [];
		
		/**
		 * Enabled guild features
		 * @var array
		 */
		public NULL|array $features = [];
		
		/**
		 * Approximate number of members in this guild
		 * @var int
		 */
		public NULL|int $approximate_member_count = 0;
		
		/**
		 * Approximate number of online members in this guild
		 * @var int
		 */
		public NULL|int $approximate_presence_count = 0;
		
		/**
		 * The description for the guild, if the guild is discoverable
		 * @var string
		 */
		public NULL|string $description = "";
	}
