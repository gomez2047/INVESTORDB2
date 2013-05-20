<?php 
include_once 'model/connectionstring.php';
include_once 'model/investorclass.php';

$res = json_decode(stripslashes($_GET['data']),true); 

//create an instance of the class 
$AFDB_INVESTORDB= new AFDB_INVESTORDB();
//security clean up
$id= mysql_escape_string($res['dataid']); 

$AFDB_INVESTORDB->getmeetings($id);  


?>