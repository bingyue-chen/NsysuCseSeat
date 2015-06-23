<?php 
session_start();

    $_SESSION['FBID'] = NULL;
    $_SESSION['FULLNAME'] = NULL;
    $_SESSION['EMAIL'] =  NULL;
	$_SESSION['LINK'] = NULL;
    $_SESSION['PIC'] =  "../img/in_seat.jpg";

header("Location: .." . $_SESSION['uri'] );        // you can enter home page here ( Eg : header("Location: " ."http://www.krizna.com"); 
?>
