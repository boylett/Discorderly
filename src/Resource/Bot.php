<?php

	namespace Discorderly\Resource;

	class Bot extends \Discorderly\Resource\User {
		/**
		 * The current bot's application instance
		 * @var \Discorderly\Resource\Application
		 */
		public NULL|\Discorderly\Resource\Application $application;

		/**
		 * Get the current bot's application instance
		 * @return \Discorderly\Resource\Application Application instance
		 */
		public function getApplication() : \Discorderly\Resource\Application {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			if (!isset($this->application)) {
				$application = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . "/oauth2/applications/@me",
					type:     "get",
				);

				$this->application = $this->parent->Application($application["id"])->__populate($application);
			}

			return $this->application;
		}

		/**
		 * Get the Bot Installation URL
		 * @param  array|string $scope                An array or space-separated list of OAuth2 scopes (see constants in \Discorderly\Response\AccessToken)
		 * @param  int          $permissions          The permissions you're requesting - defaults to 8 (https://discordapi.com/permissions.html)
		 * @param  int          $guild_id             Pre-fills the dropdown picker with a guild for the user
		 * @param  bool         $disable_guild_select Disallows the user from changing the guild dropdown
		 * @return string                             Bot Installation URL
		 */
		public function getOAuthUrl(...$arguments) : string {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			if (!isset($this->parent->authorization["client_id"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client/Application ID (client_id) during \\Discorderly::connect() when using " . \get_called_class() . "::getOAuthUrl()");
			}

			if (empty($arguments["scope"] ?? "")) {
				$arguments["scope"] = \Discorderly\Resource\AccessToken::SCOPE_BOT;
			}

			else if (\is_array($arguments["scope"] ?? "")) {
				$arguments["scope"] = \implode(" ", \array_unique(\array_merge($arguments["scope"]), [ \Discorderly\Resource\AccessToken::SCOPE_BOT ]));
			}

			else if (!\str_contains($arguments["scope"] ?? "", \Discorderly\Resource\AccessToken::SCOPE_BOT)) {
				$arguments["scope"] .= " " . \Discorderly\Resource\AccessToken::SCOPE_BOT;
			}

			return "https://discord.com/api/oauth2/authorize?" . \http_build_query(\array_merge([
				"permissions" => 8,
			], $arguments, [
				"client_id"   => $this->parent->authorization["client_id"],
			]));
		}

		/**
		 * Request an OAuth2 token from Discord
		 * @param  array|string                      $scope Array or space-separated string of bot token scopes
		 * @return \Discorderly\Resource\AccessToken
		 */
		public function requestOAuthToken(array|string $scope = "") : \Discorderly\Resource\AccessToken {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			if (!isset($this->parent->authorization["client_id"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client/Application ID (client_id) during \\Discorderly::connect() when using " . \get_called_class() . "::getOAuthUrl()");
			}

			if (!isset($this->parent->authorization["client_secret"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client Secret (client_secret) during \\Discorderly::connect() when using " . \get_called_class() . "::getOAuthUrl()");
			}

			if (empty($scope ?? "")) {
				$scope = \Discorderly\Resource\AccessToken::SCOPE_IDENTIFY;
			}

			else if (\is_array($scope ?? "")) {
				$scope = \implode(" ", \array_unique(\array_merge($scope), [ \Discorderly\Resource\AccessToken::SCOPE_IDENTIFY ]));
			}

			else if (!\str_contains($scope ?? "", \Discorderly\Resource\AccessToken::SCOPE_IDENTIFY)) {
				$scope .= " " . \Discorderly\Resource\AccessToken::SCOPE_IDENTIFY;
			}

			$token = $this->parent->request(
				authorization: false,
				endpoint:      \Discorderly\Discorderly::endpoint . "/oauth2/token",
				type:          "post",
				options:       [
					"auth" => [
						$this->parent->authorization["client_id"],
						$this->parent->authorization["client_secret"],
					],
				],
				form_params:   [
					"scope"      => $scope,
					"grant_type" => "client_credentials",
				],
			);

			return \Discorderly\Resource\AccessToken::__instance()->__populate($token);
		}
	}
