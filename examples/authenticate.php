<?php

	require_once __DIR__ . "/../vendor/autoload.php";

	$config  = include __DIR__ . "config.php";
	$discord = new \Discorderly\Discorderly();

	$discord->connect(
		type:      "bot",
		client_id: $config["client_id"],
		bot_token: $config["bot_token"],
	);

	\var_dump($discord->User()->getGuilds());
