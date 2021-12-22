<?php

	namespace Discorderly\Resource;

	class Emoji extends \Discorderly\Resource\AbstractResource {
		/**
		 * API endpoint path
		 * @var string
		 */
		public string $endpoint = "/guilds/:guild_id/emojis";

		/**
		 * Emoji id
		 * @var int
		 */
		public $id = 0;

		/**
		 * Emoji name
		 * @var string
		 */
		public NULL|string $name = "";

		/**
		 * Roles allowed to use this emoji
		 * @var array
		 */
		public NULL|array $roles = [];

		/**
		 * User that created this emoji
		 * @var User
		 */
		public NULL|\Discorderly\Resource\User $user;

		/**
		 * Whether this emoji must be wrapped in colons
		 * @var bool
		 */
		public NULL|bool $require_colons = true;

		/**
		 * Whether this emoji is managed
		 * @var bool
		 */
		public NULL|bool $managed = false;

		/**
		 * Whether this emoji is animated
		 * @var bool
		 */
		public NULL|bool $animated = false;

		/**
		 * Whether this emoji can be used, may be false due to loss of Server Boosts
		 * @var bool
		 */
		public NULL|bool $available = true;

		/**
		 * Create a new instance
		 * @param  string $endpoint Relative path to Discord API endpoint
		 * @return static           The new instance
		 */
		public function create(...$arguments) : static {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			$response = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint,
				type:     "post",
				data:     $arguments,
			);

			if (!isset($response["id"])) {
				throw new \Discorderly\Response\Exception("Failed to create instance in " . \get_called_class() . "::create():\n" . \print_r($response, true));
			}

			return $this->parent->Emoji($response["id"])->__populate($response);
		}

		/**
		 * Delete this instance
		 * @return bool
		 */
		public function delete(...$arguments) : bool {
			return \call_user_func_array("parent::delete", \array_merge($arguments, [
				"endpoint" => "/" . $this->id,
			],
			($arguments["guild_id"] ?? false) ? [
				"guild_id" => $arguments["guild_id"],
			] : []));
		}

		/**
		 * Get the instance's data
		 * @param  string $endpoint     Relative path to Discord API endpoint
		 * @param  array  ...$arguments Payload to send to the Discord API
		 * @return self                 The updated instance
		 */
		public function get(...$arguments) : self {
			return \call_user_func_array("parent::get", \array_merge($arguments, [
				"endpoint" => "/" . $this->id,
			],
			($arguments["guild_id"] ?? false) ? [
				"guild_id" => $arguments["guild_id"],
			] : []));
		}

		/**
		 * Modify this instance
		 * @param  string $endpoint     Relative path to Discord API endpoint
		 * @param  array  ...$arguments Payload to send to the Discord API
		 * @return self                 The updated instance
		 */
		public function modify(...$arguments) : self {
			return \call_user_func_array("parent::modify", \array_merge($arguments, [
				"endpoint" => "/" . $this->id,
			],
			($arguments["guild_id"] ?? false) ? [
				"guild_id" => $arguments["guild_id"],
			] : []));
		}
	}
