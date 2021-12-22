<?php

	namespace Discorderly\Resource;

	class User extends \Discorderly\Resource\AbstractResource {
		/**
		 * None
		 * @var int
		 */
		const FLAG_NONE = 0;
		
		/**
		 * Discord Employee
		 * @var int
		 */
		const FLAG_STAFF = 1;
		
		/**
		 * Partnered Server Owner
		 * @var int
		 */
		const FLAG_PARTNER = 2;
		
		/**
		 * HypeSquad Events Coordinator
		 * @var int
		 */
		const FLAG_HYPESQUAD = 4;
		
		/**
		 * Bug Hunter Level 1
		 * @var int
		 */
		const FLAG_BUG_HUNTER_LEVEL_1 = 8;
		
		/**
		 * House Bravery Member
		 * @var int
		 */
		const FLAG_HYPESQUAD_ONLINE_HOUSE_1 = 64;
		
		/**
		 * House Brilliance Member
		 * @var int
		 */
		const FLAG_HYPESQUAD_ONLINE_HOUSE_2 = 128;
		
		/**
		 * House Balance Member
		 * @var int
		 */
		const FLAG_HYPESQUAD_ONLINE_HOUSE_3 = 256;
		
		/**
		 * Early Nitro Supporter
		 * @var int
		 */
		const FLAG_PREMIUM_EARLY_SUPPORTER = 512;
		
		/**
		 * User is a team
		 * @var int
		 */
		const FLAG_TEAM_PSEUDO_USER = 1024;
		
		/**
		 * Bug Hunter Level 2
		 * @var int
		 */
		const FLAG_BUG_HUNTER_LEVEL_2 = 16384;
		
		/**
		 * Verified Bot
		 * @var int
		 */
		const FLAG_VERIFIED_BOT = 65536;
		
		/**
		 * Early Verified Bot Developer
		 * @var int
		 */
		const FLAG_VERIFIED_DEVELOPER = 131072;
		
		/**
		 * Discord Certified Moderator
		 * @var int
		 */
		const FLAG_CERTIFIED_MODERATOR = 262144;
		
		/**
		 * Bot uses only HTTP interactions and is shown in the online member list
		 * @var int
		 */
		const FLAG_BOT_HTTP_INTERACTIONS = 524288;

		/**
		 * None
		 * @var int
		 */
		const PREMIUM_TYPE_NONE = 0;

		/**
		 * Nitro Classic
		 * @var int
		 */
		const PREMIUM_TYPE_NITRO_CLASSIC = 1;

		/**
		 * Nitro
		 * @var int
		 */
		const PREMIUM_TYPE_NITRO = 2;

		/**
		 * API endpoint path
		 * @var string
		 */
		public string $endpoint = "/users";

		/**
		 * The user's id
		 * @var int|string
		 */
		public $id = 0;

		/**
		 * The user's username, not unique across the platform
		 * @var string
		 */
		public NULL|string $username = "";

		/**
		 * The user's 4-digit discord-tag
		 * @var string
		 */
		public NULL|string $discriminator = "";

		/**
		 * The user's avatar hash
		 * @var string
		 */
		public NULL|string $avatar = "";

		/**
		 * Whether the user belongs to an OAuth2 application
		 * @var bool
		 */
		public NULL|bool $bot = false;

		/**
		 * Whether the user is an Official Discord System user (part of the urgent message system)
		 * @var bool
		 */
		public NULL|bool $system = false;

		/**
		 * Whether the user has two factor enabled on their account
		 * @var bool
		 */
		public NULL|bool $mfa_enabled = false;

		/**
		 * The user's banner hash
		 * @var string
		 */
		public NULL|string $banner = "";

		/**
		 * The user's banner color encoded as an integer representation of hexadecimal color code
		 * @var int
		 */
		public NULL|int $accent_color = 0;

		/**
		 * The user's chosen language option
		 * @var string
		 */
		public NULL|string $locale = "";

		/**
		 * Whether the email on this account has been verified
		 * @var bool
		 */
		public NULL|bool $verified = false;

		/**
		 * The user's email
		 * @var string
		 */
		public NULL|string $email = "";

		/**
		 * The flags on a user's account
		 * @var int
		 */
		public NULL|int $flags = 0;

		/**
		 * The type of Nitro subscription on a user's account
		 * @var int
		 */
		public NULL|int $premium_type = 0;

		/**
		 * The public flags on a user's account
		 * @var int
		 */
		public NULL|int $public_flags = 0;

		/**
		 * Member information
		 * @var array
		 */
		public array $member = [];

		/**
		 * Whether this user is @me
		 * @var bool
		 */
		public NULL|bool $is_me = false;

		/**
		 * Array of connections that the user has
		 * @var array
		 */
		public array $connections;

		/**
		 * Array of guilds that the user is in
		 * @var array
		 */
		public array $guilds = [];

		/**
		 * The current user's authorization information
		 * @var array
		 */
		public NULL|array $authorization;

		/**
		 * Enforce supplication of a user ID when creating user instances
		 */
		public function __construct(...$arguments) {
			if (empty($arguments["id"] ?? 0) and !isset($arguments["is_me"])) {
				throw new \Discorderly\Response\Exception("You must supply a User ID (id) when using " . \get_called_class() . "::__construct()");
			}

			if (($arguments["id"] ?? 0) === "@me") {
				$arguments["is_me"] = true;
			}

			else if (($arguments["is_me"] ?? false) === true) {
				$arguments["id"] = "@me";
			}

			return \call_user_func_array("parent::__construct", $arguments);
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
			]));
		}

		/**
		 * Get the user's ping tag
		 * @return string
		 */
		public function getTag() : string {
			return "<@" . $this->getId() . ">";
		}

		/**
		 * Get the current user's authorization information
		 * @return array Authorization information
		 */
		public function getAuthorizationInfo() : array {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			if (!isset($this->authorization)) {
				$this->authorization = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . "/oauth2/@me",
					type:     "get",
				);

				$this->authorization["application"] = $this->parent->Application($this->authorization["application"]["id"])->__populate($this->authorization["application"]);
				$this->authorization["user"]        = \DateTime::createFromFormat("U", \strtotime($this->authorization["user"]));
				$this->authorization["user"]        = $this->parent->User($this->authorization["user"]["id"])->__populate($this->authorization["user"]);
			}

			return $this->authorization;
		}

		/**
		 * Modify this instance
		 * @param  string $endpoint     Relative path to Discord API endpoint
		 * @param  array  ...$arguments Payload to send to the Discord API
		 * @return self                 The updated instance
		 */
		public function modify(...$arguments) : self {
			return \call_user_func_array("parent::modify", \array_merge($arguments, [
				"endpoint" => "/" . ($this->is_me ? "@me" : $this->id),
			]));
		}

		/**
		 * Create a new DM channel with a user or users
		 * @param  int                      $user_id       The recipient to open a DM channel with
		 * @param  array                    $access_tokens Access tokens of users that have granted your app the gdm.join scope
		 * @param  array                    $nicks         An associative array of user ids to their respective nicknames
		 * @return \Discorderly\Resource\DM
		 */
		public function createDM(int $user_id = 0, array $access_tokens = [], array $nicks = []) : array|\Discorderly\Resource\DM {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			$dm = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . ($this->is_me ? "@me" : $this->id) . "/channels",
				type:     "post",
				data:     $user_id ? [
					"recipient_id"  => $user_id,
				] : [
					"access_tokens" => $access_tokens,
					"nicks"         => $nicks,
				],
			);

			return $this->parent->DM($dm["id"])->__populate($dm);
		}

		/**
		 * Construct an OAuth authorization URL
		 * @param  string       $prompt        Type of OAuth prompt (defaults to 'consent')
		 * @param  string       $redirect_uri  One of the Redirect URIs from the Application's Settings page
		 * @param  string       $response_type Type of authorization response (defaults to 'code')
		 * @param  array|string $scope         Array or space-separated string of OAuth scope nodes (defaults to 'identify')
		 * @return string                      Authorization URL
		 */
		public function getAuthorizationURL(...$arguments) : string {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			if (!isset($this->parent->authorization["client_id"], $this->parent->authorization["client_secret"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client/Application ID (client_id) and Client Secret (client_secret) during \\Discorderly::connect() when using " . \get_called_class() . "::getAuthorizationURL()");
			}

			if (!isset($arguments["redirect_uri"])) {
				throw new \Discorderly\Response\Exception("You must supply a Redirect URI (redirect_uri) when using " . \get_called_class() . "::getAuthorizationURL()");
			}

			if (!isset($arguments["scope"])) {
				$arguments["scope"] = "identify";
			}

			else {
				if (\is_array($arguments["scope"] ?? "")) {
					$arguments["scope"] = \implode(" ", \array_unique(\array_merge($arguments["scope"]), [ "identify" ]));
				}

				else if (!\str_contains($arguments["scope"] ?? "", "identify")) {
					$arguments["scope"] .= " identify";
				}
			}

			return "https://discord.com/api/oauth2/authorize?" . \http_build_query(\array_merge($arguments, [
				"client_id"     => $this->parent->authorization["client_id"],
				"client_secret" => $this->parent->authorization["client_secret"],
				"prompt"        => \trim($arguments["prompt"]        ?? "consent"),
				"response_type" => \trim($arguments["response_type"] ?? "code"),
				"scope"         => \trim($arguments["scope"]),
			]));
		}

		/**
		 * Get this user's connections
		 * @return array Array of Connection instances
		 */
		public function getConnections() : array {
			if (!isset($this->connections)) {
				if (!isset($this->parent)) {
					throw new \Discorderly\Response\OrphanedInstanceException();
				}

				$connections = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . ($this->is_me ? "@me" : $this->id) . "/connections",
					type:     "get",
				);

				$this->connections = \array_map(fn($connection) => $this->parent->Connection($connection["id"])->__populate($connection), $connections);
			}

			return $this->connections;
		}

		/**
		 * Get this user's guilds
		 * @param  int   $before Get guilds before this guild ID
		 * @param  int   $after  Get guilds after this guild ID
		 * @param  int   $limit  Max number of guilds to return (1-200)
		 * @return array         Array of Guild instances
		 */
		public function getGuilds(int $before = 0, int $after = 0, int $limit = 200) : array {
			if (!isset($this->guilds[$before][$after][$limit])) {
				if (!isset($this->parent)) {
					throw new \Discorderly\Response\OrphanedInstanceException();
				}

				$guilds = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/guilds",
					type:     "get",
					data:     \array_merge(
						$before > 0 ? [ "before" => $before ] : [],
						$after  > 0 ? [ "after"  => $after  ]  : [],
						              [ "limit"  => $limit  ],
					),
				);

				$this->guilds[$before][$after][$limit] = \array_map(fn($guild) => $this->parent->Guild($guild["id"])->__populate($guild), $guilds);
			}

			return $this->guilds[$before][$after][$limit];
		}

		/**
		 * Leave a guild
		 * @param  int  $guild_id The guild ID to leave
		 * @return self
		 */
		public function leaveGuild(int $guild_id) : self {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			$this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . ($this->is_me ? "@me" : $this->id) . "/guilds/" . $guild_id,
				type:     "delete",
			);

			return $this;
		}
	}
