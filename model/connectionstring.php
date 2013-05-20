<?php 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'investordb');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
mysql_set_charset('utf8',$connection);
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());

// $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.142.118)(PORT = 1521)))(CONNECT_DATA=(SID=ORADEV1)))"; 

// $conn= oci_connect("invdb","invdb_dev",$db); 
// if (!$conn) {
    // $e = oci_error();
    // trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
// }
?>


