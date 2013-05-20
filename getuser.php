<?php 
include_once 'model/connectionstring.php';
include_once 'model/investorclass.php';
//php json decode very important to get the value of the prameter passed
$res = json_decode(stripslashes($_GET['data']),true); 
//create an instance of the class 
$AFDB_INVESTORDB= new AFDB_INVESTORDB();
//get the value of the data passed and perform some security validation
$username = mysql_escape_string($res['username']); 
$password= mysql_escape_string($res['password']); 
//Verify if the login provided is correct
$AFDB_INVESTORDB->getUser($username,$password);     


?>