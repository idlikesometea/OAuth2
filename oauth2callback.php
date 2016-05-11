<?php
	require_once 'google-api-php-client/src/Google/autoload.php';
	session_start();
	$client = new Google_Client();
	$client->setAuthConfigFile('client_secret_559179895787-r5fnonu9r974b87c1sjl5pg0vg6quosl.apps.googleusercontent.com.json');
	$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
	$client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
	$client->setAccessType("offline");

	if (!isset($_GET['code'])) {
		$auth_url = $client->createAuthUrl();
		header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
	} else {
		$client->authenticate($_GET['code']);
		$_SESSION['access_token'] = $client->getAccessToken();
		$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/redirect.php';
		header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
	}