<?php

	namespace Discorderly\Resource;

	class Invite extends \Discorderly\Resource\AbstractResource {
		/**
		 * Stream
		 * @var int
		 */
		const TARGET_TYPE_STREAM = 1;
		
		/**
		 * Embedded Application
		 * @var int
		 */
		const TARGET_TYPE_EMBEDDED_APPLICATION = 2;

		/**
		 * API endpoint path
		 * @var string
		 */
		public string $endpoint = "/invites";

		/**
		 * The invite code (unique ID)
		 * @var string
		 */
		public NULL|string $code = "";
		
		/**
		 * The guild this invite is for
		 * @var \Discorderly\Resource\Guild
		 */
		public NULL|\Discorderly\Resource\Guild $guild = NULL;
		
		/**
		 * The channel this invite is for
		 * @var \Discorderly\Resource\Channel
		 */
		public NULL|\Discorderly\Resource\Channel $channel = NULL;
		
		/**
		 * The user who created the invite
		 * @var \Discorderly\Resource\User
		 */
		public NULL|\Discorderly\Resource\User $inviter = NULL;
		
		/**
		 * The type of target for this voice channel invite
		 * @var int
		 */
		public NULL|int $target_type = 0;
		
		/**
		 * The user whose stream to display for this voice channel stream invite
		 * @var \Discorderly\Resource\User
		 */
		public NULL|\Discorderly\Resource\User $target_user = NULL;
		
		/**
		 * The embedded application to open for this voice channel embedded application invite
		 * @var \Discorderly\Resource\Application
		 */
		public NULL|\Discorderly\Resource\Application $target_application = NULL;
		
		/**
		 * Approximate count of online members, returned from the GET /invites/<code> endpoint when with_counts is true
		 * @var int
		 */
		public NULL|int $approximate_presence_count = 0;
		
		/**
		 * Approximate count of total members, returned from the GET /invites/<code> endpoint when with_counts is true
		 * @var int
		 */
		public NULL|int $approximate_member_count = 0;
		
		/**
		 * The expiration date of this invite, returned from the GET /invites/<code> endpoint when with_expiration is true
		 * @var \DateTime
		 */
		public NULL|\DateTime $expires_at = NULL;
		
		/**
		 * Stage instance data if there is a public Stage instance in the Stage channel this invite is for
		 * @var \Discorderly\Resource\InviteStage
		 */
		public NULL|\Discorderly\Resource\InviteStage $stage_instance = NULL;
		
		/**
		 * Guild scheduled event data, only included if
		 * @var \Discorderly\Resource\Event
		 */
		public NULL|\Discorderly\Resource\Event $guild_scheduled_event = NULL;

		/**
		 * Delete this instance
		 * @return bool
		 */
		public function delete(...$arguments) : bool {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			try {
				$this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->code,
					type:     "delete",
					data:     $arguments ?: NULL,
				);

				$this->id    = 0;
				$this->dirty = false;
			}

			catch (\Exception $e) {
				if ($e->getCode() >= 10001 and $e->getCode() <= 10071) {
					return true;
				}

				throw $e;
			}

			return true;
		}

		/**
		 * Get the instance's data
		 * @param  string $endpoint     Relative path to Discord API endpoint
		 * @param  array  ...$arguments Payload to send to the Discord API
		 * @return self                 The updated instance
		 */
		public function get(...$arguments) : self {
			return \call_user_func_array("parent::get", \array_merge($arguments, [
				"endpoint" => "/" . $this->code,
			]));
		}
	}
