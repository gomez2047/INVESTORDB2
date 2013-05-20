<?php
class AFDB_INVESTORDB
{

	private $db;
	private $conn;
	 function __construct() 
	 {           
			$this->db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.142.118)(PORT = 1521)))(CONNECT_DATA=(SID=ORADEV1)))"; 

			$this->conn= oci_connect("invdb","invdb_dev",$this->db); 
			if (!$this->conn) {
				$e = oci_error();
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
								   
	 }   	
	 
 
	 function getRoadshows()
	 { 
		$stid = oci_parse($this->conn, 'SELECT * FROM INVDB_INVESTOR');
		oci_execute($stid);
		$rows = array();
		
		 for ($x = 0, $numrows = oci_num_rows($stid); $x < $numrows; $x++)
	 {
			$row = oci_fetch_assoc($stid);
			$rows[$x] = array("nom" => $row["INVESTORID"]);

		}

	

	$response = $_GET["jsoncallback"] . "(" . json_encode($rows) . ")";
			echo $response;

		 
	 }
	 
		//get the content  by passing the map id as a parameter
		// function getUser($username,$password)
		// {		
		//query the database
		  // $query = mysql_query("SELECT * FROM login where username='$username' and password='$password'");
			
			//loop through and return results
		  // for ($x = 0, $numrows = mysql_num_rows($query); $x < $numrows; $x++) {
				// $row = mysql_fetch_assoc($query);
				// $afdb[$x] = array("username" => $row["username"],"password" => $row["password"]);	
											
			// }
			//echo JSON to page
			// $response = $_GET["jsoncallback"] . "(" . json_encode($afdb) . ")";
			// echo $response;

		
		// }
		//return all data

		

		



}
$AFDB_INVESTORDB= new AFDB_INVESTORDB();


?>