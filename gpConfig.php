<?php

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '1065794520793-6fefj0guslq1gt8c654p7hv6chguhmgs.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'nEqKELX2pKGNHLQvJGuK8o0m'; //Google client secret
$redirectURL = 'http://127.0.0.1/vprasanja-odgovori/login.php'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('voGoogleLogin');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>