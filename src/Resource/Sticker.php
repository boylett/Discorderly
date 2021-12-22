<?php

	namespace Discorderly\Resource;

	class Sticker extends \Discorderly\Resource\AbstractResource {
		/**
		 * API endpoint path
		 * @var string
		 */
		public string $endpoint = "/guilds/:guild_id/stickers";

		/**
		 * An official sticker in a pack, part of Nitro or in a removed purchasable pack
		 * @var int
		 */
		const STICKER_TYPE_STANDARD = 1;
		
		/**
		 * A sticker uploaded to a Boosted guild for the guild's members
		 * @var int
		 */
		const STICKER_TYPE_GUILD = 2;

		/**
		 * Sticker image format (PNG)
		 * @var int
		 */
		const STICKER_FORMAT_PNG = 1;
		
		/**
		 * Sticker image format (APNG)
		 * @var int
		 */
		const STICKER_FORMAT_APNG = 2;
		
		/**
		 * Sticker image format (LOTTIE)
		 * @var int
		 */
		const STICKER_FORMAT_LOTTIE = 3;

		/**
		 * Id of the sticker
		 * @var int
		 */
		public $id = 0;
		
		/**
		 * For standard stickers, id of the pack the sticker is from
		 * @var int
		 */
		public NULL|int $pack_id = 0;
		
		/**
		 * Name of the sticker
		 * @var string
		 */
		public NULL|string $name = "";
		
		/**
		 * Description of the sticker
		 * @var string
		 */
		public NULL|string $description = "";
		
		/**
		 * Autocomplete/suggestion tags for the sticker (max 200 characters)
		 * @var string
		 */
		public NULL|string $tags = "";
		
		/**
		 * Deprecated previously the sticker asset hash, now an empty string
		 * @var string
		 */
		public NULL|string $asset = "";
		
		/**
		 * Type of sticker
		 * @var int
		 */
		public NULL|int $type = 0;
		
		/**
		 * Type of sticker format
		 * @var int
		 */
		public NULL|int $format_type = 0;
		
		/**
		 * Whether this guild sticker can be used, may be false due to loss of Server Boosts
		 * @var bool
		 */
		public NULL|bool $available = true;
		
		/**
		 * Id of the guild that owns this sticker
		 * @var int
		 */
		public NULL|int $guild_id = 0;
		
		/**
		 * The user that uploaded the guild sticker
		 * @var \Discorderly\Resource\User
		 */
		public NULL|\Discorderly\Resource\User $user = NULL;
		
		/**
		 * The standard sticker's sort order within its pack
		 * @var int
		 */
		public NULL|int $sort_value = 0;

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

			return $this->parent->Sticker($response["id"])->__populate($response);
		}

		/**
		 * Delete this instance
		 * @return bool
		 */
		public function delete(...$arguments) : bool {
			return \call_user_func_array("parent::delete", \array_merge($arguments, [
				"endpoint" => "/" . $this->id,
			],
			($this->guild_id or ($arguments["guild_id"] ?? false)) ? [
				"guild_id" => $this->guild_id ?: ($arguments["guild_id"] ?? 0),
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
			($this->guild_id or ($arguments["guild_id"] ?? false)) ? [
				"guild_id" => $this->guild_id ?: ($arguments["guild_id"] ?? 0),
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
			($this->guild_id or ($arguments["guild_id"] ?? false)) ? [
				"guild_id" => $this->guild_id ?: ($arguments["guild_id"] ?? 0),
			] : []));
		}
	}
