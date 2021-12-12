<?php

	namespace Discorderly\Resource;

	class Channel extends \Discorderly\Resource\AbstractResource {
		/**
		 * A text channel within a server
		 * @var int
		 */
		const CHANNEL_TYPE_GUILD_TEXT = 0;
		
		/**
		 * A direct message between users
		 * @var int
		 */
		const CHANNEL_TYPE_DM = 1;
		
		/**
		 * A voice channel within a server
		 * @var int
		 */
		const CHANNEL_TYPE_GUILD_VOICE = 2;
		
		/**
		 * A direct message between multiple users
		 * @var int
		 */
		const CHANNEL_TYPE_GROUP_DM = 3;
		
		/**
		 * An organizational category that contains up to 50 channels
		 * @var int
		 */
		const CHANNEL_TYPE_GUILD_CATEGORY = 4;
		
		/**
		 * A channel that users can follow and crosspost into their own server
		 * @var int
		 */
		const CHANNEL_TYPE_GUILD_NEWS = 5;
		
		/**
		 * A channel in which game developers can sell their game on Discord
		 * @var int
		 */
		const CHANNEL_TYPE_GUILD_STORE = 6;
		
		/**
		 * A temporary sub-channel within a GUILD_NEWS channel
		 * @var int
		 */
		const CHANNEL_TYPE_GUILD_NEWS_THREAD = 10;
		
		/**
		 * A temporary sub-channel within a GUILD_TEXT channel
		 * @var int
		 */
		const CHANNEL_TYPE_GUILD_PUBLIC_THREAD = 11;
		
		/**
		 * A temporary sub-channel within a GUILD_TEXT channel that is only viewable by those invited and those with the MANAGE_THREADS permission
		 * @var int
		 */
		const CHANNEL_TYPE_GUILD_PRIVATE_THREAD = 12;
		
		/**
		 * A voice channel for hosting events with an audience
		 * @var int
		 */
		const CHANNEL_TYPE_GUILD_STAGE_VOICE = 13;

		/**
		 * Discord chooses the quality for optimal performance
		 * @var int
		 */
		const VIDEO_QUALITY_AUTO = 1;
		
		/**
		 * 720p
		 * @var int
		 */
		const VIDEO_QUALITY_FULL = 2;

		/**
		 * API endpoint path
		 * @var string
		 */
		public string $endpoint = "/channels";

		/**
		 * The id of this channel
		 * @var int
		 */
		public $id = 0;

		/**
		 * The type of channel
		 * @var int
		 */
		public NULL|int $type = 0;

		/**
		 * The id of the guild (may be missing for some channel objects received over gateway guild dispatches)
		 * @var int
		 */
		public NULL|int $guild_id = 0;

		/**
		 * Sorting position of the channel
		 * @var int
		 */
		public NULL|int $position = 0;

		/**
		 * Explicit permission overwrites for members and roles
		 * @var array
		 */
		public NULL|array $permission_overwrites = [];

		/**
		 * The name of the channel (1-100 characters)
		 * @var string
		 */
		public NULL|string $name = "";

		/**
		 * The channel topic (0-1024 characters)
		 * @var string
		 */
		public NULL|string $topic = "";

		/**
		 * Whether the channel is nsfw
		 * @var bool
		 */
		public NULL|bool $nsfw = false;

		/**
		 * The id of the last message sent in this channel (may not point to an existing or valid message)
		 * @var int
		 */
		public NULL|int $last_message_id = 0;

		/**
		 * The bitrate (in bits) of the voice channel
		 * @var int
		 */
		public NULL|int $bitrate = 0;

		/**
		 * The user limit of the voice channel
		 * @var int
		 */
		public NULL|int $user_limit = 0;

		/**
		 * Amount of seconds a user has to wait before sending another message (0-21600); bots, as well as users with the permission manage_messages or manage_channel, are unaffected
		 * @var int
		 */
		public NULL|int $rate_limit_per_user = 0;

		/**
		 * Of user objects	the recipients of the DM
		 * @var array
		 */
		public NULL|array $recipients = [];

		/**
		 * Icon hash
		 * @var string
		 */
		public NULL|string $icon = "";

		/**
		 * Id of the creator of the group DM or thread
		 * @var int
		 */
		public NULL|int $owner_id = 0;

		/**
		 * Application id of the group DM creator if it is bot-created
		 * @var int
		 */
		public NULL|int $application_id = 0;

		/**
		 * For guild channels: id of the parent category for a channel (each parent category can contain up to 50 channels), for threads: id of the text channel this thread was created
		 * @var int
		 */
		public NULL|int $parent_id = 0;

		/**
		 * When the last pinned message was pinned. This may be null in events such as GUILD_CREATE when a message is not pinned.
		 * @var \DateTime
		 */
		public NULL|\DateTime $last_pin_timestamp = NULL;

		/**
		 * Voice region id for the voice channel, automatic when set to null
		 * @var string
		 */
		public NULL|string $rtc_region = "";

		/**
		 * The camera video quality mode of the voice channel, 1 when not present
		 * @var int
		 */
		public NULL|int $video_quality_mode = 0;

		/**
		 * An approximate count of messages in a thread, stops counting at 50
		 * @var int
		 */
		public NULL|int $message_count = 0;

		/**
		 * An approximate count of users in a thread, stops counting at 50
		 * @var int
		 */
		public NULL|int $member_count = 0;

		/**
		 * Thread-specific fields not needed by other channels
		 * @var array
		 */
		public NULL|array $thread_metadata = [];

		/**
		 * Thread member object for the current user, if they have joined the thread, only included on certain API endpoints
		 * @var \Discorderly\Resource\ThreadMember
		 */
		public NULL|\Discorderly\Resource\ThreadMember $member = NULL;

		/**
		 * Default duration that the clients (not the API) will use for newly created threads, in minutes, to automatically archive the thread after recent activity, can be set to: 60, 1440, 4320, 10080
		 * @var int
		 */
		public NULL|int $default_auto_archive_duration = 0;

		/**
		 * Computed permissions for the invoking user in the channel, including overwrites, only included when part of the resolved data received on a slash command interaction
		 * @var string
		 */
		public NULL|string $permissions = "";

		/**
		 * Enforce supplication of a channel ID when creating channel instances
		 */
		public function __construct(...$arguments) {
			if (empty($arguments["id"] ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Channel ID (id) when using " . \get_called_class() . "::__construct()");
			}

			return \call_user_func_array("parent::__construct", $arguments);
		}

		/**
		 * Recursively populate this instance with a data set
		 * @param  array $properties Instance data
		 * @return self
		 */
		public function __populate(array $properties) : self {
			foreach ($properties["permission_overwrites"] ?? [] as $index => $overwrite) {
				$properties["permission_overwrites"][$index] = \Discorderly\Resource\Overwrite::__instance($overwrite["id"])->__populate($overwrite);
			}

			foreach ($properties["recipients"] ?? [] as $index => $user) {
				$properties["recipients"][$index] = $this->parent->User($user["id"])->__populate($user);
			}

			if ($properties["member"] ?? NULL and !($properties["member"] instanceof \Discorderly\Resource\ThreadMember)) {
				$properties["member"] = \Discorderly\Resource\ThreadMember::__instance($properties["member"]["id"])->__populate($properties["member"]);
			}

			return parent::__populate($properties);
		}

		/**
		 * Delete messages in bulk
		 * @param  array $messages Array of Message IDs
		 * @return self
		 */
		public function bulkDeleteMessages(array $messages) : self {
			$this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/messages/bulk-delete",
				type:     "post",
				data:     [
					"messages" => $messages,
				],
			);

			return $this;
		}

		/**
		 * Creates a new thread
		 * @param  int                           $message_id            Message ID to connect the thread to
		 * @param  string                        $name                  1-100 character channel name
		 * @param  int                           $auto_archive_duration Duration in minutes to automatically archive the thread after recent activity, can be set to: 60, 1440, 4320, 10080
		 * @param  int                           $type                  The type of thread to create
		 * @param  bool                          $invitable             Whether non-moderators can add other non-moderators to a thread; only available when creating a private thread
		 * @param  int                           $rate_limit_per_user   Amount of seconds a user has to wait before sending another message (0-21600)
		 * @return \Discorderly\Resources\Thread                        New Thread instance
		 */
		public function createThread(...$arguments) : self {
			if (empty($arguments["name"] ?? false)) {
				throw new \Discorderly\Response\Exception("You must supply a Thread Name (name) when using " . \get_called_class() . "::createThread()");
			}

			$arguments["name"] = \substr($arguments["name"], 0, 100);

			if (isset($arguments["message_id"])) {
				$message_id = $arguments["message_id"];

				unset($arguments["message_id"]);

				$thread = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/messages/" . $message_id . "/threads",
					type:     "post",
					data:     $arguments,
				);
			}

			else {
				$thread = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/threads",
					type:     "post",
					data:     $arguments,
				);
			}

			return $this->parent->Thread($thread["id"])->__populate($thread);
		}

		/**
		 * Delete this instance
		 * @return bool
		 */
		public function delete(...$arguments) : bool {
			return parent::delete(endpoint: "/" . $this->id);
		}

		/**
		 * Get the instance's data
		 * @param  string $endpoint     Relative path to Discord API endpoint
		 * @param  array  ...$arguments Payload to send to the Discord API
		 * @return self                 The updated instance
		 */
		public function get(...$arguments) : self {
			\call_user_func_array("parent::get", \array_merge($arguments, [
				"endpoint" => "/" . $this->id,
			]));

			switch ($this->type) {
				case static::CHANNEL_TYPE_DM:
				case static::CHANNEL_TYPE_GROUP_DM: {
					return $this->parent->DM($this->id)->__populate((array) $this);
				}

				break;

				case static::CHANNEL_TYPE_GUILD_NEWS_THREAD:
				case static::CHANNEL_TYPE_GUILD_PUBLIC_THREAD:
				case static::CHANNEL_TYPE_GUILD_PRIVATE_THREAD: {
					return $this->parent->Thread($this->id)->__populate((array) $this);
				}

				break;
			}

			return $this;
		}

		/**
		 * Get messages from this channel
		 * @param  int   $around Get messages around this message ID
		 * @param  int   $before Get messages before this message ID
		 * @param  int   $after  Get messages after this message ID
		 * @param  int   $limit  Max number of messages to return (1-100)
		 * @return array         Array of Message objects
		 */
		public function getMessages(...$arguments) : array {
			if (empty($this->id ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Channel ID (id) when using " . \get_called_class() . "::__construct()");
			}

			$messages = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/messages",
				type:     "get",
				data:     $arguments ?: NULL,
			);

			return \array_map(fn($message) => $this->parent->Message($message["id"])->__populate($message), $messages);
		}

		/**
		 * Returns a specific message in the channel
		 * @return \Discorderly\Resource\Message
		 */
		public function getMessage(int $message_id) : \Discorderly\Resource\Message {
			$message = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/messages/" . $message_id,
				type:     "get",
			);

			return $this->parent->Message($message["id"])->__populate($message);
		}

		/**
		 * Returns all pinned messages in the channel as an array of message objects
		 * @return array Array of Message objects
		 */
		public function getPinnedMessages() : array {
			if (empty($this->id ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Channel ID (id) when using " . \get_called_class() . "::__construct()");
			}

			$messages = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/pins",
				type:     "get",
			);

			return \array_map(fn($message) => $this->parent->Message($message["id"])->__populate($message), $messages);
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

		/**
		 * Pin a message in a channel
		 * @param  int  $message_id Message ID
		 * @param  bool $silent     Whether to suppress the "X pinned a message to this channel" announcement
		 * @return self
		 */
		public function pinMessage(int $message_id, bool $silent = false) : self {
			if (empty($this->id ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Channel ID (id) when using " . \get_called_class() . "::__construct()");
			}

			$this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/pins/" . $message_id,
				type:     "put",
			);

			if ($silent) {
				$messages = $this->getMessages();

				foreach ($messages as $message) {
					if ($message->getType() === \Discorderly\Resource\Message::MESSAGE_TYPE_CHANNEL_PINNED_MESSAGE) {
						$reference = $message->getMessageReference();

						if ($reference["message_id"] == $message_id) {
							$message->delete();

							break;
						}
					}
				}
			}

			return $this;
		}

		/**
		 * Trigger the 'typing' indicator for this user or bot
		 * @return self
		 */
		public function typing() : self {
			$this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/typing",
				type:     "post",
			);

			return $this;
		}

		/**
		 * Unpin a message in a channel
		 * @param  int  $message_id Message ID
		 * @return self
		 */
		public function unpinMessage(int $message_id) : self {
			$this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/pins/" . $message_id,
				type:     "delete",
			);

			return $this;
		}
	}
