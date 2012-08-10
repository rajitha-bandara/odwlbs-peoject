<?php
session_start();
require_once('includes/google-api-php-client/src/apiClient.php');
require_once('includes/google-api-php-client/src/contrib/apiAnalyticsService.php');

$scriptUri = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];

$client = new apiClient();
$client->setAccessType('online'); // default: offline
$client->setApplicationName('odwlbs analytics');
$client->setClientId('701410038147.apps.googleusercontent.com');
$client->setClientSecret('zFG4ibjDTzl-zl8JIi9PATsH');
$client->setRedirectUri($scriptUri);
$client->setDeveloperKey('AIzaSyCuAMq5usFdhFShNb5HKdPVdtrlal9m2lw'); // API key

// $service implements the client interface, has to be set before auth call
$service = new apiAnalyticsService($client);

if (isset($_GET['logout'])) { // logout: destroy token
    unset($_SESSION['token']);
	die('Logged out.');
}

if (isset($_GET['code'])) { // we received the positive auth callback, get the token and store it in session
    $client->authenticate();
    $_SESSION['token'] = $client->getAccessToken();
}

if (isset($_SESSION['token'])) { // extract token from session and configure client
    $token = $_SESSION['token'];
    $client->setAccessToken($token);
}

if (!$client->getAccessToken()) { // auth call to google
    $authUrl = $client->createAuthUrl();
    header("Location: ".$authUrl);
    die;
}
echo 'Hello, world.';
?>