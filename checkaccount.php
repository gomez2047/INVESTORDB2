<?php 
session_start();
include_once 'Model/connectionstring.php';
include_once 'Model/UsersClass.php';
$GOF_USERS = new GOF_USERS();
if(isset($_POST['firstname']) AND isset($_POST['lastname']) AND isset($_POST['email']) AND isset($_POST['pass1']) AND isset($_POST['pass2']))
{
if(!empty($_POST['firstname']) || !empty($_POST['lastname']) || !empty($_POST['email']) || !empty($_POST['pass1']) || !empty($_POST['pass2']))
{
$firstname=htmlentities(mysql_real_escape_string ($_POST['firstname']));
$lastname=htmlentities(mysql_real_escape_string ($_POST['lastname']));
$email=htmlentities(mysql_real_escape_string ($_POST['email']));
$pass1=htmlentities(mysql_real_escape_string ($_POST['pass1']));
$pass2=htmlentities(mysql_real_escape_string ($_POST['pass2']));
$password= MD5(htmlentities(mysql_real_escape_string ($_POST['pass2'])));

if ((strlen($firstname)<=0))
{
echo'<div class="Servererror">Enter Your first name</div>';
}
elseif ((strlen($lastname)<=0))
{
echo'<div class="Servererror">Enter Your last name</div>';
}

elseif ((strlen($email)<=0))
{
echo'<div class="Servererror">Enter Your email</div>';
}
elseif (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
{
echo'<div class="Servererror">Invalid Email Address</div>';
}

elseif ((strlen($pass1)<=0))
{
echo'<div class="Servererror">Enter Your password</div>';
}

elseif ((strlen($pass2)<=0))
{
echo'<div class="Servererror">Invalid password</div>';
}
elseif ($pass1 != $pass2)
{
echo'<div class="Servererror">password does\'t match</div>';
}
elseif($GOF_USERS->check_mail($email)){
	echo"<div class='Servererror'>There is an existing account associated with this email </div>";
}

else 
{
$GOF_USERS->save_record($email,$firstname,$lastname,$password);
$GOF_USERS->welcome_mail($email);
echo"<div class='sucess'>account created <br><br>You'll be redirected in about 5 secs.<br></div>";
$_SESSION['user_name'] = $lastname." ".$firstname;
echo'<meta http-equiv="refresh" content="2;url=http://www.ghanaonfire.com/GhanaOnfire%20V2/ghanavideos.php">';
//header('Location: http://www.ghanaonfire.com/GhanaOnfire%20V2/ghanavideos.php');
  
}

}
else
{
echo'<div class="Servererror">You must fill in all the fields</div>';
}

}

