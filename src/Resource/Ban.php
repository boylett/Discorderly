<?php

	namespace Discorderly\Resource;

	class Ban extends \Discorderly\Resource\AbstractResource {
		/**
		 * API endpoint path
		 * @var string
		 */
		public string $endpoint = "/guilds/:guild_id/bans/:user_id";

		/**
		 * The reason for the ban
		 * @var string
		 */
		public NULL|string $reason = "";

		/**
		 * The guild ID
		 * @var int
		 */
		public NULL|int $guild_id = 0;
		
		/**
		 * The banned user
		 * @var \Discorderly\Resource\User
		 */
		public NULL|\Discorderly\Resource\User $user = NULL;

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
				type:     "put",
				data:     $arguments,
			);

			return static::__instance(parent: $this->parent)->__populate([
				"user"     => $this->parent->User($arguments["user_id"]),
				"guild_id" => $arguments["guild_id"] ?? 0,
				"reason"   => $arguments["reason"]   ?? "",
			]);
		}

		/**
		 * Delete this instance
		 * @return bool
		 */
		public function delete(...$arguments) : bool {
			return \call_user_func_array("parent::delete", \array_merge($arguments,
				($this->guild_id or ($arguments["guild_id"] ?? false)) ? [
					"guild_id" => $this->guild_id ?: ($arguments["guild_id"] ?? 0),
				] : [],
				($this->user or ($arguments["user_id"] ?? false)) ? [
					"user_id"  => $this->user?->getId() ?: ($arguments["user_id"] ?? 0),
				] : []));
		}
	}
