$(document).ready(function() {
	
	//
	var server ="http://192.168.140.23/investordb/";
	investor();

	roadshow();
	primary();
	secondary();
	$('#divmeeting').hide();
	
	$('#roadshowid').live('click',function(){
	var roadshowid = $(this).attr('dataid');
    meeting(roadshowid) ;
	 $('#loading').show();
     });
	
	  $('#home').live('click',function(){
     window.location.href = 'home.html';
   
     });
	$('#reset').live('click',function(){
	localStorage.clear();
     window.location.href = 'index.html';
   
     });
	 
	 $('#transaction').live('click',function(){
     window.location.href = 'transactions.html';
   
     });
	 
	  $('#investors').live('click',function(){
     window.location.href = 'investors.html';
   
     });
	 
	 
	 $('#showdetails').live('click',function(){
	var detailsid = $(this).attr('detailsid');
	
	meetingdetails(detailsid);
     });
	  $('#investorid').live('click',function(){
		var id = $(this).attr('dataid');
	
			investordetails(id);
     });
	 
	 


	 $('#submit').live('click',function(){
	
   
   //  window.location.href = 'index.html';
    var username = $('#name').val();
	var password =$('#password').val();
	//alert(username);
	if((username=='')|| (password==''))
	{
	var error ='<div class="alert alert-error" > <strong>Ooops!</strong> Please fill out all required field</div>';
	$("#errorsms").empty();
	$("#errorsms").append(error);
	$("#errorsms").fadeIn(1000);
	}
	else
	{
	$("#errorsms").fadeOut(1000);
	  $('#loading').show();
	Authenticate(username,password);
	//login(username,password);
	}
	
  
     });
	
	function Authenticate(username,password)
	{
		
		$.post(''+server+'login.php',{username:username,password:password} ,function(data)
        {
			
			var server_info = $.trim(data);
			if (server_info!="yes")
			 {
			
			    var error ='<div class="alert alert-error" > <strong>Oh snap!</strong> Invalid username or password.</div>';
				 $("#errorsms").empty();
				 $("#errorsms").append(error);
				   $('#loading').fadeOut();
				 $("#errorsms").fadeIn(1000);
		      	}
				else
				{
				 localStorage.session="yes";
				 window.location.href = 'home.html';
			
				}
				
				
		 });
		 
		 	
		
	}
	

	
	
 //get the details of the selected roadshow
 function meeting(id)
	{
	var data = {};
	$param = id;
	$.ajax({
	type:'GET',
	url:'http://192.168.140.23:8080/investordb/meetings/listMeetingsByRoadshows',
	dataType:'jsonp',
	data:{'id':$param },
	contentType:'application/json',
	success: function(data) {
	
	$("#meeting").empty();
	var heading =' <thead><tr ><td>ACTUAL DATE</td><td>PLANNED DATE</td><td>Investor Name</td><td>City Name</td><td>Country</td> <td>REGION</td><td>CONCERNS</td><td>MEETING TYPE</td><td>DETAILS</td></tr></thead>';
	$("#meeting").append(heading);
	for (var x = 0; x < data.length; x++) {
	var div_data ='<tr><td>'+data[x].actualDate+'</td><td>'+data[x].plannedDate+'</td><td>'+data[x].investorName+'</td><td>'+data[x].cityName+'</td><td>'+data[x].countryName+'</td><td>'+data[x].regionName+'</td><td>'+data[x].concernsObjectivesText+'</td><td>'+data[x].meetingType+'</td><td > <button  data-role="none"  type="button"  id="showdetails"  class="btn  btn-success" detailsid='+data[x].id+'> Show Details </button></td></tr>';
$("#meeting").append(div_data);
	$('#divmeeting').fadeIn();
	$('#loading').fadeOut(1000);
	$("#errorsms").fadeOut(500);
	}
	}
	,error: function (error) {
                 var error ='<div class="alert alert-error" > <strong>Sorry,no results found!</strong>.</div>';
				 $("#errorsms").empty();
				 $("#errorsms").append(error);
				$('#loading').fadeOut(1000);
				$("#errorsms").fadeIn(1000);
				$('#divmeeting').fadeOut(1000);
			
              }
	
	});


	}
	
	
		
 //get the details of the selected investor
 function investordetails(id)
	{
	var data = {};
	$param = id;
	$.ajax({
	type:'GET',
	url:'http://192.168.140.23:8080/investordb/investorPortfolio/listInvestorPortfolioByInvestor',
	dataType:'jsonp',
	data:{'id':$param},
	contentType:'application/json',
	success: function(data) {
	$("#invdetails").empty();
	var heading =' <thead><tr ><td>GuideLines Date</td><td>Name</td><td>BOUGHT AFDB</td><td>ASSETS</td><td>Fixed/FRN</td><td>Minimum Issue Size</td><td>AVERAGE TICKET SIZE</td> <td>LINES AVAILABLE</td><td>QUESTIONS TO AFDB</td><td>COMMENT</td><td>DESCRIPTION</td><td>rating</td><td>LIST FREFIXED FORMAT</td><td>CURRENCY</td><td>SSA</td><td>INVEST/PRIVATE/PLACEMENTS</td><td>ISSUER</td><td>ISSUERS</td><td>MATURITY/PREFERENCE/DESCRIPTION</td></tr></thead>';
	
	$("#invdetails").append(heading);
	for (var x = 0; x < data.length; x++) {
	var div_data ='<tr><td>'+data[x].guideLinesDate+'</td><td>'+data[x].name+'</td><td>'+data[x].boughtAfdb+'</td><td>'+data[x].assetsUnderManagement+'</td><td>'+data[x].fixedFloating+'</td><td>'+data[x].minimumIssueSize+'</td><td>'+data[x].averageTicketSize+'</td><td>'+data[x].linesAvailable+'</td><td>'+data[x].questionsToAfdb+'</td><td>'+data[x].comments+'</td><td>'+data[x].description+'</td><td>'+data[x].rating+'</td><td>'+data[x].listFrefixedFormat+'</td><td>'+data[x].listCurrencies+'</td><td>'+data[x].listSsa+'</td><td>'+data[x].investInPrivatePlacements+'</td><td>'+data[x].issuer+'</td><td>'+data[x].listIssuers+'</td><td>'+data[x].maturitypreferenceDescription+'</td></tr>';
	$("#invdetails").append(div_data);
	$('#divmeeting').fadeIn();
	$('#loading').fadeOut(1000);
	$("#errorsms").fadeOut(500);
	}
	}
	,error: function (error) {
                 var error ='<div class="alert alert-error" > <strong>Sorry,no results found!</strong>.</div>';
				 $("#errorsms").empty();
				 $("#errorsms").append(error);
				$('#loading').fadeOut(1000);
				$("#errorsms").fadeIn(1000);
				$('#divmeeting').fadeOut(1000);
			
              }
	
	});


	}





	function roadshow()
	{
	
	var data = {};
	var dataString = JSON.stringify(data);
	$.ajax({
	type:'POST',
	url:'http://192.168.140.23:8080/investordb/roadshows/listRoadshows',
	dataType:'jsonp',
	data:{data:dataString},
	contentType:'application/json',
	success: function(data) {
	
	//loop through all items in the JSON array
	for (var x = 0; x < data.length; x++) {
	var div_data ='<tr id="roadshowid" dataid='+data[x].id+' ><td>'+data[x].fromDate+'</td><td>'+data[x].toDate+'</td><td>'+data[x].description+'</td><td>'+data[x].objectif+'</td><td>'+data[x].RODSHOWARRANGER+'</td></tr> ';
    $("#roadshow").append(div_data);
     }
	}		 

    });	
   }
   
   	function investor()
	{
		
	
	var data = {};
	var dataString = JSON.stringify(data);
	$.ajax({
	type:'POST',
	url:'http://192.168.140.23:8080/investordb/investor/listInvestor',
	dataType:'jsonp',
	data:{data:dataString},
	contentType:'application/json',
	success: function(data) {
	
	//loop through all items in the JSON array
	for (var x = 0; x < data.length; x++) {
	var div_data ='<tr id="investorid" dataid='+data[x].id+'><td>'+data[x].longname+'</td><td>'+data[x].shortname+'</td><td>'+data[x].type+'</td><td>'+data[x].address+'</td></tr> ';
    $("#investor").append(div_data);
     }
	 }
    });	


   
   }
   
   	function primary()
	{

	
	var data = {};
	var dataString = JSON.stringify(data);
	$.ajax({
	type:'POST',
	url:'http://192.168.140.23:8080/investordb/primaryMarket/listPrimaryMarket',
	dataType:'jsonp',
	data:{data:dataString},
	contentType:'application/json',
	success: function(data) {
	//loop through all items in the JSON array
	for (var x = 0; x < data.length; x++) {
	var div_data ='<tr><td>'+data[x].orderamount+'</td><td>'+data[x].allocatedamount+'</td><td>'+data[x].borrowingid+'</td><td>'+data[x].INVESTORID+'</td><td>'+data[x].allocationdate+'</td><td>'+data[x].longname+'</td><td>'+data[x].benchmark+'</td><td>'+data[x].tradedate+'</td><td>'+data[x].coupon+'</td><td>'+data[x].ISSUER+'</td><td>'+data[x].currency+'</td><td>'+data[x].matdate+'</td><td>'+data[x].amount+'</td><td>'+data[x].allocationid+'</td></tr> ';
	
    $("#primary").append(div_data);
     }
	}		 

    });	
   }

   
      	function secondary()
	{
	
		var data = {};
	var dataString = JSON.stringify(data);
	$.ajax({
	type:'POST',
	url:'http://192.168.140.23:8080/investordb/secondaryMarket/listSecondaryMarket',
	dataType:'jsonp',
	data:{data:dataString},
	contentType:'application/json',
	success: function(data) {
	//loop through all items in the JSON array
	for (var x = 0; x < data.length; x++) {
	var div_data ='<tr><td>'+data[x].tradedate+'</td><td>'+data[x].comments+'</td><td>'+data[x].currency+'</td><td>'+data[x].price+'</td><td>'+data[x].tradeId+'</td><td>'+data[x].investor+'</td><td>'+data[x].matdate+'</td><td>'+data[x].buysell+'</td><td>'+data[x].benchmark+'</td><td>'+data[x].amount+'</td></tr> ';
	   $("#second").append(div_data);

     }
	}		 

    });	
   }

   
	//get the details of the selected meeting
 function meetingdetails(id)
	{
	var data = {};
	$param = id;
	//alert(id);
	var dataString = JSON.stringify(data);
	$.ajax({
	type:'POST',
	url:'http://192.168.140.23:8080/investordb/representatives/listRepresentativesByMeeting',
	dataType:'jsonp',
	data:{'id':$param},
	contentType:'application/json',
	
	success: function(data) {
	
	$("#meetingdetails").empty();
	var heading =' <thead><tr ><td>Representative Name</td><td>Investor Name</td></tr></thead>';
	$("#meetingdetails").append(heading);
	
	
	for (var x = 0; x < data.length; x++) {
	var div_data ='<tr><td>'+data[x].representativeName+'</td><td>'+data[x].repInvestorName+'</td></tr>';
	$("#meetingdetails").append(div_data);
	//alert(div_data);
	
	$('#meetingdetails').fadeIn();

	}
		$('#myModal').modal('toggle');
	}
		,error: function (error) {
                 var error ='<div class="alert alert-error" > <strong>Sorry,no results found!</strong>.</div>';
				 $("#errorsms").empty();
				 $("#errorsms").append(error);
				$("#errorsms").fadeIn(1000);
				//$('#divmeeting').fadeOut(1000);
			
              }
	
	});


	}
	




	
	
	 


});