<?php
include("Classes/User.php");
$usr=new User();
if(isset($_GET['email']) && isset($_GET['token']))
{
	$email=$_GET['email'];
	$token=$_GET['token'];

	$verifyuserlink=verifyUserAndGenerateRecoveryPassword($email,$token);
}
else
{
	?>
	<script>window.location="404.php";</script>
	<?php
}
?>

