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
		 * Get the instance's data
		 * @param  string $endpoint     Relative path to Discord API endpoint
		 * @param  array  ...$arguments Payload to send to the Discord API
		 * @return self                 The updated instance
		 */
		public function get(...$arguments) : self {
			return \call_user_func_array("parent::get", \array_merge($arguments, [
				"endpoint" => "/" . $this->id,
			]));
		}

		/**
		 * Get the emoji's tag
		 * @return string
		 */
		public function getTag(bool $animated = false) : string {
			return "<" . ($this->getAnimated() ? "a" : "") . ":" . $this->getName() . ":" . $this->getId() . ">";
		}

		/**
		 * Get the emoji's full URL
		 * @param  int    $size Image size
		 * @return string       Emoji URL
		 */
		public function getUrl(int $size = 0) : string {
			return \strtr(\Discorderly\Discorderly::CDN_ENDPOINT . \Discorderly\Discorderly::CDN_ENDPOINT_CUSTOM_EMOJI, [
				":emoji_id" => $this->getId(),
				":format"   => $this->getAnimated() ? "gif" : "png",
			]) . ($size ? "?size=" . $size : "");
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
			]));
		}
	}
