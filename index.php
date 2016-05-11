<?php 
	require_once 'google-api-php-client/src/Google/autoload.php';
	session_start();
	$client = new Google_Client();
	$client->setAuthConfigFile('client_secret_559179895787-r5fnonu9r974b87c1sjl5pg0vg6quosl.apps.googleusercontent.com.json');
	$client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
	$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
	$client->setAccessType("offline");

	$auth_url = $client->createAuthUrl();
	header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
