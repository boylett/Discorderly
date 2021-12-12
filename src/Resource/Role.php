<?php

	namespace Discorderly\Resource;

	class Role extends \Discorderly\Resource\AbstractStaticResource {
		/**
		 * Role id
		 * @var int
		 */
		public $id = 0;
		
		/**
		 * Role name
		 * @var string
		 */
		public NULL|string $name = "";
		
		/**
		 * Int representation of hexadecimal color code
		 * @var int
		 */
		public NULL|int $color = 0;
		
		/**
		 * If this role is pinned in the user listing
		 * @var bool
		 */
		public NULL|bool $hoist = false;
		
		/**
		 * Role icon hash
		 * @var string
		 */
		public NULL|string $icon = "";
		
		/**
		 * Role unicode emoji
		 * @var string
		 */
		public NULL|string $unicode_emoji = "";
		
		/**
		 * Position of this role
		 * @var int
		 */
		public NULL|int $position = 0;
		
		/**
		 * Permission bit set
		 * @var string
		 */
		public NULL|string $permissions = "";
		
		/**
		 * Whether this role is managed by an integration
		 * @var bool
		 */
		public NULL|bool $managed = false;
		
		/**
		 * Whether this role is mentionable
		 * @var bool
		 */
		public NULL|bool $mentionable = false;
		
		/**
		 * The tags this role has
		 * @var array
		 */
		public NULL|array $tags = [];
	}
