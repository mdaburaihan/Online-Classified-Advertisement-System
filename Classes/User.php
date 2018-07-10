<?php
//include_once("C:/wamp/www/Online_Classified_Advertisement/lib/Session.php");
//Session::checkUserSession();
include_once("C:/wamp/www/Online_Classified_Advertisement/lib/database.php");
include_once("C:/wamp/www/Online_Classified_Advertisement/Helpers/Format.php");
//include_once(__DIR__."../lib/Database.php");
//include_once(__DIR__."../helpers/Format.php");
?>
<?php
class User {
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function userRegistration($data){
		$name=$this->fm->validation($data['name']);
		$email=$this->fm->validation($data['email']);
		$phone=$this->fm->validation($data['phone']);
		$cityid=$this->fm->validation($data['cityid']);
		$pin=$this->fm->validation($data['pin']);
		$role=$this->fm->validation($data['role']);
		$pwd=$this->fm->validation(md5($data['pwd']));
		$cpwd=$this->fm->validation(md5($data['cpwd']));
		$captcha=$this->fm->validation($data['captcha']);

		$name=mysqli_real_escape_string($this->db->link,$name);
		$email=mysqli_real_escape_string($this->db->link,$email);
		$phone=mysqli_real_escape_string($this->db->link,$phone);
		$cityid=mysqli_real_escape_string($this->db->link,$cityid);
		$pin=mysqli_real_escape_string($this->db->link,$pin);
		$role=mysqli_real_escape_string($this->db->link,$role);
		$pwd=mysqli_real_escape_string($this->db->link,$pwd);
		$cpwd=mysqli_real_escape_string($this->db->link,$cpwd);
		$captcha=mysqli_real_escape_string($this->db->link,$captcha);

		if(!empty($email) && $role!=""){
			$sql="SELECT * FROM user_registration WHERE email='$email' AND role='$role'";
			$getemail=$this->db->select($sql);
		}

		if(empty($name) || empty($email) || empty($cityid) ||  empty($pin) || empty($phone) || empty($pwd)){
			$loginmsg="<span style='color:red;font-size:16px;'>Fields must not be empty.</span>";
			return $loginmsg;
		}else if($getemail){
			if($role=='S'){
				$loginmsg="<span style='color:red;font-size:16px;'>This email is already exist with a seller.Please use another email to sign up as seller.</span>";
				return $loginmsg;
			}else if($role=='B'){
				$loginmsg="<span style='color:red;font-size:16px;'>This email is already exist with a buyer.Please use another email to sign up as buyer.</span>";
				return $loginmsg;
			}else{
				
			}

		}else if($pwd != $cpwd){
			$loginmsg="<span style='color:red;font-size:16px;'>Re-enter password.</span>";
			return $loginmsg;
		}else if($captcha != $_SESSION['cap_code']){
			$loginmsg="<span style='color:red;font-size:16px;'>Invalid Captcha.</span>";
			return $loginmsg;
		}else{
			$query="INSERT INTO user_registration(name,email,phone,city_id,pin,password,role,block) VALUES('$name','$email','$phone','$cityid','$pin','$cpwd','$role','0')";
			$result=$this->db->insert($query);

			if($result!=FALSE){
				//$msg="<span style='color:green;font-size:16px;'>User registration successful.</span>";
				//return $msg;
				?>
				<script>
					alert('User registration successful.');
					window.location="login.php";
			    </script>
				<?php
			}else{
				$msg="<span style='color:red;font-size:16px;'>Registration failed.Please try again.</span>";
				return $msg;
			}
		}

	}

	public function userLogin($data){
		$email=$this->fm->validation($data['email']);
		$password=$this->fm->validation(md5($data['pass']));

		$email=mysqli_real_escape_string($this->db->link,$email);
		//echo "$email";
		$password=mysqli_real_escape_string($this->db->link,$password);
		//echo "$password";


		if(empty($email) || empty($password))
		{
			$loginmsg="<span style='color:red;font-size:16px;'>Email & password must not be empty.</span>";
			return $loginmsg;
		}
		else
		{
			if($data['role']==""){
				$loginmsg="<span style='color:red;font-size:18px;'>Please select who are you.</span>";
				return $loginmsg;
			}else{
				if($data['role'] == "admin"){
					$query="SELECT * FROM admin_registration WHERE email='$email' AND password='$password'";
					$result=$this->db->select($query);

					if($result!=FALSE){
						$value=$result->fetch_assoc();
						Session::set("login",true);
						Session::set("userId",$value['admin_id']);
						Session::set("name",$value['name']);
						Session::set("email",$value['email']);
						Session::set("password",$value['password']);
						Session::set("adminrole",$value['role']);

					//$loginmsg="<span style='color:green;'>Login Successful!</span>";
					//return $loginmsg;

						//header("Location:admin/admin_panel.php");
						?>
						<script>window.location="admin/admin_panel.php";</script>
						<?php
					}else{
						$loginmsg="<span style='color:red;font-size:16px;'>Email or password does not match.</span>";
						return $loginmsg;
					}
				}
				else if($data['role'] == "seller")
				{
					$query="SELECT * FROM user_registration WHERE email='$email' AND password='$password' AND role='S'";
					$result=$this->db->select($query);

					if($result!=FALSE){
						$value=$result->fetch_assoc();
						if($value['block']==1)
						{
							$loginmsg="<span style='color:red;font-size:16px;'>Your account is blocked.</span>";
				        	return $loginmsg;
						}

						Session::set("login",true);
						Session::set("userId",$value['user_id']);
						Session::set("name",$value['name']);
						Session::set("email",$value['email']);
						Session::set("password",$value['password']);
						Session::set("role",$value['role']);
						Session::set("login_time",time());
					//$loginmsg="<span style='color:green;'>Login Successful!</span>";
					//return $loginmsg;
						$userId = Session::get("userId");

						$qry="SELECT * FROM selected_scheme WHERE user_id='$userId' AND status='1'";/////fetching currently selected scheme details
						$res=$this->db->select($qry);
						if($res)
						{
							$data = $res->fetch_assoc();
							if(date("Y-m-d") > $data["deactivation_date"])/////if current date is greater than deactivation date of current selected scheme
							{
								$selectedSchemeId = $data["selected_scheme_id"];//////then fetching the current selected scheme's id


                           ///////inserting the previous selected scheme and ads posted under this scheme details that is ad_id and active_status of the ad in previous selected scheme in previous selected scheme table (start)
								$insert_qry="INSERT INTO previous_selected_scheme(selected_scheme_id,ad_id,user_id,active_status)
								SELECT selected_scheme_id,ad_id,user_id,active_status FROM ad_details WHERE selected_scheme_id='$selectedSchemeId'";
								$insert_res=$this->db->insert($insert_qry);
                            ///////inserting the previous selected scheme and ads posted under this scheme details that is ad_id and active_status of the ad in previous selected scheme in previous selected scheme table (end)

						    //////updating the active_status to 0 in ad_details (start)
								$update_qry2="UPDATE ad_details SET active_status='0' WHERE user_id='$userId' AND selected_scheme_id='$selectedSchemeId' AND active_status='1'";
								$update_res2=$this->db->update($update_qry2);
						    //////updating the active_status to 0 in ad_details (end)


							//////updating the selected_scheme status to 0 in selected_scheme (start)
								$update_qry="UPDATE selected_scheme SET status='0' WHERE user_id='$userId' AND selected_scheme_id='$selectedSchemeId'";
								$update_res=$this->db->update($update_qry);
							//////updating the selected_scheme status to 0 in selected_scheme (start)
							} 
						}
						
						//header("Location:seller_dashboard.php");
						?>
						<script>window.location="seller_dashboard.php";</script>
						<?php
					}else{
						$loginmsg="<span style='color:red;font-size:16px;'>Email or password does not match.</span>";
						return $loginmsg;
					}
				}
				else if($data['role'] == "buyer"){
					$query="SELECT * FROM user_registration WHERE email='$email' AND password='$password' AND role='B'";
					$result=$this->db->select($query);

					if($result!=FALSE){
						$value=$result->fetch_assoc();
						if($value['block']==1)
						{
							$loginmsg="<span style='color:red;font-size:16px;'>Your account is blocked.</span>";
				        	return $loginmsg;
						}
						
						Session::set("login",true);
						Session::set("userId",$value['user_id']);
						Session::set("name",$value['name']);
						Session::set("email",$value['email']);
						Session::set("password",$value['password']);
						Session::set("role",$value['role']);
						Session::set("login_time",time());
						//$hh=Session::get("name");
					   //$loginmsg="<span style='color:green;'>$hh</span>";
					   //return $loginmsg;
						//header("Location:buyer_dashboard.php");
						?>
						<script>window.location="buyer_dashboard.php";</script>
						<?php
					}
					else{
						$loginmsg="<span style='color:red;font-size:16px;'>Email or password does not match.</span>";
						return $loginmsg;
					}
				}
				else{
					$loginmsg="<span style='color:red;font-size:16px;'>Email or password does not match.</span>";
					return $loginmsg;
				}
			}
		}
	}

	
	public function getAllSeller(){
		$query="SELECT * FROM user_registration WHERE role='S'";
		$sellerselect=$this->db->select($query);
		return $sellerselect;
	}

	public function getAllBuyer(){
		$query="SELECT * FROM user_registration WHERE role='B'";
		$buyerselect=$this->db->select($query);
		return $buyerselect;
	}

	public function getAllUser(){
		$query="SELECT 
		user_registration.user_id AS user_id,
		user_registration.name AS name,
		user_registration.email AS email,
		user_registration.phone AS phone,
		user_registration.city_id AS city_id,
		user_registration.pin AS pin,
		user_registration.role AS role,
		user_registration.date AS joindate,
		user_registration.block AS block,
		city.city_name AS city_name
		FROM user_registration
		LEFT JOIN city ON city.city_id = user_registration.city_id ORDER BY user_registration.date DESC";
		$userselect=$this->db->select($query);
		return $userselect;
	}

	public function getUserById($id){
		$id=$this->fm->validation($id);
		$id=mysqli_real_escape_string($this->db->link,$id);

		$query="SELECT * FROM user_registration WHERE user_id='$id'";
		$userselect=$this->db->select($query);
		return $userselect;
	}

	public function profileUpdate($data,$userid){
		$name=$this->fm->validation($data['name']);
		$email=$this->fm->validation($data['email']);
		$phone=$this->fm->validation($data['phone']);
		$cityid=$this->fm->validation($data['cityid']);
		$pin=$this->fm->validation($data['pin']);
		$userid=$this->fm->validation($userid);


		$name=mysqli_real_escape_string($this->db->link,$name);
		$email=mysqli_real_escape_string($this->db->link,$email);
		$phone=mysqli_real_escape_string($this->db->link,$phone);
		$cityid=mysqli_real_escape_string($this->db->link,$cityid);
		$pin=mysqli_real_escape_string($this->db->link,$pin);
		$userid=mysqli_real_escape_string($this->db->link,$userid);

		if(empty($name) || empty($email) || empty($phone) || empty($cityid) || empty($pin)){
			$msg="<span style='color:red'>Input fields must not be empty!</span>";
			return $msg;
		}else{
			$query="UPDATE user_registration SET name='$name',email='$email',phone='$phone',city_id='$cityid',pin='$pin' WHERE user_id='$userid'";
			$profileupdate=$this->db->update($query);
			if($profileupdate){
				$msg="<span style='color:green;'>Profile updated successfully!</span>";
				return $msg;
			}else{
				$msg="<span style='color:red'>Profile updatation failed!</span>";
				return $msg;
			}

		}

	}


	public function changePassword($data,$userId)
	{

		if(empty($data['oldpwd']) || empty($data['newpwd']) || empty($data['rnewpwd']))
		{
			$msg="<span style='color:red'>Input fields must not be empty!</span>";
			return $msg;
		}

		$oldpwd=$this->fm->validation(md5($data['oldpwd']));
		$newpwd=$this->fm->validation(md5($data['newpwd']));
		$rnewpwd=$this->fm->validation(md5($data['rnewpwd']));
		$userId=$this->fm->validation($userId);

		$oldpwd=mysqli_real_escape_string($this->db->link,$oldpwd);
		$newpwd=mysqli_real_escape_string($this->db->link,$newpwd);
		$rnewpwd=mysqli_real_escape_string($this->db->link,$rnewpwd);
		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="SELECT password FROM user_registration WHERE user_id='$userId'";
		$result=$this->db->select($query);
		if($result!=FALSE){
			$arr=$result->fetch_assoc();
			$dbpwd = $arr['password'];
			if($dbpwd==$oldpwd)
			{
				if($newpwd==$rnewpwd)
				{
					$query="UPDATE user_registration SET password='$rnewpwd' WHERE  user_id='$userId'";
					$pwdupdate=$this->db->update($query);
					if($pwdupdate){
						$msg="<span style='color:green'>Password updated successfully.</span>";
						return $msg;
					}else{
						$msg="<span style='color:red'>Password updation failed!</span>";
						return $msg;
					}
				}
				else
				{
					$msg="<span style='color:red'>Re-enter new password!</span>";
					return $msg;
				}
			}
			else
			{
				$msg="<span style='color:red'>Old Password is incorrect!</span>";
				return $msg;
			}
		}

	}


	public function checkEmailAvailable($email)
	{
		$email=$this->fm->validation($email);

		$email=mysqli_real_escape_string($this->db->link,$email);

		$sql="SELECT * FROM user_registration WHERE email='$email'";
		$getemail=$this->db->select($sql);
		
		if($getemail)
		{
			echo"Email is not available.";
			exit();
		}
		else
		{
			echo"Email is available.";
			exit();
		}
	}

	public function getUsersCityWise($data){
		$cityid=$this->fm->validation($data['cityid']);
		$role=$this->fm->validation($data['role']);

		$cityid=mysqli_real_escape_string($this->db->link,$cityid);
		$role=mysqli_real_escape_string($this->db->link,$role);

		if(!empty($cityid) && empty($role))
		{
			$query="SELECT 
			user_registration.user_id AS user_id,
			user_registration.name AS name,
			user_registration.email AS email,
			user_registration.phone AS phone,
			user_registration.city_id AS city_id,
			user_registration.pin AS pin,
			user_registration.role AS role,
			user_registration.date AS joindate,
			user_registration.block AS block,
			city.city_name AS city_name
			FROM user_registration
			LEFT JOIN city ON city.city_id = user_registration.city_id
			WHERE user_registration.city_id='$cityid' ORDER BY user_registration.date DESC";

			$userselect=$this->db->select($query);
			return $userselect;
		}

		if(empty($cityid) && !empty($role))
		{
			$query="SELECT 
			user_registration.user_id AS user_id,
			user_registration.name AS name,
			user_registration.email AS email,
			user_registration.phone AS phone,
			user_registration.city_id AS city_id,
			user_registration.pin AS pin,
			user_registration.role AS role,
			user_registration.date AS joindate,
			user_registration.block AS block,
			city.city_name AS city_name
			FROM user_registration
			LEFT JOIN city ON city.city_id = user_registration.city_id
			WHERE user_registration.role='$role' ORDER BY user_registration.date DESC";

			$userselect=$this->db->select($query);
			return $userselect;
		}

		if(!empty($cityid) && !empty($role))
		{
			$query="SELECT 
			user_registration.user_id AS user_id,
			user_registration.name AS name,
			user_registration.email AS email,
			user_registration.phone AS phone,
			user_registration.city_id AS city_id,
			user_registration.pin AS pin,
			user_registration.role AS role,
			user_registration.date AS joindate,
			user_registration.block AS block,
			city.city_name AS city_name
			FROM user_registration
			LEFT JOIN city ON city.city_id = user_registration.city_id
			WHERE user_registration.role='$role' AND user_registration.city_id='$cityid' ORDER BY user_registration.date DESC";

			$userselect=$this->db->select($query);
			return $userselect;
		}
	}

	public function blockUser($userid){
		$userid =$this->fm->validation($userid);
		$userid=mysqli_real_escape_string($this->db->link,$userid);
		$query="UPDATE user_registration SET block = '1' WHERE user_id=$userid";
		$userUpdate=$this->db->update($query);
		if($userUpdate){
		    
		 $queryBlockAllAds = "UPDATE ad_details SET active_status='4' WHERE user_id=$userid";
		 $resultBlockAllAds = $this->db->update($queryBlockAllAds); 
		    
		 ///informing user that he/she is blocked////
		 $queryGetUserDetails="SELECT * FROM user_registration WHERE user_id=$userid";
		 $resultGetUserDetails=$this->db->select($queryGetUserDetails);
		 
		 $getUserDetails = $resultGetUserDetails->fetch_assoc();
		 
		 $userEmail=$getUserDetails['email'];
		 
         //$to="rohanraihan3@gmail.com";
         $subject="Admin(Online Classified Advertisement System)";
		 $header = "From:Classified@gmail.com \r\n";
         //$header .= "Cc:afgh@somedomain.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         $message="Your account in Online Classified Advertisement System is blocked by admin for violating terms & conditions. Further information contact at Classified@gmail.com.";
         
         $sendmailtouser = mail ($userEmail,$subject,$message,$header);
         
			return $userUpdate;
		}
	}

		public function identifyUserAndSendResetLink($data){
		$email=$this->fm->validation($data['email']);
		$role=$this->fm->validation($data['role']);

		$email=mysqli_real_escape_string($this->db->link,$email);
		$role=mysqli_real_escape_string($this->db->link,$role);

		$query="SELECT * FROM user_registration WHERE email='$email' AND role='$role'";
		$result=$this->db->select($query);
		if($result)
		{
			  $value=$result->fetch_assoc();
			  $userid=$value['user_id'];
			  $block=$value['block'];

			  if($block == 1)
			  {
			  	$msg="<span style='color:red;font-size:16px'>Your account is blocked. You can't recover password.</span>";
			     return $msg;
			  }
			  else
			  {
			  	  $text="kloakyathatergsdhdiurtyhfnfmlosksjy";
				  $text=str_shuffle($text);
				  $text=substr($text,0,3);
				  $rand=rand(10000,99999);

				  $token="$text$rand"; 
				  
				  $query="UPDATE user_registration SET temp_token='$token',token_expires=DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE user_id='$userid'";
		          $updateuser=$this->db->update($query);
				  
				 $to="rohanraihan3@gmail.com";
		         $subject="Password Reset Link";
				 $header = "From:Classified@gmail.com \r\n";
		         //$header .= "Cc:afgh@somedomain.com \r\n";
		         $header .= "MIME-Version: 1.0\r\n";
		         $header .= "Content-type: text/html\r\n";
		         $message="Click on the given link to obtain your recovery password. Please change the password with your own after login with this new password. This link is valid for 5 minutes.<br><br>
		                   <a href='https://aburaihan.000webhsotapp.com/recovery_password.php?token=$token&email=$email'>
		                   https://aburaihan.000webhsotapp.com/recovery_password.php?token=$token&email=$email
		                   </a> <br><br>
		                   From Online Classifieds Advertisement System.<br><br>
		                   Note: If this request not made by you. please don't click on link. Your account may be in danger. Please update your password as fast as possible.";
		                 
		         $sendmailtouser = mail ($to,$subject,$message,$header);
				  
				  if($$sendmailtouser){
					  $msg="<span style='color:green;font-size:16px'>Please find link in Email.</span>";
				      return $msg;
				  }else{
					 $msg="<span style='color:red;font-size:16px'>Email not sent.Please try again.</span>";
				     return $msg;
				  }
			  }
		  }
		else
		{
			$msg="<span style='color:red;font-size:16px'>Your account is not identified.</span>";
			return $msg;
		}
		
	}

	public function verifyUserAndGenerateRecoveryPassword($email,$token){
		$email=$this->fm->validation($email);
		$token=$this->fm->validation($token);

		$email=mysqli_real_escape_string($this->db->link,$email);
		$token=mysqli_real_escape_string($this->db->link,$token);

		$query="SELECT user_id FROM user_registration WHERE email='$email' AND temp_token='$token' AND temp_token<>'' AND token_expires>NOW()";
		$result=$this->db->select($query);
		if($result)
		{
			$data=$result->fetch_assoc();
			$userId = $data['user_id'];
			$text="kloakyathatergsdhdiurtyhfnfmlosksjy125874569874dddssertt74";
			$text=str_shuffle($text);
			$recoveryPassword=substr($text,0,10);
			$password=md5($recoveryPassword);

			$query="UPDATE user_registration SET password='$password' WHERE user_id='$userId' AND email='$email'";
	        $updateuser=$this->db->update($query);

	        echo "Your New Password is $recoveryPassword.<br><a href='login.php'>Click here to Login</a>";

		}
		else
		{
			?>
			<script>window.location="404.php";</script>
			<?php
		}
	}

}
?>

