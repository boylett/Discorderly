<?php

	namespace Discorderly\Resource;

	class Member extends \Discorderly\Resource\AbstractStaticResource {
		/**
		 * The user this guild member represents
		 * @var \Discorderly\Resource\User
		 */
		public \Discorderly\Resource\User $user;
		
		/**
		 * This users guild nickname
		 * @var string
		 */
		public NULL|string $nick = "";
		
		/**
		 * The member's guild avatar hash
		 * @var string
		 */
		public NULL|string $avatar = "";
		
		/**
		 * Array of role object ids
		 * @var array
		 */
		public NULL|array $roles = [];
		
		/**
		 * When the user joined the guild
		 * @var \DateTime
		 */
		public NULL|\DateTime $joined_at = NULL;
		
		/**
		 * When the user started boosting the guild
		 * @var \DateTime
		 */
		public NULL|\DateTime $premium_since = NULL;
		
		/**
		 * Whether the user is deafened in voice channels
		 * @var bool
		 */
		public NULL|bool $deaf = false;
		
		/**
		 * Whether the user is muted in voice channels
		 * @var bool
		 */
		public NULL|bool $mute = false;
		
		/**
		 * Whether the user has not yet passed the guild's Membership Screening requirements
		 * @var bool
		 */
		public NULL|bool $pending = false;
		
		/**
		 * Total permissions of the member in the channel, including overwrites, returned when in the interaction object
		 * @var string
		 */
		public NULL|string $permissions = "";
	}
