<?php

	namespace Discorderly\Resource;

	class Overwrite extends \Discorderly\Resource\AbstractStaticResource {
		/**
		 * Role or user id
		 * @var int
		 */
		public $id = 0;

		/**
		 * Either 'role' or 'member'
		 * @var string
		 */
		public string $type = "role";

		/**
		 * Permission bit set
		 * @var string
		 */
		public string $allow = "0";

		/**
		 * Permission bit set
		 * @var string
		 */
		public string $allow_new = "0";

		/**
		 * Permission bit set
		 * @var string
		 */
		public string $deny = "0";

		/**
		 * Permission bit set
		 * @var string
		 */
		public string $deny_new = "0";
	}
