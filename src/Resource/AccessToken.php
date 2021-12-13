<?php

	namespace Discorderly\Resource;

	class AccessToken extends \Discorderly\Resource\AbstractStaticResource {
		/**
		 * Allows your app to fetch data from a user's "Now Playing/Recently Played" list - requires Discord approval
		 * @var string
		 */
		const SCOPE_ACTIVITIES_READ = "activities.read";
		
		/**
		 * Allows your app to update a user's activity - requires Discord approval (NOT REQUIRED FOR GAMESDK ACTIVITY MANAGER)
		 * @var string
		 */
		const SCOPE_ACTIVITIES_WRITE = "activities.write";
		
		/**
		 * Allows your app to read build data for a user's applications
		 * @var string
		 */
		const SCOPE_APPLICATIONS_BUILDS_READ = "applications.builds.read";
		
		/**
		 * Allows your app to upload/update builds for a user's applications - requires Discord approval
		 * @var string
		 */
		const SCOPE_APPLICATIONS_BUILDS_UPLOAD = "applications.builds.upload";
		
		/**
		 * Allows your app to use commands in a guild
		 * @var string
		 */
		const SCOPE_APPLICATIONS_COMMANDS = "applications.commands";
		
		/**
		 * Allows your app to update its commands via this bearer token - client credentials grant only
		 * @var string
		 */
		const SCOPE_APPLICATIONS_COMMANDS_UPDATE = "applications.commands.update";
		
		/**
		 * Allows your app to read entitlements for a user's applications
		 * @var string
		 */
		const SCOPE_APPLICATIONS_ENTITLEMENTS = "applications.entitlements";
		
		/**
		 * Allows your app to read and update store data (SKUs, store listings, achievements, etc.) for a user's applications
		 * @var string
		 */
		const SCOPE_APPLICATIONS_STORE_UPDATE = "applications.store.update";
		
		/**
		 * For oauth2 bots, this puts the bot in the user's selected guild by default
		 * @var string
		 */
		const SCOPE_BOT = "bot";
		
		/**
		 * Allows /users/@me/connections to return linked third-party accounts
		 * @var string
		 */
		const SCOPE_CONNECTIONS = "connections";
		
		/**
		 * Enables /users/@me to return an email
		 * @var string
		 */
		const SCOPE_EMAIL = "email";
		
		/**
		 * Allows your app to join users to a group dm
		 * @var string
		 */
		const SCOPE_GDM_JOIN = "gdm.join";
		
		/**
		 * Allows /users/@me/guilds to return basic information about all of a user's guilds
		 * @var string
		 */
		const SCOPE_GUILDS = "guilds";
		
		/**
		 * Allows /guilds/{guild.id}/members/{user.id} to be used for joining users to a guild
		 * @var string
		 */
		const SCOPE_GUILDS_JOIN = "guilds.join";
		
		/**
		 * Allows /users/@me without email
		 * @var string
		 */
		const SCOPE_IDENTIFY = "identify";
		
		/**
		 * For local rpc server api access, this allows you to read messages from all client channels (otherwise restricted to channels/guilds your app creates)
		 * @var string
		 */
		const SCOPE_MESSAGES_READ = "messages.read";
		
		/**
		 * Allows your app to know a user's friends and implicit relationships - requires Discord approval
		 * @var string
		 */
		const SCOPE_RELATIONSHIPS_READ = "relationships.read";
		
		/**
		 * For local rpc server access, this allows you to control a user's local Discord client - requires Discord approval
		 * @var string
		 */
		const SCOPE_RPC = "rpc";
		
		/**
		 * For local rpc server access, this allows you to update a user's activity - requires Discord approval
		 * @var string
		 */
		const SCOPE_RPC_ACTIVITIES_WRITE = "rpc.activities.write";
		
		/**
		 * For local rpc server access, this allows you to receive notifications pushed out to the user - requires Discord approval
		 * @var string
		 */
		const SCOPE_RPC_NOTIFICATIONS_READ = "rpc.notifications.read";
		
		/**
		 * For local rpc server access, this allows you to read a user's voice settings and listen for voice events - requires Discord approval
		 * @var string
		 */
		const SCOPE_RPC_VOICE_READ = "rpc.voice.read";
		
		/**
		 * For local rpc server access, this allows you to update a user's voice settings - requires Discord approval
		 * @var string
		 */
		const SCOPE_RPC_VOICE_WRITE = "rpc.voice.write";
		
		/**
		 * This generates a webhook that is returned in the oauth token response for authorization code grants
		 * @var string
		 */
		const SCOPE_WEBHOOK_INCOMING = "webhook.incoming";

		/**
		 * @var string
		 */
		public string $access_token = "";
		
		/**
		 * @var string
		 */
		public string $token_type = "Bearer";
		
		/**
		 * @var int
		 */
		public int $expires_in = 604800;
		
		/**
		 * @var string
		 */
		public string $refresh_token = "";
		
		/**
		 * @var string
		 */
		public string $scope = "identify";
	}
