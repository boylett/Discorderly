<?php

	namespace Discorderly\Resource;

	class Connection extends \Discorderly\Resource\AbstractStaticResource {
		/**
		 * Invisible to everyone except the user themselves
		 * @var int
		 */
		const VISIBILITY_NONE = 0;

		/**
		 * Visible to everyone
		 * @var int
		 */
		const VISIBILITY_EVERYONE = 1;

		/**
		 * Id of the connection account
		 * @var string
		 */
		public string $id = "";
		
		/**
		 * The username of the connection account
		 * @var string
		 */
		public string $name = "";
		
		/**
		 * The service of the connection (twitch, youtube)
		 * @var string
		 */
		public string $type = "";
		
		/**
		 * Whether the connection is revoked
		 * @var bool
		 */
		public bool $revoked = false;
		
		/**
		 * An array of partial server integrations
		 * @var array
		 */
		public array $integrations = [];
		
		/**
		 * Whether the connection is verified
		 * @var bool
		 */
		public bool $verified = false;
		
		/**
		 * Whether friend sync is enabled for this connection
		 * @var bool
		 */
		public bool $friend_sync = false;
		
		/**
		 * Whether activities related to this connection will be shown in presence updates
		 * @var bool
		 */
		public bool $show_activity = false;
		
		/**
		 * Visibility of this connection
		 * @var int
		 */
		public int $visibility = 1;
	}
