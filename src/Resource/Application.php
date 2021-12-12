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
	}
