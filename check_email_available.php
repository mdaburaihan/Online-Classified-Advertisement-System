<?php
include_once ("Classes/User.php");
$usr=new User();

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$email=$_POST['email'];
	$emailavailable=$usr->checkEmailAvailable($email);
}

?>