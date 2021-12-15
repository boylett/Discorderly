<?php

	namespace Discorderly;

	final class Discorderly {
		/**
		 * @var string Discord API endpoint
		 */
		const endpoint = "https://discord.com/api";

		/**
		 * @var string Vanity URL endpoint
		 */
		const VANITY_URL_ENDPOINT = "https://discord.gg";

		/**
		 * Custom Emoji (PNG, JPEG, WebP, GIF)
		 * @var string
		 */
		const CDN_ENDPOINT_CUSTOM_EMOJI = "emojis/:emoji_id.:format";
		
		/**
		 * Guild Icon (PNG, JPEG, WebP, GIF)
		 * @var string
		 */
		const CDN_ENDPOINT_GUILD_ICON = "icons/:guild_id/:guild_icon.:format";
		
		/**
		 * Guild Splash (PNG, JPEG, WebP)
		 * @var string
		 */
		const CDN_ENDPOINT_GUILD_SPLASH = "splashes/:guild_id/:guild_splash.:format";
		
		/**
		 * Guild Discovery Splash (PNG, JPEG, WebP)
		 * @var string
		 */
		const CDN_ENDPOINT_GUILD_DISCOVERY_SPLASH = "discovery-splashes/:guild_id/:guild_discovery_splash.:format";
		
		/**
		 * Guild Banner (PNG, JPEG, WebP)
		 * @var string
		 */
		const CDN_ENDPOINT_GUILD_BANNER = "banners/:guild_id/:guild_banner.:format";
		
		/**
		 * User Banner (PNG, JPEG, WebP, GIF)
		 * @var string
		 */
		const CDN_ENDPOINT_USER_BANNER = "banners/:user_id/:user_banner.:format";
		
		/**
		 * Default User Avatar (PNG)
		 * @var string
		 */
		const CDN_ENDPOINT_DEFAULT_USER_AVATAR = "embed/avatars/:user_discriminator.png";
		
		/**
		 * User Avatar (PNG, JPEG, WebP, GIF)
		 * @var string
		 */
		const CDN_ENDPOINT_USER_AVATAR = "avatars/:user_id/:user_avatar.:format";
		
		/**
		 * Guild Member Avatar (PNG, JPEG, WebP, GIF)
		 * @var string
		 */
		const CDN_ENDPOINT_GUILD_MEMBER_AVATAR = "guilds/:guild_id/users/:user_id/avatars/:member_avatar.:format";
		
		/**
		 * Application Icon (PNG, JPEG, WebP)
		 * @var string
		 */
		const CDN_ENDPOINT_APPLICATION_ICON = "app-icons/:application_id/:icon.:format";
		
		/**
		 * Application Cover (PNG, JPEG, WebP)
		 * @var string
		 */
		const CDN_ENDPOINT_APPLICATION_COVER = "app-icons/:application_id/:cover_image.:format";
		
		/**
		 * Application Asset (PNG, JPEG, WebP)
		 * @var string
		 */
		const CDN_ENDPOINT_APPLICATION_ASSET = "app-assets/:application_id/:asset_id.:format";
		
		/**
		 * Achievement Icon (PNG, JPEG, WebP)
		 * @var string
		 */
		const CDN_ENDPOINT_ACHIEVEMENT_ICON = "app-assets/:application_id/achievements/:achievement_id/icons/:icon_hash.:format";
		
		/**
		 * Sticker Pack Banner (PNG, JPEG, WebP)
		 * @var string
		 */
		const CDN_ENDPOINT_STICKER_PACK_BANNER = "app-assets/710982414301790216/store/:sticker_pack_banner_asset_id.:format";
		
		/**
		 * Team Icon (PNG, JPEG, WebP)
		 * @var string
		 */
		const CDN_ENDPOINT_TEAM_ICON = "team-icons/:team_id/:team_icon.:format";
		
		/**
		 * Sticker (PNG, Lottie)
		 * @var string
		 */
		const CDN_ENDPOINT_STICKER = "stickers/:sticker_id.:format";
		
		/**
		 * Role Icon (PNG, JPEG, WebP)
		 * @var string
		 */
		const CDN_ENDPOINT_ROLE_ICON = "role-icons/:role_id/:role_icon.:format";

		/**
		 * @var \Discorderly\Resource\Application Application instance storage
		 */
		public static \Discorderly\Resource\Application $application;

		/**
		 * @var array Authorization storage
		 */
		public array $authorization = [];

		/**
		 * @var array Channel instance storage
		 */
		private static array $channels = [];

		/**
		 * @var array Guild instance storage
		 */
		private static array $guilds = [];

		/**
		 * @var array Voice Region instance storage
		 */
		private static array $regions = [];

		/**
		 * @var array User instance storage
		 */
		private static array $users = [];

		/**
		 * Create a base64 encoded data string for a file
		 * @param  string $filename Absolute path to the file
		 * @return string           Base64 data
		 */
		public static function base64_encode(string $filename) : string {
			if (!\file_exists($filename)) {
				throw new \Discorderly\Response\Exception("File not found: " . $filename);
			}

			return "data:" . \mime_content_type($filename) . ";base64," . \base64_encode(\file_get_contents($filename));
		}

		/**
		 * Disallow serialization for security purposes
		 */
		public function __serialize() : array { return []; }

		/**
		 * Connect Discorderly to the Discord API
		 * @param string $client_id     Client or Application ID
		 * @param string $client_secret Client Secret
		 * @param string $public_key    Public Key
		 * @param string $access_token  OAuth Access Token if $type is 'oauth'
		 * @param string $bot_token     Bot Token if $type is 'bot'
		 * @param string $type          Wether to connect via Bot Token (bot) or OAuth Access Token (oauth)
		 */
		public function connect(...$arguments) : self {
			\extract($arguments);

			if (isset($client_id)) {
				$this->authorization["client_id"] = $client_id;
			}

			if (isset($client_secret)) {
				$this->authorization["client_secret"] = $client_secret;
			}

			if (isset($public_key)) {
				$this->authorization["public_key"] = $public_key;
			}

			switch ($type ?? "oauth") {
				case "bot": {
					if (isset($bot_token)) {
						$this->authorization["type"]      = $type;
						$this->authorization["bot_token"] = $bot_token;
					}

					else {
						throw new \Discorderly\Response\Exception("You must supply a Bot Token (bot_token) when using \\Discorderly::connect(type: 'bot')");
					}
				}

				break;

				case "oauth": {
					if (isset($access_token)) {
						$this->authorization["type"]         = $type;
						$this->authorization["access_token"] = $access_token;
					}

					else {
						throw new \Discorderly\Response\Exception("You must supply an Access Token (access_token) when using \\Discorderly::connect(type: 'oauth')");
					}
				}

				break;

				default: {
					throw new \Discorderly\Response\Exception("Unknown connection type '" . $type . "'");
				}

				break;
			}

			return $this;
		}

		/**
		 * Get the OAuth2 authorization request URL
		 * @param  array|string $scope         An array or space-separated list of OAuth2 scopes (see constants in \Discorderly\Response\AccessToken)
		 * @param  string       $prompt        Controls how the authorization flow handles existing authorizations. Can be set to 'none' or 'consent' - defaults to 'consent'
		 * @param  string       $redirect_uri  Whatever URL you registered when creating your application
		 * @param  string       $response_type Whether to request an implicit grant ('token') or explicit grant ('code') - defaults to 'code'
		 * @param  string       $state         Unique verification string or hash to verify connection origin
		 * @return string                      OAuth2 authorization URL
		 */
		public function getOAuthUrl(...$arguments) : string {
			if (!isset($this->authorization["client_id"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client/Application ID (client_id) during \\Discorderly::connect() when using " . \get_called_class() . "::getOAuthUrl()");
			}

			if (!isset($this->authorization["client_secret"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client Secret (client_secret) during \\Discorderly::connect() when using " . \get_called_class() . "::getOAuthUrl()");
			}

			if (!isset($arguments["redirect_uri"])) {
				throw new \Discorderly\Response\Exception("You must supply a Redirect URI (redirect_uri) when using " . \get_called_class() . "::getOAuthUrl()");
			}
			
			if (empty($arguments["scope"] ?? "")) {
				$arguments["scope"] = \Discorderly\Resource\AccessToken::SCOPE_IDENTIFY;
			}

			else if (\is_array($arguments["scope"] ?? "")) {
				$arguments["scope"] = \implode(" ", \array_unique(\array_merge($arguments["scope"]), [ \Discorderly\Resource\AccessToken::SCOPE_IDENTIFY ]));
			}

			else if (!\str_contains($arguments["scope"] ?? "", \Discorderly\Resource\AccessToken::SCOPE_IDENTIFY)) {
				$arguments["scope"] .= " " . \Discorderly\Resource\AccessToken::SCOPE_IDENTIFY;
			}

			$arguments["response_type"] ??= "code";

			if (!isset($arguments["state"])) {
				$left     = \hash("CRC32B", __FILE__ . \random_bytes(8));
				$time_max = \strtotime("+1 hour");
				$right    = \hash("CRC32B", $left . "Discorderly OAuth State Hash" . $time_max);

				$arguments["state"] = $left . $time_max . $right;
			}

			return static::endpoint . "/oauth2/authorize?" . \http_build_query(\array_merge([
				"prompt"        => "consent",
			], $arguments, [
				"client_id"     => $this->authorization["client_id"],
			], ($arguments["response_type"] === "token") ? [] : [
				"client_secret" => $this->authorization["client_secret"],
			]));
		}


		/**
		 * Handle a Discord Webhook interaction
		 * @param  callable $callback Callback method that handles the interaction. Arguments: (array $payload, array $headers)
		 * @return self
		 */
		public function receiveWebhook(callable $callback) : self {
			if (!isset($this->authorization["public_key"])) {
				throw new \Discorderly\Response\Exception("You must supply a Public Key (public_key) during \\Discorderly::connect() when using " . \get_called_class() . "::receiveWebhook()");
			}

			/**
			 * @link https://github.com/discord/discord-api-docs/issues/2359#issuecomment-747861579
			 */
			$_HEADERS     = \getallheaders();
			$content_type = $_HEADERS["Content-Type"]          ?? "";
			$signature    = $_HEADERS["X-Signature-Ed25519"]   ?? "";
			$timestamp    = $_HEADERS["X-Signature-Timestamp"] ?? "";

			if ($signature and $timestamp) {
				$binary_signature = \function_exists("sodium_hex2bin") ? \sodium_hex2bin($signature) : \hex2bin($signature);
				$binary_key       = \function_exists("sodium_hex2bin") ? \sodium_hex2bin($this->authorization["public_key"]) : \hex2bin($this->authorization["public_key"]);

				$body    = \file_get_contents("php://input");
				$message = $timestamp . $body;

				$verified = \function_exists("sodium_crypto_sign_verify_detached") ? \sodium_crypto_sign_verify_detached($binary_signature, $message, $binary_key) : \crypto_sign_verify_detached($binary_signature, $message, $binary_key);

				if (!$verified) {
					\header("HTTP/1.0 401 Unauthorized");

					throw new \Discorderly\Response\Exception("Discorderly webhook interaction failed authorization (401 Unauthorized)");
				}

				$payload = \json_decode($body, true);

				\call_user_func_array($callback, [$payload, $_HEADERS]);
			}

			else {
				\header("HTTP/1.0 400 Bad Request");

				throw new \Discorderly\Response\Exception("Discorderly webhook interaction failed (400 Bad Request)");
			}

			return $this;
		}

		/**
		 * Refresh an OAuth2 token with Discord
		 * @param  string                            $refresh_token Refresh token
		 * @return \Discorderly\Resource\AccessToken
		 */
		public function refreshOAuthToken(string $refresh_token) : \Discorderly\Resource\AccessToken {
			if (!isset($this->authorization["client_id"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client/Application ID (client_id) during \\Discorderly::connect() when using " . \get_called_class() . "::refreshOAuthToken()");
			}

			if (!isset($this->authorization["client_secret"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client Secret (client_secret) during \\Discorderly::connect() when using " . \get_called_class() . "::refreshOAuthToken()");
			}

			$token = $this->request(
				authorization: false,
				endpoint:      static::endpoint . "/oauth2/token",
				type:          "post",
				form_params:   [
					"client_id"     => $this->authorization["client_id"],
					"client_secret" => $this->authorization["client_secret"],
					"grant_type"    => "refresh_token",
					"refresh_token" => $refresh_token,
				],
			);

			return \Discorderly\Resource\AccessToken::__instance()->__populate($token);
		}

		/**
		 * Make a request to the Discord API
		 * @param  string       $type     HTTP request type - one of "delete", "get", "head", "patch", "post" or "put"
		 * @param  string       $endpoint Relative path to Discord API endpoint
		 * @param  array|string $data     Payload data
		 * @return array                  JSON response
		 */
		public function request(...$arguments) : array {
			\extract($arguments);

			$data       ??= [];
			$options    ??= [];
			$response     = [];
			$send_empty ??= false;
			$type         = \strtoupper($type ?? "get");

			if (!isset($endpoint)) {
				throw new \Discorderly\Response\Exception("Endpoint (endpoint) not defined in " . \get_called_class());
			}

			if (\str_contains($endpoint, ":")) {
				$endpoint = \preg_replace_callback_array([
					"/:([^:\/$]+)/" => function ($matches) use (&$data) {
						if (isset($data[$matches[1]])) {
							$value = $data[$matches[1]];

							unset($data[$matches[1]]);

							return $value;
						}
						
						throw new \Discorderly\Response\Exception("Endpoint variable " . $matches[0] . " not supplied in " . \get_called_class() . "::request()");
					},
				], $endpoint);
			}

			if (!in_array($type, [ "DELETE", "GET", "HEAD", "PATCH", "POST", "PUT" ])) {
				throw new \Discorderly\Response\Exception("Unknown HTTP request type '" . $type . "'");
			}

			if (!empty($data ?? []) and \in_array($type, [ "DELETE", "GET", "HEAD" ])) {
				$endpoint .= \str_contains($endpoint, "?") ? "&" : "?";
				$endpoint .= \http_build_query($data);

				unset($data);
			}

			if ($authorization ?? true) {
				$options = [
					"headers" => [
						"Authorization" => match($this->authorization["type"] ?? false) {
							"bot"   => "Bot "    . $this->authorization["bot_token"],
							"oauth" => "Bearer " . $this->authorization["access_token"],
							default => "",
						},
					],
				];
			}

			if (isset($arguments["form_params"])) {
				$options["form_params"] = $form_params;
			}

			else if (isset($arguments["data"])) {
				if (isset($data["file"])) {
					$file = $data["file"];

					unset($data["file"]);

					/**
					 * @link https://issueexplorer.com/issue/discord/discord-api-docs/3969
					 */
					foreach ($data as $key => $value) {
						$options["multipart"][] = [
							"name"     => $key,
							"contents" => $value,
						];
					}

					$options["multipart"][] = [
						"name"     => "file",
						"contents" => \fopen($file, "r"),
						"filename" => \basename($file),
						"headers"  => [
							"Content-Type" => \mime_content_type($file),
						],
					];
				}

				else if (isset($data["files"])) {
					$files = $data["files"];

					unset($data["files"]);

					if (!empty($data) or $send_empty) {
						$options["multipart"][] = [
							"name"     => "payload_json",
							"contents" => \json_encode($data),
							"headers"  => [
								"Content-Type" => "application/json",
							],
						];
					}

					foreach ($files as $index => $filename) {
						$options["multipart"][] = [
							"name"     => "files[" . $index . "]",
							"contents" => \fopen($filename, "r"),
							"filename" => \basename($filename),
							"headers"  => [
								"Content-Type" => \mime_content_type($filename),
							],
						];
					}
				}

				else {
					if (!isset($options["headers"]["Content-Type"])) {
						$options["headers"]["Content-Type"] = "application/json; charset=utf-8";
					}

					if (!empty($data) or $send_empty) {
						$options["json"] = $data;
					}
				}
			}

			$guzzle  = new \GuzzleHttp\Client([ "http_errors" => false ]);
			$request = $guzzle->request($type, $endpoint, $options);

			$json = @\json_decode(\trim($request->getBody()) ?: "[]", true);

			if (\json_last_error() === JSON_ERROR_NONE) {
				if (isset($json["error"]) or isset($json["error_description"])) {
					throw new \Discorderly\Response\Exception(\ucwords($type) . " failed for '" . $endpoint . "' with Error Code " . $json["error"] . " in " . \get_called_class() . (($json["error_description"] ?? false) ? ":\n" . $json["error_description"] : "") . "\n" . \print_r($options, true));
				}

				else if (isset($json["message"]) and isset($json["code"])) {
					throw new \Discorderly\Response\Exception(\ucwords($type) . " failed for '" . $endpoint . "' with Error Code " . $json["code"] . " in " . \get_called_class() . ":\n" . $json["message"] . "\n" . \print_r($options, true), $json["code"]);
				}

				else if (\count($json) === 1 and isset($json["_misc"])) {
					throw new \Discorderly\Response\Exception(\ucwords($type) . " failed for '" . $endpoint . "' with HTTP " . $request->getStatusCode() . " in " . \get_called_class() . ":\n" . \print_r($json["_misc"], true) . "\n" . \print_r($options, true));
				}

				return $json;
			}

			throw new \Discorderly\Response\Exception(\ucwords($type) . " failed for '" . $endpoint . "' with HTTP " . $request->getStatusCode() . " in " . \get_called_class() . ":\n" . $request->getBody());

			return [];
		}

		/**
		 * Request an OAuth2 token from Discord
		 * @param  string                            $redirect_uri Your redirect URI
		 * @param  string                            $code         The code from the querystring
		 * @return \Discorderly\Resource\AccessToken
		 */
		public function requestOAuthToken(string $redirect_uri, string $code = "") : \Discorderly\Resource\AccessToken {
			if (!isset($this->authorization["client_id"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client/Application ID (client_id) during \\Discorderly::connect() when using " . \get_called_class() . "::requestOAuthToken()");
			}

			if (!isset($this->authorization["client_secret"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client Secret (client_secret) during \\Discorderly::connect() when using " . \get_called_class() . "::requestOAuthToken()");
			}

			$token = $this->request(
				authorization: false,
				endpoint:      static::endpoint . "/oauth2/token",
				type:          "post",
				form_params:   [
					"client_id"     => $this->authorization["client_id"],
					"client_secret" => $this->authorization["client_secret"],
					"code"          => $code ?: ($_GET["code"] ?? ""),
					"grant_type"    => "authorization_code",
					"redirect_uri"  => $redirect_uri,
				],
			);

			return \Discorderly\Resource\AccessToken::__instance()->__populate($token);
		}

		/**
		 * Revoke an OAuth2 token
		 * @param  string $access_token Access token
		 * @return bool
		 */
		public function revokeOAuthToken(string $access_token) : bool {
			if (!isset($this->authorization["client_id"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client/Application ID (client_id) during \\Discorderly::connect() when using " . \get_called_class() . "::revokeOAuthToken()");
			}

			if (!isset($this->authorization["client_secret"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client Secret (client_secret) during \\Discorderly::connect() when using " . \get_called_class() . "::revokeOAuthToken()");
			}

			$this->request(
				authorization: false,
				endpoint:      static::endpoint . "/oauth2/token/revoke",
				type:          "post",
				form_params:   [
					"client_id"     => $this->authorization["client_id"],
					"client_secret" => $this->authorization["client_secret"],
					"token"         => $access_token,
				],
			);

			return true;
		}

		/**
		 * Verify the supplied OAuth State Hash
		 * @param  string $state State hash
		 * @return bool          Whether the state hash is valid
		 */
		public function verifyOAuthState(string $state) : bool {
			if (\preg_match("/^([a-f0-9]{8})([0-9]+)([a-f0-9]{8})$/i", $state, $parts)) {
				$left     = $parts[1] ?? "";
				$time_max = \intval($parts[2] ?? 0);
				$right    = $parts[3] ?? "";
				$hash     = \hash("CRC32B", $left . "Discorderly OAuth State Hash" . $time_max);

				if ($hash === $right and $time_max > \time()) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Get the current Application instance
		 * @return \Discorderly\Resource\Application
		 */
		public function Application() : \Discorderly\Resource\Application {
			if (!isset(static::$application)) {
				static::$application = new \Discorderly\Resource\Application(
					parent: $this,
				);
			}

			return static::$application;
		}

		/**
		 * Get a Bot user instance
		 * @param  int|string                $user_id The Bot User ID (defaults to @me)
		 * @return \Discorderly\Resource\Bot
		 */
		public function Bot(int|string $user_id = "@me") : \Discorderly\Resource\Bot {
			if ($user_id == 0) {
				return \Discorderly\Resource\Bot::__instance(
					parent: $this,
				);
			}

			return \Discorderly\Resource\Bot::__instance(
				parent: $this,
				id:     $user_id,
			);
		}

		/**
		 * Get a Channel instance
		 * @param  int                           $channel_id The Channel ID
		 * @return \Discorderly\Resource\Channel
		 */
		public function Channel(int $channel_id = 0) : \Discorderly\Resource\Channel {
			if ($channel_id === 0) {
				return \Discorderly\Resource\Channel::__instance(
					parent: $this,
				);
			}

			return \Discorderly\Resource\Channel::__instance(
				parent: $this,
				id:     $channel_id,
			);
		}

		/**
		 * Create a new Connection instance
		 * @param  int                              $connection_id The Connection ID
		 * @return \Discorderly\Resource\Connection
		 */
		public function Connection(int $connection_id = 0) : \Discorderly\Resource\Connection {
			if ($connection_id === 0) {
				return \Discorderly\Resource\Connection::__instance(
					parent: $this,
				);
			}

			return \Discorderly\Resource\Connection::__instance(
				id: $connection_id,
			);
		}

		/**
		 * Get a DM instance
		 * @param  int                      $channel_id The DM ID
		 * @return \Discorderly\Resource\DM
		 */
		public function DM(int $channel_id = 0) : \Discorderly\Resource\DM {
			if ($channel_id === 0) {
				return \Discorderly\Resource\DM::__instance(
					parent: $this,
				);
			}

			return \Discorderly\Resource\DM::__instance(
				parent: $this,
				id:     $channel_id,
			);
		}

		/**
		 * Get an Emoji instance
		 * @param  int                         $emoji_id The Emoji ID
		 * @return \Discorderly\Resource\Emoji
		 */
		public function Emoji(int $emoji_id = 0) : \Discorderly\Resource\Emoji {
			if ($emoji_id === 0) {
				return \Discorderly\Resource\Emoji::__instance(
					parent: $this,
				);
			}

			return \Discorderly\Resource\Emoji::__instance(
				parent: $this,
				id:     $emoji_id,
			);
		}

		/**
		 * Get a Guild instance
		 * @param  int                         $guild_id The Guild ID
		 * @return \Discorderly\Resource\Guild
		 */
		public function Guild(int $guild_id = 0) : \Discorderly\Resource\Guild {
			if ($guild_id === 0) {
				return \Discorderly\Resource\Guild::__instance(
					parent: $this,
				);
			}

			return \Discorderly\Resource\Guild::__instance(
				parent: $this,
				id:     $guild_id,
			);
		}

		/**
		 * Get a Invite instance
		 * @param  string                       $invite_code The Invite ID
		 * @return \Discorderly\Resource\Invite
		 */
		public function Invite(string $invite_code = "") : \Discorderly\Resource\Invite {
			if ($invite_code === "") {
				return \Discorderly\Resource\Invite::__instance(
					parent: $this,
				);
			}

			return \Discorderly\Resource\Invite::__instance(
				parent: $this,
				code:   $invite_code,
			);
		}

		/**
		 * Get a Member instance
		 * @return \Discorderly\Resource\Member
		 */
		public function Member() : \Discorderly\Resource\Member {
			return \Discorderly\Resource\Member::__instance(
				parent: $this,
			);
		}

		/**
		 * Get a Message instance
		 * @param  int                           $message_id The Message ID
		 * @return \Discorderly\Resource\Message
		 */
		public function Message(int $message_id = 0) : \Discorderly\Resource\Message {
			if ($message_id === 0) {
				return \Discorderly\Resource\Message::__instance(
					parent: $this,
				);
			}

			return \Discorderly\Resource\Message::__instance(
				parent: $this,
				id:     $message_id,
			);
		}

		/**
		 * Create a new Region instance
		 * @param  string                       $region_id The Region ID
		 * @return \Discorderly\Resource\Region
		 */
		public function Region(string $region_id = "") : \Discorderly\Resource\Region {
			if ($region_id === "") {
				return \Discorderly\Resource\Region::__instance();
			}

			return \Discorderly\Resource\Region::__instance(
				id: $region_id,
			);
		}

		/**
		 * Get a Role instance
		 * @param  int                        $role_id The Role ID
		 * @return \Discorderly\Resource\Role
		 */
		public function Role(int $role_id = 0) : \Discorderly\Resource\Role {
			if ($role_id === 0) {
				return \Discorderly\Resource\Role::__instance(
					parent: $this,
				);
			}

			return \Discorderly\Resource\Role::__instance(
				parent: $this,
				id:     $role_id,
			);
		}

		/**
		 * Get a Sticker instance
		 * @param  int                           $sticker_id The Sticker ID
		 * @return \Discorderly\Resource\Sticker
		 */
		public function Sticker(int $sticker_id = 0) : \Discorderly\Resource\Sticker {
			if ($sticker_id === 0) {
				return \Discorderly\Resource\Sticker::__instance(
					parent: $this,
				);
			}

			return \Discorderly\Resource\Sticker::__instance(
				parent: $this,
				id:     $sticker_id,
			);
		}

		/**
		 * Get a StickerPack instance
		 * @param  int                               $sticker_pack_id The StickerPack ID
		 * @return \Discorderly\Resource\StickerPack
		 */
		public function StickerPack(int $sticker_pack_id = 0) : \Discorderly\Resource\StickerPack {
			if ($sticker_pack_id === 0) {
				return \Discorderly\Resource\StickerPack::__instance(
					parent: $this,
				);
			}

			return \Discorderly\Resource\StickerPack::__instance(
				parent: $this,
				id:     $sticker_pack_id,
			);
		}

		/**
		 * Get a Thread instance
		 * @param  int                          $channel_id The Thread ID
		 * @return \Discorderly\Resource\Thread
		 */
		public function Thread(int $channel_id = 0) : \Discorderly\Resource\Thread {
			if ($channel_id === 0) {
				return \Discorderly\Resource\Thread::__instance(
					parent: $this,
				);
			}

			return \Discorderly\Resource\Thread::__instance(
				parent: $this,
				id:     $channel_id,
			);
		}

		/**
		 * Get a User instance
		 * @param  string                     $user_id The User ID (defaults to @me)
		 * @return \Discorderly\Resource\User
		 */
		public function User(string $user_id = "@me") : \Discorderly\Resource\User {
			if ($user_id == 0) {
				return \Discorderly\Resource\User::__instance(
					parent: $this,
				);
			}

			if ($user_id === "@me") {
				return \Discorderly\Resource\User::__instance(
					parent: $this,
					is_me:  true,
				);
			}

			return \Discorderly\Resource\User::__instance(
				parent: $this,
				id:     $user_id,
			);
		}
	}
