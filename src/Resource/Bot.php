<?php

	namespace Discorderly\Resource;

	class Bot extends \Discorderly\Resource\User {
		public function getAuthorizationURL(...$arguments) : string {
			if (!isset($this->parent->authorization["client_id"])) {
				throw new \Discorderly\Response\Exception("You must supply a Client/Application ID (client_id) during \\Discorderly::connect() when using " . \get_called_class() . "::getAuthorizationURL()");
			}

			if (!isset($arguments["guild_id"])) {
				throw new \Discorderly\Response\Exception("You must supply a Guild ID (guild_id) when using " . \get_called_class() . "::getAuthorizationURL()");
			}

			if (!isset($arguments["scope"])) {
				$arguments["scope"] = "bot";
			}

			else {
				if (\is_array($arguments["scope"] ?? "")) {
					$arguments["scope"] = \implode(" ", \array_unique(\array_merge($arguments["scope"]), [ "bot" ]));
				}

				else if (!\str_contains($arguments["scope"] ?? "", "bot")) {
					$arguments["scope"] .= " bot";
				}
			}

			return "https://discord.com/api/oauth2/authorize?" . \http_build_query(\array_merge($arguments, [
				"client_id"   => $this->parent->authorization["client_id"],
				"scope"       => \trim($arguments["scope"]),
			]));
		}
	}
