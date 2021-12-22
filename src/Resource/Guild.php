<?php

	namespace Discorderly\Resource;

	class Guild extends \Discorderly\Resource\AbstractResource {
		/**
		 * API endpoint path
		 * @var string
		 */
		public string $endpoint = "/guilds";

		/**
		 * Guild id
		 * @var int
		 */
		public $id = 0;

		/**
		 * Guild name (2-100 characters, excluding trailing and leading whitespace)
		 * @var string
		 */
		public NULL|string $name = "";

		/**
		 * Icon hash
		 * @var string
		 */
		public NULL|string $icon = "";

		/**
		 * Icon hash, returned when in the template object
		 * @var string
		 */
		public NULL|string $icon_hash = "";

		/**
		 * Splash hash
		 * @var string
		 */
		public NULL|string $splash = "";

		/**
		 * Discovery splash hash; only present for guilds with the "DISCOVERABLE" feature
		 * @var string
		 */
		public NULL|string $discovery_splash = "";

		/**
		 * True if the user is the owner of the guild
		 * @var bool
		 */
		public NULL|bool $owner = false;

		/**
		 * Id of owner
		 * @var int
		 */
		public NULL|int $owner_id = 0;

		/**
		 * Total permissions for the user in the guild (excludes overwrites)
		 * @var string
		 */
		public NULL|string $permissions = "";

		/**
		 * Voice region id for the guild (deprecated)
		 * @var string
		 */
		public NULL|string $region = "";

		/**
		 * Id of afk channel
		 * @var int
		 */
		public NULL|int $afk_channel_id = 0;

		/**
		 * Afk timeout in seconds
		 * @var int
		 */
		public NULL|int $afk_timeout = 0;

		/**
		 * True if the server widget is enabled
		 * @var bool
		 */
		public NULL|bool $widget_enabled = false;

		/**
		 * The channel id that the widget will generate an invite to, or null if set to no invite
		 * @var int
		 */
		public NULL|int $widget_channel_id = 0;

		/**
		 * Verification level required for the guild
		 * @var int
		 */
		public NULL|int $verification_level = 0;

		/**
		 * Default message notifications level
		 * @var int
		 */
		public NULL|int $default_message_notifications = 0;

		/**
		 * Explicit content filter level
		 * @var int
		 */
		public NULL|int $explicit_content_filter = 0;

		/**
		 * Roles in the guild
		 * @var array
		 */
		public NULL|array $roles = [];

		/**
		 * Custom guild emojis
		 * @var array
		 */
		public NULL|array $emojis = [];

		/**
		 * Enabled guild features
		 * @var array
		 */
		public NULL|array $features = [];

		/**
		 * Required MFA level for the guild
		 * @var int
		 */
		public NULL|int $mfa_level = 0;

		/**
		 * Application id of the guild creator if it is bot-created
		 * @var int
		 */
		public NULL|int $application_id = 0;

		/**
		 * The id of the channel where guild notices such as welcome messages and boost events are posted
		 * @var int
		 */
		public NULL|int $system_channel_id = 0;

		/**
		 * System channel flags
		 * @var int
		 */
		public NULL|int $system_channel_flags = 0;

		/**
		 * The id of the channel where Community guilds can display rules and/or guidelines
		 * @var int
		 */
		public NULL|int $rules_channel_id = 0;

		/**
		 * When this guild was joined at
		 * @var \DateTime
		 */
		public NULL|\DateTime $joined_at = NULL;

		/**
		 * True if this is considered a large guild
		 * @var bool
		 */
		public NULL|bool $large = false;

		/**
		 * True if this guild is unavailable due to an outage
		 * @var bool
		 */
		public NULL|bool $unavailable = false;

		/**
		 * Total number of members in this guild
		 * @var int
		 */
		public NULL|int $member_count = 0;

		/**
		 * States of members currently in voice channels; lacks the guild_id key
		 * @var array
		 */
		public NULL|array $voice_states = [];

		/**
		 * Users in the guild
		 * @var array
		 */
		public NULL|array $members = [];

		/**
		 * Channels in the guild
		 * @var array
		 */
		public NULL|array $channels = [];

		/**
		 * All active threads in the guild that current user has permission to view
		 * @var array
		 */
		public NULL|array $threads = [];

		/**
		 * Presences of the members in the guild, will only include non-offline members if the size is greater than large threshold
		 * @var array
		 */
		public NULL|array $presences = [];

		/**
		 * The maximum number of presences for the guild (null is always returned, apart from the largest of guilds)
		 * @var int
		 */
		public NULL|int $max_presences = 0;

		/**
		 * The maximum number of members for the guild
		 * @var int
		 */
		public NULL|int $max_members = 0;

		/**
		 * The vanity url code for the guild
		 * @var string
		 */
		public NULL|string $vanity_url_code = "";

		/**
		 * The description of a Community guild
		 * @var string
		 */
		public NULL|string $description = "";

		/**
		 * Banner hash
		 * @var string
		 */
		public NULL|string $banner = "";

		/**
		 * Premium tier (Server Boost level)
		 * @var int
		 */
		public NULL|int $premium_tier = 0;

		/**
		 * The number of boosts this guild currently has
		 * @var int
		 */
		public NULL|int $premium_subscription_count = 0;

		/**
		 * The preferred locale of a Community guild; used in server discovery and notices from Discord; defaults to "en-US"
		 * @var string
		 */
		public NULL|string $preferred_locale = "";

		/**
		 * The id of the channel where admins and moderators of Community guilds receive notices from Discord
		 * @var int
		 */
		public NULL|int $public_updates_channel_id = 0;

		/**
		 * The maximum amount of users in a video channel
		 * @var int
		 */
		public NULL|int $max_video_channel_users = 0;

		/**
		 * Approximate number of members in this guild, returned from the GET /guilds/<id> endpoint when with_counts is true
		 * @var int
		 */
		public NULL|int $approximate_member_count = 0;

		/**
		 * Approximate number of non-offline members in this guild, returned from the GET /guilds/<id> endpoint when with_counts is true
		 * @var int
		 */
		public NULL|int $approximate_presence_count = 0;

		/**
		 * The welcome screen of a Community guild, shown to new members, returned in an Invite's guild object
		 * @var array
		 */
		public NULL|array $welcome_screen = [];

		/**
		 * Guild NSFW level
		 * @var int
		 */
		public NULL|int $nsfw_level = 0;

		/**
		 * Stage instances in the guild
		 * @var array
		 */
		public NULL|array $stage_instances = [];

		/**
		 * Custom guild stickers
		 * @var array
		 */
		public NULL|array $stickers = [];

		/**
		 * The scheduled events in the guild
		 * @var array
		 */
		public NULL|array $guild_scheduled_events = [];

		/**
		 * Whether the guild has the boost progress bar enabled
		 * @var bool
		 */
		public NULL|bool $premium_progress_bar_enabled = false;

		/**
		 * Guild preview data
		 * @var \Discorderly\Resource\GuildPreview
		 */
		public NULL|\Discorderly\Resource\GuildPreview $preview = NULL;

		/**
		 * Vanity URL for the guild
		 * @var string
		 */
		public string $vanity_url;

		/**
		 * Recursively populate this instance with a data set
		 * @param  array $properties Instance data
		 * @return self
		 */
		public function __populate(array $properties) : self {
			foreach ($properties["emojis"] ?? [] as $index => $emoji) {
				if (!isset($this->parent)) {
					throw new \Discorderly\Response\OrphanedInstanceException();
				}

				$properties["emojis"][$index] = $this->parent->Emoji($emoji["id"])->__populate($emoji);
			}

			foreach ($properties["roles"] ?? [] as $index => $role) {
				if (!isset($this->parent)) {
					throw new \Discorderly\Response\OrphanedInstanceException();
				}

				$properties["roles"][$index] = $this->parent->Role($role["id"])->__populate($role);
			}

			foreach ($properties["stickers"] ?? [] as $index => $sticker) {
				if (!isset($this->parent)) {
					throw new \Discorderly\Response\OrphanedInstanceException();
				}

				$properties["stickers"][$index] = $this->parent->Sticker($sticker["id"])->__populate($sticker);
			}

			return parent::__populate($properties);
		}

		/**
		 * Adds a user to the guild, provided you have a valid oauth2 access token for the user with the guilds.join scope
		 * @param  int     $user_id             User ID
		 * @param  string  $access_token        An oauth2 access token granted with the guilds.join to the bot's application for the user you want to add to the guild	
		 * @param  string  $nick                Value to set users nickname to
		 * @param  array   $roles               Array of role ids the member is assigned
		 * @param  boolean $mute                Whether the user is muted in voice channels
		 * @param  boolean $deaf                Whether the user is deafened in voice channels
		 * @return \Discorderly\Resource\Member
		 */
		public function addMember(...$arguments) : \Discorderly\Resource\Member {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			if (empty($arguments["user_id"] ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a User ID (user_id) when using " . \get_called_class() . "::addMember()");
			}

			if (empty($arguments["access_token"] ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply an Access Token (access_token) when using " . \get_called_class() . "::addMember()");
			}

			$user_id = $arguments["user_id"];

			unset($arguments["user_id"]);

			$member = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/members/" . $user_id,
				type:     "put",
				data:     $arguments,
			);

			if (empty($member)) {
				return $this->getMember($user_id);
			}

			return $this->parent->Member()->__populate($member);
		}

		/**
		 * Adds a role to a guild member. Requires the MANAGE_ROLES permission. Returns a 204 empty response on success. Fires a Guild Member Update Gateway event
		 * @param  int    $user_id User ID
		 * @param  string $role_id Role ID
		 * @return self
		 */
		public function addMemberRole(...$arguments) : self {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			if (empty($arguments["user_id"] ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a User ID (user_id) when using " . \get_called_class() . "::addMember()");
			}

			if (empty($arguments["role_id"] ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Role ID (role_id) when using " . \get_called_class() . "::addMember()");
			}

			$this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/members/" . $arguments["user_id"] . "/roles/" . $arguments["role_id"],
				type:     "put",
			);

			return $this;
		}

		/**
		 * Create a new instance
		 * @param  string $endpoint Relative path to Discord API endpoint
		 * @return static           The new instance
		 */
		public function create(...$arguments) : static {
			if (!isset($arguments["name"])) {
				throw new \Discorderly\Response\Exception("You must supply a Guild Name (name) when using \\Discorderly\\Resource\\Guild::create()");
			}

			return \call_user_func_array("parent::create", $arguments);
		}

		/**
		 * Get the instance's data
		 * @param  string $endpoint     Relative path to Discord API endpoint
		 * @param  array  ...$arguments Payload to send to the Discord API
		 * @return static               The updated instance
		 */
		public function get(...$arguments) : self {
			if (empty($this->id ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Guild ID (id) when using " . \get_called_class() . "::__construct()");
			}

			return parent::get(
				endpoint: "/" . $this->id
			);
		}

		/**
		 * Returns a ban object for the given user or a 404 not found if the ban cannot be found. Requires the BAN_MEMBERS permission.
		 * @param  int                       $user_id User ID
		 * @return \Discorderly\Resource\Ban          Ban object
		 */
		public function getBan(int $user_id) : \Discorderly\Resource\Ban {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			if (empty($this->id ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Guild ID (id) when using " . \get_called_class() . "::__construct()");
			}

			$ban = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/bans/" . $user_id,
				type:     "get",
			);

			return $this->parent->Ban()->__populate(\array_merge($ban, [
				"guild_id" => $this->id,
			]));
		}

		/**
		 * Returns a list of ban objects for the users banned from this guild. Requires the BAN_MEMBERS permission
		 * @return array Array of Ban objects
		 */
		public function getBans() : array {
			if (empty($this->id ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Guild ID (id) when using " . \get_called_class() . "::__construct()");
			}

			if (empty($this->bans ?? [])) {
				if (!isset($this->parent)) {
					throw new \Discorderly\Response\OrphanedInstanceException();
				}

				$bans = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/bans",
					type:     "get",
				);

				$this->bans = \array_map(fn($ban) => $this->parent->Ban()->__populate(\array_merge($ban, [
					"guild_id" => $this->id,
				])), $bans);
			}

			return $this->bans;
		}

		/**
		 * Get this guild's channels
		 * @return array Array of Channel objects
		 */
		public function getChannels() : array {
			if (empty($this->id ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Guild ID (id) when using " . \get_called_class() . "::__construct()");
			}

			if (empty($this->channels ?? [])) {
				if (!isset($this->parent)) {
					throw new \Discorderly\Response\OrphanedInstanceException();
				}

				$channels = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/channels",
					type:     "get",
				);

				$this->channels = \array_map(fn($channel) => $this->parent->Channel($channel["id"])->__populate($channel), $channels);
			}

			return $this->channels;
		}

		/**
		 * Search for a channel
		 * @param  array                              ...$arguments Search filters
		 * @return NULL|\Discorderly\Resource\Channel               Matching channel object or NULL
		 */
		public function getChannel(...$arguments) : NULL|\Discorderly\Resource\Channel {
			$channels = \Discorderly\Discorderly::array_find($this->getChannels(), $arguments);

			if (isset($this->parent)) {
				$channels = \array_map(fn($channel) => $this->parent->adopt($channel), $channels);
			}

			return \reset($channels) ?: NULL;
		}

		/**
		 * Search for an emoji
		 * @param  array|int                   ...$arguments|$emoji_id Emoji ID or search filters
		 * @return \Discorderly\Resource\Emoji                         Emoji object
		 */
		public function getEmoji(...$arguments) : NULL|\Discorderly\Resource\Emoji {
			if (\count($arguments) === 1 and (isset($arguments["id"]) or \array_keys($arguments) === [0])) {
				if (!isset($this->parent)) {
					throw new \Discorderly\Response\OrphanedInstanceException();
				}

				$emoji = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/emojis/" . ($arguments["id"] ?? $arguments[0]),
					type:     "get",
				);
				
				return $this->parent->Emoji($emoji["id"])->__populate($emoji);
			}

			else {
				$emojis = \Discorderly\Discorderly::array_find($this->getEmojis(), $arguments);

				if (isset($this->parent)) {
					$emojis = \array_map(fn($emoji) => $this->parent->adopt($emoji), $emojis);
				}

				return \reset($emojis) ?: NULL;
			}

			return NULL;
		}

		/**
		 * Returns a list of guild member objects that are members of the guild
		 * @return array
		 */
		public function getMembers() : array {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			$members = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/members",
				type:     "get",
			);

			return \array_map(fn($member) => $this->parent->Member()->__populate($member), $members);
		}

		/**
		 * Returns a guild member object for the specified user
		 * @param  int                          $user_id The user ID
		 * @return \Discorderly\Resource\Member
		 */
		public function getMember(int $user_id) : \Discorderly\Resource\Member {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			$member = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/members/" . $user_id,
				type:     "get",
			);

			return $this->parent->Member()->__populate($member);
		}

		/**
		 * Returns a list of invite objects (with invite metadata) for the guild
		 * @return array
		 */
		public function getInvites() : array {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			$invites = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/invites",
				type:     "get",
			);

			return \array_map(fn($invite) => $this->parent->Invite($invite["code"])->__populate($invite), $invites);
		}

		/**
		 * Returns the guild preview object for the given id. If the user is not in the guild, then the guild must be lurkable (it must be Discoverable or have a live public stage)
		 * @return \Discorderly\Resource\GuildPreview
		 */
		public function getPreview() : \Discorderly\Resource\GuildPreview {
			if (empty($this->preview ?? NULL)) {
				if (!isset($this->parent)) {
					throw new \Discorderly\Response\OrphanedInstanceException();
				}

				$preview = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/preview",
					type:     "get",
				);

				foreach ($preview["emojis"] as $index => $emoji) {
					$preview["emojis"][$index] = $this->parent->Emoji($emoji["id"])->__populate($emoji);
				}

				$this->preview = \Discorderly\Resource\GuildPreview::__instance($preview["id"])->__populate($preview);
			}

			return $this->preview;
		}

		/**
		 * Search for a role
		 * @param  array                           ...$arguments Search filters
		 * @return NULL|\Discorderly\Resource\Role               Matching role object or NULL
		 */
		public function getRole(...$arguments) : NULL|\Discorderly\Resource\Role {
			$roles = \Discorderly\Discorderly::array_find($this->getRoles(), $arguments);

			if (isset($this->parent)) {
				$roles = \array_map(fn($role) => $this->parent->adopt($role), $roles);
			}

			return \reset($roles) ?: NULL;
		}

		/**
		 * Search for a sticker
		 * @param  array                              ...$arguments Search filters
		 * @return NULL|\Discorderly\Resource\Sticker               Matching sticker object or NULL
		 */
		public function getSticker(...$arguments) : NULL|\Discorderly\Resource\Sticker {
			$stickers = \Discorderly\Discorderly::array_find($this->getStickers(), $arguments);

			if (isset($this->parent)) {
				$stickers = \array_map(fn($sticker) => $this->parent->adopt($sticker), $stickers);
			}

			return \reset($stickers) ?: NULL;
		}

		/**
		 * Get this guild's threads
		 * @return array Array of Thread objects
		 */
		public function getThreads() : array {
			if (empty($this->id ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Guild ID (id) when using " . \get_called_class() . "::__construct()");
			}

			if (empty($this->threads ?? [])) {
				if (!isset($this->parent)) {
					throw new \Discorderly\Response\OrphanedInstanceException();
				}

				$this->threads = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/threads/active",
					type:     "get",
				);

				foreach ($this->threads["threads"] ?? [] as $index => $thread) {
					$this->threads["threads"][$index] = $this->parent->Thread($thread["id"])->__populate($thread);
				}

				foreach ($this->threads["members"] ?? [] as $index => $member) {
					$this->threads["members"][$index] = \Discorderly\Resource\ThreadMember::__instance($member["id"])->__populate($member);
				}
			}

			return $this->threads;
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
		 * Modify the position of a channel in the guild
		 * @param  int  $id               Channel ID
		 * @param  int  $position         Sorting position of the channel
		 * @param  bool $lock_permissions Syncs the permission overwrites with the new parent, if moving to a new category
		 * @param  int  $parent_id        The new parent ID for the channel that is moved
		 * @return self
		 */
		public function modifyChannelPosition(...$arguments) : self {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			if (empty($arguments["id"] ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Channel ID (id) when using " . \get_called_class() . "::modifyChannelPositions()");
			}

			if (!isset($arguments["position"])) {
				throw new \Discorderly\Response\Exception("You must supply a Position Integer (position) when using " . \get_called_class() . "::modifyChannelPositions()");
			}

			$this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/channels",
				type:     "patch",
				data:     $arguments,
			);

			return $this;
		}

		/**
		 * Modify attributes of a guild member
		 * @return \Discorderly\Resource\Member
		 */
		public function modifyMember(...$arguments) : \Discorderly\Resource\Member {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			if (empty($arguments["user_id"] ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a User ID (user_id) when using " . \get_called_class() . "::modifyMember()");
			}

			$user_id = $arguments["user_id"];

			unset($arguments["user_id"]);

			$member = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/members/" . $user_id,
				type:     "patch",
				data:     $arguments,
			);

			return $this->parent->Member()->__populate($member);
		}

		/**
		 * Remove a member from a guild
		 * @param  int   $user_id User ID
		 * @return bool
		 */
		public function removeMember(int $user_id) : bool {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			if (empty($this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/members/" . $user_id,
				type:     "delete",
			))) {
				return true;
			}

			return false;
		}

		/**
		 * Removes a role from a guild member. Requires the MANAGE_ROLES permission. Returns a 204 empty response on success. Fires a Guild Member Update Gateway event
		 * @param  int    $user_id User ID
		 * @param  string $role_id Role ID
		 * @return self
		 */
		public function removeMemberRole(...$arguments) : self {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			if (empty($arguments["user_id"] ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a User ID (user_id) when using " . \get_called_class() . "::addMember()");
			}

			if (empty($arguments["role_id"] ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Role ID (role_id) when using " . \get_called_class() . "::addMember()");
			}

			$this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/members/" . $arguments["user_id"] . "/roles/" . $arguments["role_id"],
				type:     "delete",
			);

			return $this;
		}

		/**
		 * Returns a partial invite object for guilds with that feature enabled
		 * @return string
		 */
		public function getVanityUrl() : string {
			if (!isset($this->vanity_url)) {
				if (!isset($this->parent)) {
					throw new \Discorderly\Response\OrphanedInstanceException();
				}

				$invite = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/vanity-url",
					type:     "get",
				);

				$this->vanity_url = \Discorderly\Discorderly::VANITY_URL_ENDPOINT . "/" . $invite["code"];
			}

			return $this->vanity_url;
		}
	}
