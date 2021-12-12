<?php

	namespace Discorderly\Resource;

	class DM extends \Discorderly\Resource\Channel {
		/**
		 * Adds a recipient to a Group DM using their access token
		 * @param  int    $user_id      User ID
		 * @param  string $access_token Access token of a user that has granted your app the gdm.join scope
		 * @param  string $nick         Nickname of the user being added
		 * @return self
		 */
		public function addRecipient(...$arguments) : self {
			if (empty($this->id ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Channel ID (id) when using " . \get_called_class() . "::__construct()");
			}

			if (empty($arguments["user_id"] ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a User ID (user_id) when using " . \get_called_class() . "::addRecipient()");
			}

			if (empty($arguments["access_token"] ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply an Access Token (access_token) when using " . \get_called_class() . "::addRecipient()");
			}

			$messages = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/recipients/" . $arguments["user_id"],
				type:     "put",
				data:     $arguments,
			);

			return $this;
		}

		/**
		 * Removes a recipient from a Group DM
		 * @param  int  $user_id User ID
		 * @return self
		 */
		public function removeRecipient(int $user_id) : self {
			if (empty($this->id ?? 0)) {
				throw new \Discorderly\Response\Exception("You must supply a Channel ID (id) when using " . \get_called_class() . "::__construct()");
			}

			$messages = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . "/" . $this->id . "/recipients/" . $user_id,
				type:     "delete",
			);

			return $this;
		}
	}
