<?php

	namespace Discorderly\Response;

	class Exception extends \Exception {
		/**
		 * General error (such as a malformed request body, amongst other things)
		 * @var int
		 */
		const GENERAL_ERROR = 0;
		
		/**
		 * Unknown account
		 * @var int
		 */
		const UNKNOWN_ACCOUNT = 10001;
		
		/**
		 * Unknown application
		 * @var int
		 */
		const UNKNOWN_APPLICATION = 10002;
		
		/**
		 * Unknown channel
		 * @var int
		 */
		const UNKNOWN_CHANNEL = 10003;
		
		/**
		 * Unknown guild
		 * @var int
		 */
		const UNKNOWN_GUILD = 10004;
		
		/**
		 * Unknown integration
		 * @var int
		 */
		const UNKNOWN_INTEGRATION = 10005;
		
		/**
		 * Unknown invite
		 * @var int
		 */
		const UNKNOWN_INVITE = 10006;
		
		/**
		 * Unknown member
		 * @var int
		 */
		const UNKNOWN_MEMBER = 10007;
		
		/**
		 * Unknown message
		 * @var int
		 */
		const UNKNOWN_MESSAGE = 10008;
		
		/**
		 * Unknown permission overwrite
		 * @var int
		 */
		const UNKNOWN_PERMISSION_OVERWRITE = 10009;
		
		/**
		 * Unknown provider
		 * @var int
		 */
		const UNKNOWN_PROVIDER = 10010;
		
		/**
		 * Unknown role
		 * @var int
		 */
		const UNKNOWN_ROLE = 10011;
		
		/**
		 * Unknown token
		 * @var int
		 */
		const UNKNOWN_TOKEN = 10012;
		
		/**
		 * Unknown user
		 * @var int
		 */
		const UNKNOWN_USER = 10013;
		
		/**
		 * Unknown emoji
		 * @var int
		 */
		const UNKNOWN_EMOJI = 10014;
		
		/**
		 * Unknown webhook
		 * @var int
		 */
		const UNKNOWN_WEBHOOK = 10015;
		
		/**
		 * Unknown webhook service
		 * @var int
		 */
		const UNKNOWN_WEBHOOK_SERVICE = 10016;
		
		/**
		 * Unknown session
		 * @var int
		 */
		const UNKNOWN_SESSION = 10020;
		
		/**
		 * Unknown ban
		 * @var int
		 */
		const UNKNOWN_BAN = 10026;
		
		/**
		 * Unknown SKU
		 * @var int
		 */
		const UNKNOWN_SKU = 10027;
		
		/**
		 * Unknown Store Listing
		 * @var int
		 */
		const UNKNOWN_STORE_LISTING = 10028;
		
		/**
		 * Unknown entitlement
		 * @var int
		 */
		const UNKNOWN_ENTITLEMENT = 10029;
		
		/**
		 * Unknown build
		 * @var int
		 */
		const UNKNOWN_BUILD = 10030;
		
		/**
		 * Unknown lobby
		 * @var int
		 */
		const UNKNOWN_LOBBY = 10031;
		
		/**
		 * Unknown branch
		 * @var int
		 */
		const UNKNOWN_BRANCH = 10032;
		
		/**
		 * Unknown store directory layout
		 * @var int
		 */
		const UNKNOWN_STORE_DIRECTORY_LAYOUT = 10033;
		
		/**
		 * Unknown redistributable
		 * @var int
		 */
		const UNKNOWN_REDISTRIBUTABLE = 10036;
		
		/**
		 * Unknown gift code
		 * @var int
		 */
		const UNKNOWN_GIFT_CODE = 10038;
		
		/**
		 * Unknown stream
		 * @var int
		 */
		const UNKNOWN_STREAM = 10049;
		
		/**
		 * Unknown premium server subscribe cooldown
		 * @var int
		 */
		const UNKNOWN_PREMIUM_SERVER_SUBSCRIBE_COOLDOWN = 10050;
		
		/**
		 * Unknown guild template
		 * @var int
		 */
		const UNKNOWN_GUILD_TEMPLATE = 10057;
		
		/**
		 * Unknown discoverable server category
		 * @var int
		 */
		const UNKNOWN_DISCOVERABLE_SERVER_CATEGORY = 10059;
		
		/**
		 * Unknown sticker
		 * @var int
		 */
		const UNKNOWN_STICKER = 10060;
		
		/**
		 * Unknown interaction
		 * @var int
		 */
		const UNKNOWN_INTERACTION = 10062;
		
		/**
		 * Unknown application command
		 * @var int
		 */
		const UNKNOWN_APPLICATION_COMMAND = 10063;
		
		/**
		 * Unknown application command permissions
		 * @var int
		 */
		const UNKNOWN_APPLICATION_COMMAND_PERMISSIONS = 10066;
		
		/**
		 * Unknown Stage Instance
		 * @var int
		 */
		const UNKNOWN_STAGE_INSTANCE = 10067;
		
		/**
		 * Unknown Guild Member Verification Form
		 * @var int
		 */
		const UNKNOWN_GUILD_MEMBER_VERIFICATION_FORM = 10068;
		
		/**
		 * Unknown Guild Welcome Screen
		 * @var int
		 */
		const UNKNOWN_GUILD_WELCOME_SCREEN = 10069;
		
		/**
		 * Unknown Guild Scheduled Event
		 * @var int
		 */
		const UNKNOWN_GUILD_SCHEDULED_EVENT = 10070;
		
		/**
		 * Unknown Guild Scheduled Event User
		 * @var int
		 */
		const UNKNOWN_GUILD_SCHEDULED_EVENT_USER = 10071;
		
		/**
		 * Bots cannot use this endpoint
		 * @var int
		 */
		const BOTS_CANNOT_USE_THIS_ENDPOINT = 20001;
		
		/**
		 * Only bots can use this endpoint
		 * @var int
		 */
		const ONLY_BOTS_CAN_USE_THIS_ENDPOINT = 20002;
		
		/**
		 * Explicit content cannot be sent to the desired recipient(s)
		 * @var int
		 */
		const EXPLICIT_CONTENT_CANNOT_BE_SENT_TO_THE_DESIRED_RECIPIENTS = 20009;
		
		/**
		 * You are not authorized to perform this action on this application
		 * @var int
		 */
		const YOU_ARE_NOT_AUTHORIZED_TO_PERFORM_THIS_ACTION_ON_THIS_APPLICATION = 20012;
		
		/**
		 * This action cannot be performed due to slowmode rate limit
		 * @var int
		 */
		const THIS_ACTION_CANNOT_BE_PERFORMED_DUE_TO_SLOWMODE_RATE_LIMIT = 20016;
		
		/**
		 * Only the owner of this account can perform this action
		 * @var int
		 */
		const ONLY_THE_OWNER_OF_THIS_ACCOUNT_CAN_PERFORM_THIS_ACTION = 20018;
		
		/**
		 * This message cannot be edited due to announcement rate limits
		 * @var int
		 */
		const THIS_MESSAGE_CANNOT_BE_EDITED_DUE_TO_ANNOUNCEMENT_RATE_LIMITS = 20022;
		
		/**
		 * The channel you are writing has hit the write rate limit
		 * @var int
		 */
		const THE_CHANNEL_YOU_ARE_WRITING_HAS_HIT_THE_WRITE_RATE_LIMIT = 20028;
		
		/**
		 * Your Stage topic, server name, server description, or channel names contain words that are not allowed
		 * @var int
		 */
		const YOUR_STAGE_TOPIC_SERVER_NAME_SERVER_DESCRIPTION_OR_CHANNEL_NAMES_CONTAIN_WORDS_THAT_ARE_NOT_ALLOWED = 20031;
		
		/**
		 * Guild premium subscription level too low
		 * @var int
		 */
		const GUILD_PREMIUM_SUBSCRIPTION_LEVEL_TOO_LOW = 20035;
		
		/**
		 * Maximum number of guilds reached (100)
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_GUILDS_REACHED_100 = 30001;
		
		/**
		 * Maximum number of friends reached (1000)
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_FRIENDS_REACHED_1000 = 30002;
		
		/**
		 * Maximum number of pins reached for the channel (50)
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_PINS_REACHED_FOR_THE_CHANNEL_50 = 30003;
		
		/**
		 * Maximum number of recipients reached (10)
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_RECIPIENTS_REACHED_10 = 30004;
		
		/**
		 * Maximum number of guild roles reached (250)
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_GUILD_ROLES_REACHED_250 = 30005;
		
		/**
		 * Maximum number of webhooks reached (10)
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_WEBHOOKS_REACHED_10 = 30007;
		
		/**
		 * Maximum number of emojis reached
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_EMOJIS_REACHED = 30008;
		
		/**
		 * Maximum number of reactions reached (20)
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_REACTIONS_REACHED_20 = 30010;
		
		/**
		 * Maximum number of guild channels reached (500)
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_GUILD_CHANNELS_REACHED_500 = 30013;
		
		/**
		 * Maximum number of attachments in a message reached (10)
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_ATTACHMENTS_IN_A_MESSAGE_REACHED_10 = 30015;
		
		/**
		 * Maximum number of invites reached (1000)
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_INVITES_REACHED_1000 = 30016;
		
		/**
		 * Maximum number of animated emojis reached
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_ANIMATED_EMOJIS_REACHED = 30018;
		
		/**
		 * Maximum number of server members reached
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_SERVER_MEMBERS_REACHED = 30019;
		
		/**
		 * Maximum number of server categories has been reached (5)
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_SERVER_CATEGORIES_HAS_BEEN_REACHED_5 = 30030;
		
		/**
		 * Guild already has a template
		 * @var int
		 */
		const GUILD_ALREADY_HAS_A_TEMPLATE = 30031;
		
		/**
		 * Max number of thread participants has been reached (1000)
		 * @var int
		 */
		const MAX_NUMBER_OF_THREAD_PARTICIPANTS_HAS_BEEN_REACHED_1000 = 30033;
		
		/**
		 * Maximum number of bans for non-guild members have been exceeded
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_BANS_FOR_NONGUILD_MEMBERS_HAVE_BEEN_EXCEEDED = 30035;
		
		/**
		 * Maximum number of bans fetches has been reached
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_BANS_FETCHES_HAS_BEEN_REACHED = 30037;
		
		/**
		 * Maximum number of uncompleted guild scheduled events reached (100)
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_UNCOMPLETED_GUILD_SCHEDULED_EVENTS_REACHED_100 = 30038;
		
		/**
		 * Maximum number of stickers reached
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_STICKERS_REACHED = 30039;
		
		/**
		 * Maximum number of prune requests has been reached. Try again later
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_PRUNE_REQUESTS_HAS_BEEN_REACHED_TRY_AGAIN_LATER = 30040;
		
		/**
		 * Maximum number of guild widget settings updates has been reached. Try again later
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_GUILD_WIDGET_SETTINGS_UPDATES_HAS_BEEN_REACHED_TRY_AGAIN_LATER = 30042;
		
		/**
		 * Unauthorized. Provide a valid token and try again
		 * @var int
		 */
		const UNAUTHORIZED_PROVIDE_A_VALID_TOKEN_AND_TRY_AGAIN = 40001;
		
		/**
		 * You need to verify your account in order to perform this action
		 * @var int
		 */
		const YOU_NEED_TO_VERIFY_YOUR_ACCOUNT_IN_ORDER_TO_PERFORM_THIS_ACTION = 40002;
		
		/**
		 * You are opening direct messages too fast
		 * @var int
		 */
		const YOU_ARE_OPENING_DIRECT_MESSAGES_TOO_FAST = 40003;
		
		/**
		 * Request entity too large. Try sending something smaller in size
		 * @var int
		 */
		const REQUEST_ENTITY_TOO_LARGE_TRY_SENDING_SOMETHING_SMALLER_IN_SIZE = 40005;
		
		/**
		 * This feature has been temporarily disabled server-side
		 * @var int
		 */
		const THIS_FEATURE_HAS_BEEN_TEMPORARILY_DISABLED_SERVERSIDE = 40006;
		
		/**
		 * The user is banned from this guild
		 * @var int
		 */
		const THE_USER_IS_BANNED_FROM_THIS_GUILD = 40007;
		
		/**
		 * Target user is not connected to voice
		 * @var int
		 */
		const TARGET_USER_IS_NOT_CONNECTED_TO_VOICE = 40032;
		
		/**
		 * This message has already been crossposted
		 * @var int
		 */
		const THIS_MESSAGE_HAS_ALREADY_BEEN_CROSSPOSTED = 40033;
		
		/**
		 * An application command with that name already exists
		 * @var int
		 */
		const AN_APPLICATION_COMMAND_WITH_THAT_NAME_ALREADY_EXISTS = 40041;
		
		/**
		 * Missing access
		 * @var int
		 */
		const MISSING_ACCESS = 50001;
		
		/**
		 * Invalid account type
		 * @var int
		 */
		const INVALID_ACCOUNT_TYPE = 50002;
		
		/**
		 * Cannot execute action on a DM channel
		 * @var int
		 */
		const CANNOT_EXECUTE_ACTION_ON_A_DM_CHANNEL = 50003;
		
		/**
		 * Guild widget disabled
		 * @var int
		 */
		const GUILD_WIDGET_DISABLED = 50004;
		
		/**
		 * Cannot edit a message authored by another user
		 * @var int
		 */
		const CANNOT_EDIT_A_MESSAGE_AUTHORED_BY_ANOTHER_USER = 50005;
		
		/**
		 * Cannot send an empty message
		 * @var int
		 */
		const CANNOT_SEND_AN_EMPTY_MESSAGE = 50006;
		
		/**
		 * Cannot send messages to this user
		 * @var int
		 */
		const CANNOT_SEND_MESSAGES_TO_THIS_USER = 50007;
		
		/**
		 * Cannot send messages in a voice channel
		 * @var int
		 */
		const CANNOT_SEND_MESSAGES_IN_A_VOICE_CHANNEL = 50008;
		
		/**
		 * Channel verification level is too high for you to gain access
		 * @var int
		 */
		const CHANNEL_VERIFICATION_LEVEL_IS_TOO_HIGH_FOR_YOU_TO_GAIN_ACCESS = 50009;
		
		/**
		 * OAuth2 application does not have a bot
		 * @var int
		 */
		const OAUTH2_APPLICATION_DOES_NOT_HAVE_A_BOT = 50010;
		
		/**
		 * OAuth2 application limit reached
		 * @var int
		 */
		const OAUTH2_APPLICATION_LIMIT_REACHED = 50011;
		
		/**
		 * Invalid OAuth2 state
		 * @var int
		 */
		const INVALID_OAUTH2_STATE = 50012;
		
		/**
		 * You lack permissions to perform that action
		 * @var int
		 */
		const YOU_LACK_PERMISSIONS_TO_PERFORM_THAT_ACTION = 50013;
		
		/**
		 * Invalid authentication token provided
		 * @var int
		 */
		const INVALID_AUTHENTICATION_TOKEN_PROVIDED = 50014;
		
		/**
		 * Note was too long
		 * @var int
		 */
		const NOTE_WAS_TOO_LONG = 50015;
		
		/**
		 * Provided too few or too many messages to delete. Must provide at least 2 and fewer than 100 messages to delete
		 * @var int
		 */
		const PROVIDED_TOO_FEW_OR_TOO_MANY_MESSAGES_TO_DELETE_MUST_PROVIDE_AT_LEAST_2_AND_FEWER_THAN_100_MESSAGES_TO_DELETE = 50016;
		
		/**
		 * A message can only be pinned to the channel it was sent in
		 * @var int
		 */
		const A_MESSAGE_CAN_ONLY_BE_PINNED_TO_THE_CHANNEL_IT_WAS_SENT_IN = 50019;
		
		/**
		 * Invite code was either invalid or taken
		 * @var int
		 */
		const INVITE_CODE_WAS_EITHER_INVALID_OR_TAKEN = 50020;
		
		/**
		 * Cannot execute action on a system message
		 * @var int
		 */
		const CANNOT_EXECUTE_ACTION_ON_A_SYSTEM_MESSAGE = 50021;
		
		/**
		 * Cannot execute action on this channel type
		 * @var int
		 */
		const CANNOT_EXECUTE_ACTION_ON_THIS_CHANNEL_TYPE = 50024;
		
		/**
		 * Invalid OAuth2 access token provided
		 * @var int
		 */
		const INVALID_OAUTH2_ACCESS_TOKEN_PROVIDED = 50025;
		
		/**
		 * Missing required OAuth2 scope
		 * @var int
		 */
		const MISSING_REQUIRED_OAUTH2_SCOPE = 50026;
		
		/**
		 * Invalid webhook token provided
		 * @var int
		 */
		const INVALID_WEBHOOK_TOKEN_PROVIDED = 50027;
		
		/**
		 * Invalid role
		 * @var int
		 */
		const INVALID_ROLE = 50028;
		
		/**
		 * Invalid Recipient(s)
		 * @var int
		 */
		const INVALID_RECIPIENTS = 50033;
		
		/**
		 * A message provided was too old to bulk delete
		 * @var int
		 */
		const A_MESSAGE_PROVIDED_WAS_TOO_OLD_TO_BULK_DELETE = 50034;
		
		/**
		 * Invalid form body (returned for both application/json and multipart/form-data bodies), or invalid Content-Type provided
		 * @var int
		 */
		const INVALID_FORM_BODY_RETURNED_FOR_BOTH_APPLICATION_JSON_AND_MULTIPART_FORMDATA_BODIES_OR_INVALID_CONTENTTYPE_PROVIDED = 50035;
		
		/**
		 * An invite was accepted to a guild the application's bot is not in
		 * @var int
		 */
		const AN_INVITE_WAS_ACCEPTED_TO_A_GUILD_THE_APPLICATIONS_BOT_IS_NOT_IN = 50036;
		
		/**
		 * Invalid API version provided
		 * @var int
		 */
		const INVALID_API_VERSION_PROVIDED = 50041;
		
		/**
		 * File uploaded exceeds the maximum size
		 * @var int
		 */
		const FILE_UPLOADED_EXCEEDS_THE_MAXIMUM_SIZE = 50045;
		
		/**
		 * Invalid file uploaded
		 * @var int
		 */
		const INVALID_FILE_UPLOADED = 50046;
		
		/**
		 * Cannot self-redeem this gift
		 * @var int
		 */
		const CANNOT_SELFREDEEM_THIS_GIFT = 50054;
		
		/**
		 * Payment source required to redeem gift
		 * @var int
		 */
		const PAYMENT_SOURCE_REQUIRED_TO_REDEEM_GIFT = 50070;
		
		/**
		 * Cannot delete a channel required for Community guilds
		 * @var int
		 */
		const CANNOT_DELETE_A_CHANNEL_REQUIRED_FOR_COMMUNITY_GUILDS = 50074;
		
		/**
		 * Invalid sticker sent
		 * @var int
		 */
		const INVALID_STICKER_SENT = 50081;
		
		/**
		 * Tried to perform an operation on an archived thread, such as editing a message or adding a user to the thread
		 * @var int
		 */
		const TRIED_TO_PERFORM_AN_OPERATION_ON_AN_ARCHIVED_THREAD_SUCH_AS_EDITING_A_MESSAGE_OR_ADDING_A_USER_TO_THE_THREAD = 50083;
		
		/**
		 * Invalid thread notification settings
		 * @var int
		 */
		const INVALID_THREAD_NOTIFICATION_SETTINGS = 50084;
		
		/**
		 * before value is earlier than the thread creation date
		 * @var int
		 */
		const BEFORE_VALUE_IS_EARLIER_THAN_THE_THREAD_CREATION_DATE = 50085;
		
		/**
		 * This server is not available in your location
		 * @var int
		 */
		const THIS_SERVER_IS_NOT_AVAILABLE_IN_YOUR_LOCATION = 50095;
		
		/**
		 * This server needs monetization enabled in order to perform this action
		 * @var int
		 */
		const THIS_SERVER_NEEDS_MONETIZATION_ENABLED_IN_ORDER_TO_PERFORM_THIS_ACTION = 50097;
		
		/**
		 * This server needs more boosts to perform this action
		 * @var int
		 */
		const THIS_SERVER_NEEDS_MORE_BOOSTS_TO_PERFORM_THIS_ACTION = 50101;
		
		/**
		 * Two factor is required for this operation
		 * @var int
		 */
		const TWO_FACTOR_IS_REQUIRED_FOR_THIS_OPERATION = 60003;
		
		/**
		 * No users with DiscordTag exist
		 * @var int
		 */
		const NO_USERS_WITH_DISCORDTAG_EXIST = 80004;
		
		/**
		 * Reaction was blocked
		 * @var int
		 */
		const REACTION_WAS_BLOCKED = 90001;
		
		/**
		 * API resource is currently overloaded. Try again a little later
		 * @var int
		 */
		const API_RESOURCE_IS_CURRENTLY_OVERLOADED_TRY_AGAIN_A_LITTLE_LATER = 130000;
		
		/**
		 * The Stage is already open
		 * @var int
		 */
		const THE_STAGE_IS_ALREADY_OPEN = 150006;
		
		/**
		 * Cannot reply without permission to read message history
		 * @var int
		 */
		const CANNOT_REPLY_WITHOUT_PERMISSION_TO_READ_MESSAGE_HISTORY = 160002;
		
		/**
		 * A thread has already been created for this message
		 * @var int
		 */
		const A_THREAD_HAS_ALREADY_BEEN_CREATED_FOR_THIS_MESSAGE = 160004;
		
		/**
		 * Thread is locked
		 * @var int
		 */
		const THREAD_IS_LOCKED = 160005;
		
		/**
		 * Maximum number of active threads reached
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_ACTIVE_THREADS_REACHED = 160006;
		
		/**
		 * Maximum number of active announcement threads reached
		 * @var int
		 */
		const MAXIMUM_NUMBER_OF_ACTIVE_ANNOUNCEMENT_THREADS_REACHED = 160007;
		
		/**
		 * Invalid JSON for uploaded Lottie file
		 * @var int
		 */
		const INVALID_JSON_FOR_UPLOADED_LOTTIE_FILE = 170001;
		
		/**
		 * Uploaded Lotties cannot contain rasterized images such as PNG or JPEG
		 * @var int
		 */
		const UPLOADED_LOTTIES_CANNOT_CONTAIN_RASTERIZED_IMAGES_SUCH_AS_PNG_OR_JPEG = 170002;
		
		/**
		 * Sticker maximum framerate exceeded
		 * @var int
		 */
		const STICKER_MAXIMUM_FRAMERATE_EXCEEDED = 170003;
		
		/**
		 * Sticker frame count exceeds maximum of 1000 frames
		 * @var int
		 */
		const STICKER_FRAME_COUNT_EXCEEDS_MAXIMUM_OF_1000_FRAMES = 170004;
		
		/**
		 * Lottie animation maximum dimensions exceeded
		 * @var int
		 */
		const LOTTIE_ANIMATION_MAXIMUM_DIMENSIONS_EXCEEDED = 170005;
		
		/**
		 * Sticker frame rate is either too small or too large
		 * @var int
		 */
		const STICKER_FRAME_RATE_IS_EITHER_TOO_SMALL_OR_TOO_LARGE = 170006;
		
		/**
		 * Sticker animation duration exceeds maximum of 5 seconds
		 * @var int
		 */
		const STICKER_ANIMATION_DURATION_EXCEEDS_MAXIMUM_OF_5_SECONDS = 170007;
		
		/**
		 * Cannot update a finished event
		 * @var int
		 */
		const CANNOT_UPDATE_A_FINISHED_EVENT = 180000;
		
		/**
		 * Failed to create stage needed for stage event
		 * @var int
		 */
		const FAILED_TO_CREATE_STAGE_NEEDED_FOR_STAGE_EVENT = 180002;

		/**
		 * Error message
		 * @var string
		 */
		protected $message = "Discorderly exception";
	}
