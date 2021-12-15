<?php

	namespace Discorderly\Resource;

	class Application extends \Discorderly\Resource\AbstractResource {
		/**
		 * API endpoint path
		 * @var string
		 */
		public string $endpoint = "/oauth2/applications/@me";

		/**
		 * The id of the app
		 * @var int
		 */
		public $id = 0;

		/**
		 * The name of the app
		 * @var string
		 */
		public NULL|string $name = "";

		/**
		 * The icon hash of the app
		 * @var string
		 */
		public NULL|string $icon = "";

		/**
		 * The description of the app
		 * @var string
		 */
		public NULL|string $description = "";

		/**
		 * An array of rpc origin urls, if rpc is enabled
		 * @var array
		 */
		public NULL|array $rpc_origins = [];

		/**
		 * When false only app owner can join the app's bot to guilds
		 * @var bool
		 */
		public NULL|bool $bot_public = true;

		/**
		 * When true the app's bot will only join upon completion of the full oauth2 code grant flow
		 * @var bool
		 */
		public NULL|bool $bot_require_code_grant = false;

		/**
		 * The url of the app's terms of service
		 * @var string
		 */
		public NULL|string $terms_of_service_url = "";

		/**
		 * The url of the app's privacy policy
		 * @var string
		 */
		public NULL|string $privacy_policy_url = "";

		/**
		 *\ResourceUser  User object containing info on the owner of the application
		 * @var \Discorderly
		 */
		public NULL|\Discorderly\Resource\User $owner;

		/**
		 * If this application is a game sold on Discord, this field will be the summary field for the store page of its primary sku
		 * @var string
		 */
		public NULL|string $summary = "";

		/**
		 * The hex encoded key for verification in interactions and the GameSDK's GetTicket
		 * @var string
		 */
		public NULL|string $verify_key = "";

		/**
		 * If the application belongs to a team, this will be a list of the members of that team
		 * @var array
		 */
		public NULL|array $team = [];

		/**
		 * If this application is a game sold on Discord, this field will be the guild to which it has been linked
		 * @var int
		 */
		public NULL|int $guild_id = 0;

		/**
		 * If this application is a game sold on Discord, this field will be the id of the "Game SKU" that is created, if exists
		 * @var int
		 */
		public NULL|int $primary_sku_id = 0;

		/**
		 * If this application is a game sold on Discord, this field will be the URL slug that links to the store page
		 * @var string
		 */
		public NULL|string $slug = "";

		/**
		 * The application's default rich presence invite cover image hash
		 * @var string
		 */
		public NULL|string $cover_image = "";

		/**
		 * The application's public flags
		 * @var int
		 */
		public NULL|int $flags = 0;

		/**
		 * The list of sticker packs available to Nitro subscribers
		 * @var array
		 */
		public NULL|array $sticker_packs = [];

		/**
		 * The application's available voice regions
		 * @var array
		 */
		public NULL|array $voice_regions = [];

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
			if (!isset($this->parent->authorization["client_id"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client/Application ID (client_id) during \\Discorderly::connect() when using " . \get_called_class() . "::getOAuthUrl()");
			}

			if (!isset($this->parent->authorization["client_secret"])) {
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

			return \Discorderly\Discorderly::endpoint . "/oauth2/authorize?" . \http_build_query(\array_merge([
				"prompt"        => "consent",
			], $arguments, [
				"client_id"     => $this->parent->authorization["client_id"],
			], ($arguments["response_type"] === "token") ? [] : [
				"client_secret" => $this->parent->authorization["client_secret"],
			]));
		}

		/**
		 * Returns the list of sticker packs available to Nitro subscribers
		 * @return array
		 */
		public function getStickerPacks() : array {
			if (empty($this->sticker_packs)) {
				$sticker_packs = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . "/sticker-packs",
					type:     "get",
				);

				$this->sticker_packs = \array_map(fn($sticker_pack) => $this->parent->StickerPack($sticker_pack["id"])->__populate($sticker_pack), $sticker_packs["sticker_packs"]);
			}

			return $this->sticker_packs;
		}

		/**
		 * Returns an array of voice region objects that can be used when setting a voice or stage channel's rtc_region
		 * @return array
		 */
		public function getVoiceRegions() : array {
			if (empty($this->voice_regions)) {
				$regions = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . "/voice/regions",
					type:     "get",
				);

				$this->voice_regions = \array_map(fn($region) => $this->parent->Region()->__populate($region), $regions);
			}

			return $this->voice_regions;
		}

		/**
		 * Handle a Discord Webhook interaction
		 * @param  callable $callback Callback method that handles the interaction. Arguments: (array $payload, array $headers)
		 * @return self
		 */
		public function receiveWebhook(callable $callback) : self {
			if (!isset($this->parent->authorization["public_key"])) {
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
				$binary_key       = \function_exists("sodium_hex2bin") ? \sodium_hex2bin($this->parent->authorization["public_key"]) : \hex2bin($this->parent->authorization["public_key"]);

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
			if (!isset($this->parent->authorization["client_id"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client/Application ID (client_id) during \\Discorderly::connect() when using " . \get_called_class() . "::refreshOAuthToken()");
			}

			if (!isset($this->parent->authorization["client_secret"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client Secret (client_secret) during \\Discorderly::connect() when using " . \get_called_class() . "::refreshOAuthToken()");
			}

			$token = $this->parent->request(
				authorization: false,
				endpoint:      \Discorderly\Discorderly::endpoint . "/oauth2/token",
				type:          "post",
				form_params:   [
					"client_id"     => $this->parent->authorization["client_id"],
					"client_secret" => $this->parent->authorization["client_secret"],
					"grant_type"    => "refresh_token",
					"refresh_token" => $refresh_token,
				],
			);

			return \Discorderly\Resource\AccessToken::__instance()->__populate($token);
		}

		/**
		 * Request an OAuth2 token from Discord
		 * @param  string                            $redirect_uri Your redirect URI
		 * @param  string                            $code         The code from the querystring
		 * @return \Discorderly\Resource\AccessToken
		 */
		public function requestOAuthToken(string $redirect_uri, string $code = "") : \Discorderly\Resource\AccessToken {
			if (!isset($this->parent->authorization["client_id"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client/Application ID (client_id) during \\Discorderly::connect() when using " . \get_called_class() . "::requestOAuthToken()");
			}

			if (!isset($this->parent->authorization["client_secret"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client Secret (client_secret) during \\Discorderly::connect() when using " . \get_called_class() . "::requestOAuthToken()");
			}

			$token = $this->parent->request(
				authorization: false,
				endpoint:      \Discorderly\Discorderly::endpoint . "/oauth2/token",
				type:          "post",
				form_params:   [
					"client_id"     => $this->parent->authorization["client_id"],
					"client_secret" => $this->parent->authorization["client_secret"],
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
			if (!isset($this->parent->authorization["client_id"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client/Application ID (client_id) during \\Discorderly::connect() when using " . \get_called_class() . "::revokeOAuthToken()");
			}

			if (!isset($this->parent->authorization["client_secret"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client Secret (client_secret) during \\Discorderly::connect() when using " . \get_called_class() . "::revokeOAuthToken()");
			}

			$this->parent->request(
				authorization: false,
				endpoint:      \Discorderly\Discorderly::endpoint . "/oauth2/token/revoke",
				type:          "post",
				form_params:   [
					"client_id"     => $this->parent->authorization["client_id"],
					"client_secret" => $this->parent->authorization["client_secret"],
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
	}
