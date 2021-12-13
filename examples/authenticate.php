<?php

	require_once __DIR__ . "/../vendor/autoload.php";

	$config  = include __DIR__ . "/config.php";
	$discord = new \Discorderly\Discorderly();

	$discord->connect(
		type:          "bot",
		bot_token:     $config["bot_token"],
		client_id:     $config["client_id"],
		client_secret: $config["client_secret"],
		public_key:    $config["public_key"],
	);

	\var_dump($discord->Application()->get());
