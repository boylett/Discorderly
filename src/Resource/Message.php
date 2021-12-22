<?php

	namespace Discorderly\Resource;

	class Message extends \Discorderly\Resource\AbstractResource {
		/**
		 * Default
		 * @var int
		 */
		const MESSAGE_TYPE_DEFAULT = 0;
		
		/**
		 * Recipient Add
		 * @var int
		 */
		const MESSAGE_TYPE_RECIPIENT_ADD = 1;
		
		/**
		 * Recipient Remove
		 * @var int
		 */
		const MESSAGE_TYPE_RECIPIENT_REMOVE = 2;
		
		/**
		 * Call
		 * @var int
		 */
		const MESSAGE_TYPE_CALL = 3;
		
		/**
		 * Channel Name Change
		 * @var int
		 */
		const MESSAGE_TYPE_CHANNEL_NAME_CHANGE = 4;
		
		/**
		 * Channel Icon Change
		 * @var int
		 */
		const MESSAGE_TYPE_CHANNEL_ICON_CHANGE = 5;
		
		/**
		 * Channel Pinned Message
		 * @var int
		 */
		const MESSAGE_TYPE_CHANNEL_PINNED_MESSAGE = 6;
		
		/**
		 * Guild Member Join
		 * @var int
		 */
		const MESSAGE_TYPE_GUILD_MEMBER_JOIN = 7;
		
		/**
		 * User Premium Guild Subscription
		 * @var int
		 */
		const MESSAGE_TYPE_USER_PREMIUM_GUILD_SUBSCRIPTION = 8;
		
		/**
		 * User Premium Guild Subscription Tier 1
		 * @var int
		 */
		const MESSAGE_TYPE_USER_PREMIUM_GUILD_SUBSCRIPTION_TIER_1 = 9;
		
		/**
		 * User Premium Guild Subscription Tier 2
		 * @var int
		 */
		const MESSAGE_TYPE_USER_PREMIUM_GUILD_SUBSCRIPTION_TIER_2 = 10;
		
		/**
		 * User Premium Guild Subscription Tier 3
		 * @var int
		 */
		const MESSAGE_TYPE_USER_PREMIUM_GUILD_SUBSCRIPTION_TIER_3 = 11;
		
		/**
		 * Channel Follow Add
		 * @var int
		 */
		const MESSAGE_TYPE_CHANNEL_FOLLOW_ADD = 12;
		
		/**
		 * Guild Discovery Disqualified
		 * @var int
		 */
		const MESSAGE_TYPE_GUILD_DISCOVERY_DISQUALIFIED = 14;
		
		/**
		 * Guild Discovery Requalified
		 * @var int
		 */
		const MESSAGE_TYPE_GUILD_DISCOVERY_REQUALIFIED = 15;
		
		/**
		 * Guild Discovery Grace Period Initial Warning
		 * @var int
		 */
		const MESSAGE_TYPE_GUILD_DISCOVERY_GRACE_PERIOD_INITIAL_WARNING = 16;
		
		/**
		 * Guild Discovery Grace Period Final Warning
		 * @var int
		 */
		const MESSAGE_TYPE_GUILD_DISCOVERY_GRACE_PERIOD_FINAL_WARNING = 17;
		
		/**
		 * Thread Created
		 * @var int
		 */
		const MESSAGE_TYPE_THREAD_CREATED = 18;
		
		/**
		 * Reply
		 * @var int
		 */
		const MESSAGE_TYPE_REPLY = 19;
		
		/**
		 * Chat Input Command
		 * @var int
		 */
		const MESSAGE_TYPE_CHAT_INPUT_COMMAND = 20;
		
		/**
		 * Thread Starter Message
		 * @var int
		 */
		const MESSAGE_TYPE_THREAD_STARTER_MESSAGE = 21;
		
		/**
		 * Guild Invite Reminder
		 * @var int
		 */
		const MESSAGE_TYPE_GUILD_INVITE_REMINDER = 22;
		
		/**
		 * Context Menu Command
		 * @var int
		 */
		const MESSAGE_TYPE_CONTEXT_MENU_COMMAND = 23;

		/**
		 * Join
		 * @var int
		 */
		const MESSAGE_ACTIVITY_TYPE_JOIN = 1;
		
		/**
		 * Spectate
		 * @var int
		 */
		const MESSAGE_ACTIVITY_TYPE_SPECTATE = 2;
		
		/**
		 * Listen
		 * @var int
		 */
		const MESSAGE_ACTIVITY_TYPE_LISTEN = 3;
		
		/**
		 * Join Request
		 * @var int
		 */
		const MESSAGE_ACTIVITY_TYPE_JOIN_REQUEST = 5;

		/**
		 * This message has been published to subscribed channels (via Channel Following)
		 * @var int
		 */
		const MESSAGE_FLAG_CROSSPOSTED = 1;
		
		/**
		 * This message originated from a message in another channel (via Channel Following)
		 * @var int
		 */
		const MESSAGE_FLAG_IS_CROSSPOST = 2;
		
		/**
		 * Do not include any embeds when serializing this message
		 * @var int
		 */
		const MESSAGE_FLAG_SUPPRESS_EMBEDS = 4;
		
		/**
		 * The source message for this crosspost has been deleted (via Channel Following)
		 * @var int
		 */
		const MESSAGE_FLAG_SOURCE_MESSAGE_DELETED = 8;
		
		/**
		 * This message came from the urgent message system
		 * @var int
		 */
		const MESSAGE_FLAG_URGENT = 16;
		
		/**
		 * This message has an associated thread, with the same id as the message
		 * @var int
		 */
		const MESSAGE_FLAG_HAS_THREAD = 32;
		
		/**
		 * This message is only visible to the user who invoked the Interaction
		 * @var int
		 */
		const MESSAGE_FLAG_EPHEMERAL = 64;
		
		/**
		 * This message is an Interaction Response and the bot is "thinking"
		 * @var int
		 */
		const MESSAGE_FLAG_LOADING = 128;

		/**
		 * API endpoint path
		 * @var string
		 */
		public string $endpoint = "/channels/:channel_id/messages";

		/**
		 * ID of the message
		 * @var int
		 */
		public $id = 0;
		
		/**
		 * ID of the channel the message was sent in
		 * @var int
		 */
		public NULL|int $channel_id = 0;
		
		/**
		 * ID of the guild the message was sent in
		 * @var int
		 */
		public NULL|int $guild_id = 0;
		
		/**
		 * The author of this message (not guaranteed to be a valid user, see below)
		 * @var \Discorderly\Resource\User
		 */
		public NULL|\Discorderly\Resource\User $author = NULL;
		
		/**
		 * Member properties for this message's author
		 * @var array
		 */
		public NULL|array $member = [];
		
		/**
		 * Contents of the message
		 * @var string
		 */
		public NULL|string $content = "";
		
		/**
		 * When this message was sent
		 * @var \DateTime
		 */
		public NULL|\DateTime $timestamp = NULL;
		
		/**
		 * When this message was edited (or null if never)
		 * @var \DateTime
		 */
		public NULL|\DateTime $edited_timestamp = NULL;
		
		/**
		 * Whether this was a TTS message
		 * @var bool
		 */
		public NULL|bool $tts = false;
		
		/**
		 * Whether this message mentions everyone
		 * @var bool
		 */
		public NULL|bool $mention_everyone = false;
		
		/**
		 * Users specifically mentioned in the message
		 * @var array
		 */
		public NULL|array $mentions = [];
		
		/**
		 * Roles specifically mentioned in this message
		 * @var array
		 */
		public NULL|array $mention_roles = [];
		
		/**
		 * Channels specifically mentioned in this message
		 * @var array
		 */
		public NULL|array $mention_channels = [];
		
		/**
		 * Any attached files
		 * @var array
		 */
		public NULL|array $attachments = [];
		
		/**
		 * Any embedded content
		 * @var array
		 */
		public NULL|array $embeds = [];
		
		/**
		 * Reactions to the message
		 * @var array
		 */
		public NULL|array $reactions = [];
		
		/**
		 * Used for validating a message was sent
		 * @var int
		 */
		public NULL|int $nonce = 0;
		
		/**
		 * Whether this message is pinned
		 * @var bool
		 */
		public NULL|bool $pinned = false;
		
		/**
		 * If the message is generated by a webhook, this is the webhook's id
		 * @var int
		 */
		public NULL|int $webhook_id = 0;
		
		/**
		 * Type of message
		 * @var int
		 */
		public NULL|int $type = 0;
		
		/**
		 * Sent with Rich Presence-related chat embeds
		 * @var array
		 */
		public NULL|array $activity = [];
		
		/**
		 * Sent with Rich Presence-related chat embeds
		 * @var array
		 */
		public NULL|array $application = [];
		
		/**
		 * If the message is a response to an Interaction, this is the ID of the interaction's application
		 * @var int
		 */
		public NULL|int $application_id = 0;
		
		/**
		 * Data showing the source of a crosspost, channel follow add, pin, or reply message
		 * @var array
		 */
		public NULL|array $message_reference = [];
		
		/**
		 * Message flags combined as a bitfield
		 * @var int
		 */
		public NULL|int $flags = 0;
		
		/**
		 * The message associated with the message_reference
		 * @var array
		 */
		public NULL|array $referenced_message = [];
		
		/**
		 * Sent if the message is a response to an Interaction
		 * @var array
		 */
		public NULL|array $interaction = [];
		
		/**
		 * The thread that was started from this message, includes thread member object
		 * @var array
		 */
		public NULL|array $thread = [];
		
		/**
		 * Sent if the message contains components like buttons, action rows, or other interactive components
		 * @var array
		 */
		public NULL|array $components = [];
		
		/**
		 * Sent if the message contains stickers
		 * @var array
		 */
		public NULL|array $sticker_items = [];
		
		/**
		 * @deprecated The stickers sent with the message
		 * @var array
		 */
		public NULL|array $stickers = [];

		/**
		 * Recursively populate this instance with a data set
		 * @param  array $properties Instance data
		 * @return self
		 */
		public function __populate(array $properties) : self {
			foreach ($properties["sticker_items"] ?? [] as $index => $sticker) {
				if (!isset($this->parent)) {
					throw new \Discorderly\Response\OrphanedInstanceException();
				}

				$properties["sticker_items"][$index] = $this->parent->Sticker($sticker["id"])->__populate($sticker);
			}

			return parent::__populate($properties);
		}

		/**
		 * Delete this instance
		 * @return bool
		 */
		public function delete(...$arguments) : bool {
			return \call_user_func_array("parent::delete", \array_merge($arguments, [
				"endpoint" => "/" . $this->id,
			],
			($this->channel_id or ($arguments["channel_id"] ?? false)) ? [
				"channel_id" => $this->channel_id ?: ($arguments["channel_id"] ?? 0),
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
				"endpoint"   => "/" . $this->id,
			],
			($this->channel_id or ($arguments["channel_id"] ?? false)) ? [
				"channel_id" => $this->channel_id ?: ($arguments["channel_id"] ?? 0),
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
				"endpoint"   => "/" . $this->id,
			],
			($this->channel_id or ($arguments["channel_id"] ?? false)) ? [
				"channel_id" => $this->channel_id ?: ($arguments["channel_id"] ?? 0),
			] : []));
		}
	}
