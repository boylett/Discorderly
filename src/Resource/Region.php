<?php

	namespace Discorderly\Resource;

	class Region extends \Discorderly\Resource\AbstractStaticResource {
		/**
		 * Unique ID for the region
		 * @var string
		 */
		public string $id = "";

		/**
		 * Name of the region
		 * @var string
		 */
		public string $name = "";

		/**
		 * True for a single server that is closest to the current user's client
		 * @var bool
		 */
		public bool $optimal = false;

		/**
		 * Whether this is a deprecated voice region (avoid switching to these)
		 * @var bool
		 */
		public bool $deprecated = false;

		/**
		 * Whether this is a custom voice region (used for events/etc)
		 * @var bool
		 */
		public bool $custom = false;
	}
