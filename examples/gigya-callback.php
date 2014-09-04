<?php

  // create a file called config.api.php and add the $api_key and $api_secret values
  // this is to keep API Keys out of github.

	include_once 'config.api.php';

	include_once './Gigya_PHP_SDK/GSSDK.php';
	include_once '../src/php/sailthru/sailthru/Sailthru_Client.php';
	include_once '../src/php/sailthru/sailthru/Sailthru_Client_Exception.php';
	include_once '../src/php/sailthru/sailthru/Sailthru_Util.php';
	include_once '../src/php/Sailthru_Social.php';


	if ($_POST) {

		$client = new Sailthru_Social($api_key, $api_secret);
		$profile = json_decode($_POST['json']);

		// check the gigya security signature
		$uid = isset($profile->UID) ?  $profile->UID : '';
		$ts = isset($profile->signatureTimestamp) ?  $profile->signatureTimestamp : '';
		$sig = isset($profile->UIDSignature) ?  $profile->UIDSignature : '';
		$valid = SigUtils::validateUserSignature($uid, $ts, $gigya_secret_key, $sig);

		if ($valid) {
			$result = $client->social_login($profile);
			header('HTTP/1.1 204 No Content');
		} else {
			header('HTTP/1.1 405 Method Not Allowed');
		}
	} else {
		header('HTTP/1.1 405 Method Not Allowed');
	}

