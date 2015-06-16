<?php 
session_start();
session_unset();
    $_SESSION['FBID'] = NULL;
    $_SESSION['FULLNAME'] = NULL;
    $_SESSION['EMAIL'] =  NULL;
echo $_SESSION['uri'];
header("Location: .." . $_SESSION['uri'] );        // you can enter home page here ( Eg : header("Location: " ."http://www.krizna.com"); 
?>
