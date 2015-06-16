<?php 
session_start();
$temp_uri = $_SESSION['uri'];
session_unset();
    $_SESSION['FBID'] = NULL;
    $_SESSION['FULLNAME'] = NULL;
    $_SESSION['EMAIL'] =  NULL;
$_SESSION['uri'] = $temp_uri;

header("Location: .." . $_SESSION['uri'] );        // you can enter home page here ( Eg : header("Location: " ."http://www.krizna.com"); 
?>
