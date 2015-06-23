<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '676823935794789','f0e9f02f58f7e0e48c3d58ac2aa4807d' );
// login helper with redirect_uri
    $uri_postfix = isset( $_SESSION['uri'] ) ? $_SESSION['uri'] : "";
    $helper = new FacebookRedirectLoginHelper('http://seat.xgnid.me/fbconn/fbconfig.php');
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
	echo $ex->getMessage();
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
	echo $ex->getMessage();
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	    $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
	    $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
		$link = $graphObject->getProperty('link');
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;           
        $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
		$_SESSION['LINK']  = $link;
      $_SESSION['PIC'] = "https://graph.facebook.com/" . $_SESSION['FBID'] . "/picture";
    /* ---- header location after session ----*/
  header("Location: .." . $_SESSION['uri'] . "?id=" . $_SESSION['FBID'] );
} else {
  $loginUrl = $helper->getLoginUrl();
 header("Location: ".$loginUrl );
}
?>
