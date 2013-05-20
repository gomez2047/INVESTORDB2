<?php
class AFDB_INVESTORDB
{

	
	 function __construct() 
	 {           
			
								   
	 }   	
	 
 
	 function getRoadshows()
	 { 
		//query the database
		   $query = mysql_query("SELECT * FROM roadshows");
	
			//loop through and return results
		  for ($x = 0, $numrows = mysql_num_rows($query); $x < $numrows; $x++) {
				$row = mysql_fetch_assoc($query);
				 $afdb[$x] = array("ID" => $row["ROADSHOWID"],"start_date" => $row["FROM_DATE"],"END_DATE" => $row["TO_DATE"],"Roadshow_Name" => $row["DESCRIPTION"],"description" => $row["OBJECTIF"],"RODSHOWARRANGER" => $row["ARRANGER"]);	
											
			 }
			//echo JSON to page
			 $response = $_GET["jsoncallback"] . "(" . json_encode($afdb) . ")";
			 echo $response;

		 
	 }
	 
	 
	 function getinvestors()
	 { 
		//query the database
		   $query = mysql_query("SELECT * FROM investor");
	
			//loop through and return results
		  for ($x = 0, $numrows = mysql_num_rows($query); $x < $numrows; $x++) {
				$row = mysql_fetch_assoc($query);
				 $afdb[$x] = array("ID" => $row["investorid"],"longname" => $row["longname"],"SHORTNAME" => $row["SHORTNAME"],"TYPE" => $row["TYPE"],"ADDRESS" => $row["ADDRESS"]);	
											
			 }
			//echo JSON to page
			 $response = $_GET["jsoncallback"] . "(" . json_encode($afdb) . ")";
			 echo $response;

		 
	 }
	 
	 //get primary market
	 function getprimary()
	 { 
		//query the database
		 		   $query = mysql_query("SELECT * FROM primary_market");
	
			//loop through and return results
		  for ($x = 0, $numrows = mysql_num_rows($query); $x < $numrows; $x++) {
				$row = mysql_fetch_assoc($query);
				 $afdb[$x] = array("ORDERAMOUNT" => $row["ORDERAMOUNT"],"ALLOCATEDAMOUNT" => $row["ALLOCATEDAMOUNT"],"BORROWINGID" => $row["BORROWINGID"],"INVESTORID" => $row["INVESTORID"],"ALLOCATIONDATE" => $row["ALLOCATIONDATE"],"LONGNAME" => $row["LONGNAME"],"BENCHMARK" => $row["BENCHMARK"],"TRADEDATE" => $row["TRADEDATE"],"COUPON" => $row["COUPON"],"ISSUER" => $row["ISSUER"],"CURRENCY" => $row["CURRENCY"],"MATDATE" => $row["MATDATE"],"AMOUNT" => $row["AMOUNT"],"ALLOCATIONID" => $row["ALLOCATIONID"]);	
											
			 }
			//echo JSON to page
			 $response = $_GET["jsoncallback"] . "(" . json_encode($afdb) . ")";
			 echo $response;

		 
	 }
	 
	 	 //get secondary market
	 function getsecondary()
	 { 
		//query the database
		 		   $query = mysql_query("SELECT * FROM secondary_market");
	
			//loop through and return results
		  for ($x = 0, $numrows = mysql_num_rows($query); $x < $numrows; $x++) {
				$row = mysql_fetch_assoc($query);
				$afdb[$x] = array("TRADEDATE" => $row["TRADEDATE"],"COMMENTS" => $row["COMMENTS"],"CURRENCY" => $row["CURRENCY"],"PRICE" => $row["PRICE"],"TRADE_ID" => $row["TRADE_ID"],"INVESTOR" => $row["INVESTOR"],"MATDATE" => $row["MATDATE"],"BUYSELL" => $row["BUYSELL"],"BENCHMARK" => $row["GOVERMENT_BENCHMARK"],"AMOUNT" => $row["AMOUNT"]);	
											
			 }
			//echo JSON to page
			 $response = $_GET["jsoncallback"] . "(" . json_encode($afdb) . ")";
			 echo $response;

		 
	 }
	 
	 
	  function getinvestorport($id)
	 { 
		//query the database
		   $query = mysql_query("SELECT * FROM  investor_portfolio where investorid='$id'");
	
			//loop through and return results
		  for ($x = 0, $numrows = mysql_num_rows($query); $x < $numrows; $x++) {
				$row = mysql_fetch_assoc($query);
				 $afdb[$x] = array("NAME" => $row["NAME"],"DATE" => $row["GUIDE_LINES_DATE"],"BOUGHTAFDB" => $row["BOUGHT_AFDB"],"ASSETSUNDERMANAGEMENT" => $row["ASSETS_UNDER_MANAGEMENT"],"FIXEDFLOATING" => $row["FIXED_FLOATING"],"MINIMUMISSUESIZE" => $row["MINIMUM_ISSUE_SIZE"],"AVERAGETICKETSIZE" => $row["AVERAGE_TICKET_SIZE"],"LINESAVAILABLE" => $row["LINES_AVAILABLE"],"QUESTIONSTOAFDB" => $row["QUESTIONS_TO_AFDB"],"COMMENT" => $row["COMMENTS"],"INVESTMENT_GUIDELINES_ID" => $row["INVESTMENT_GUIDELINES_ID"],"DESCRIPTION" => $row["DESCRIPTION"],"RATING" => $row["RATING"],"LISTFREFIXEDFORMAT" => $row["LIST_FREFIXED_FORMAT"],"LISTCURRENCIES" => $row["LIST_CURRENCIES"],"LIST_SSA" => $row["LIST_SSA"],"INVEST_IN_PRIVATE_PLACEMENTS" => $row["INVEST_IN_PRIVATE_PLACEMENTS"],"ISSUER" => $row["ISSUER"],"ISSUERS" => $row["LIST_ISSUERS"],"MD" => $row["MATURITYPREFERENCE_DESCRIPTION"]);	
											
			 }
			//echo JSON to page
			 $response = $_GET["jsoncallback"] . "(" . json_encode($afdb) . ")";
			 echo $response;

		 
	 }
	 
	 
	 
	  function getmeetings($id)
	 { 
		//query the database
		   $query = mysql_query("SELECT * FROM  meetings where ROADSHOWID='$id'");
	
			//loop through and return results
		  for ($x = 0, $numrows = mysql_num_rows($query); $x < $numrows; $x++) {
				$row = mysql_fetch_assoc($query);
				 $afdb[$x] = array("ID" => $row["MEETINGID"],"date" => $row["ACTUAL_DATE"],"P_date" => $row["PLANNED_DATE"],"name" => $row["INVESTOR_NAME"],"city" => $row["CITY_NAME"],"region" => $row["REGION_NAME"],"MEETING" => $row["MEETING_TYPE"],"country" => $row["COUNTRY_NAME"],"OBJECTIVES" => $row["CONCERNS_OBJECTIVES_TEXT"]);	
											
			 }
			//echo JSON to page
			 $response = $_GET["jsoncallback"] . "(" . json_encode($afdb) . ")";
			 echo $response;

		 
	 }
	 
	  function getmeetingdetails($id)
	 { 
		//query the database
		   $query = mysql_query("SELECT * FROM representatives,meetings WHERE meetings.MEETINGID=representatives.MEETINGID and representatives.MEETINGID='$id'");
	
			//loop through and return results
		  for ($x = 0, $numrows = mysql_num_rows($query); $x < $numrows; $x++) {
				$row = mysql_fetch_assoc($query);
				 $afdb[$x] = array("date" => $row["ACTUAL_DATE"],"repname" => $row["REPRESENTATIVE_NAME"],"repinvname" => $row["REP_INVESTOR_NAME"],"meetinvname" => $row["INVESTOR_NAME"],"error" => "yes");	
											
			 }
			//echo JSON to page
			 $response = $_GET["jsoncallback"] . "(" . json_encode($afdb) . ")";
			 echo $response;

		 
	 }
	 
	 //---------Fonction de connexion au serveur LDAP
	function ldap_logon($user, $passwd, $base, $serveur, $port) {
 
    $connexion_serveur = ldap_connect($serveur,$port) or die("Serveur ".$serveur." introuvable");
    $connexion_user = ldap_bind($connexion_serveur ,$user,$passwd);
 
    if ($connexion_user) {
        $resultat = $connexion_serveur;
    } else {
        $resultat = 0;
    }
 
    return $resultat;
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