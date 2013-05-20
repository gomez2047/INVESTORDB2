
<?php 
 $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.142.118)(PORT = 1521)))(CONNECT_DATA=(SID=ORADEV1)))"; 

$conn= oci_connect("invdb","invdb_dev",$db); 
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$stid = oci_parse($conn, 'SELECT * FROM INVDB_ROADSHOW');
oci_execute($stid);
$sql = "SELECT COUNT(*) AS num_entries FROM INVDB_MEETINGS_REPRESENTATIVES";

$stmt = oci_parse($conn,$sql);
echo  $stmt. " rows selected.<br />";
//echo oci_num_rows($stid);
$rows = array();

	 for ($x = 0; $x < $stmt; $x++)
	 {
	$r = oci_fetch_assoc($stid);
	$rows[$x] = array("nom" => $r["ROADSHOWID"]);	
     
}

$locations =(json_encode($rows));
echo $locations ;
?>