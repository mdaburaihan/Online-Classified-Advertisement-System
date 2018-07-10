<?php
//include_once("C:/wamp/www/Online_Classified_Advertisement/lib/Session.php");
//Session::checkUserLogin();
include_once("C:/wamp/www/Online_Classified_Advertisement/lib/database.php");
include_once("C:/wamp/www/Online_Classified_Advertisement/Helpers/Format.php");

?>
<?php
class Admin {
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}


	public function changePassword($data,$adminId)
	{

		if(empty($data['oldpwd']) || empty($data['newpwd']) || empty($data['rnewpwd']))
		{
			$msg="<span style='color:red'>Fields must not be empty.</span>";
			return $msg;
		}

		$oldpwd=$this->fm->validation(md5($data['oldpwd']));
		$newpwd=$this->fm->validation(md5($data['newpwd']));
		$rnewpwd=$this->fm->validation(md5($data['rnewpwd']));
		$adminId=$this->fm->validation($adminId);

		$oldpwd=mysqli_real_escape_string($this->db->link,$oldpwd);
		$newpwd=mysqli_real_escape_string($this->db->link,$newpwd);
		$rnewpwd=mysqli_real_escape_string($this->db->link,$rnewpwd);
		$adminId=mysqli_real_escape_string($this->db->link,$adminId);

		$query="SELECT password FROM admin_registration WHERE admin_id='$adminId'";
		$result=$this->db->select($query);
		if($result!=FALSE){
			$arr=$result->fetch_assoc();
			$dbpwd = $arr['password'];
			if($dbpwd==$oldpwd)
			{
				if($newpwd==$rnewpwd)
				{
					$query="UPDATE admin_registration SET password='$rnewpwd' WHERE admin_id='$adminId'";
					$pwdupdate=$this->db->update($query);
					if($pwdupdate){
						$msg="<span style='color:green'>Password changed successfully.</span>";
						return $msg;
					}else{
						$msg="<span style='color:red'>Password chnage failed.</span>";
						return $msg;
					}
				}
				else
				{
					$msg="<span style='color:red'>Re-enter new password.</span>";
					return $msg;
				}
			}
			else
			{
				$msg="<span style='color:red'>Old Password is incorrect.</span>";
				return $msg;
			}
		}

	}

	public function getAdminById($id){
		$id=mysqli_real_escape_string($this->db->link,$id);
		$query="SELECT * FROM admin_registration WHERE admin_id='$id'";
		$adminselect=$this->db->select($query);
		return $adminselect;
	}

	public function profileUpdate($data,$adminId){
		$name=$this->fm->validation($data['name']);
		$email=$this->fm->validation($data['email']);
		$phone=$this->fm->validation($data['phone']);
		$adminId=$this->fm->validation($adminId);


		$name=mysqli_real_escape_string($this->db->link,$name);
		$email=mysqli_real_escape_string($this->db->link,$email);
		$phone=mysqli_real_escape_string($this->db->link,$phone);
		$adminId=mysqli_real_escape_string($this->db->link,$adminId);

		if(empty($name) || empty($email) || empty($phone)){
			$msg="<span style='color:red'>Fields must not be empty.</span>";
			return $msg;
		}else{
			$query="UPDATE admin_registration SET name='$name',email='$email',phone='$phone' WHERE admin_id='$adminId'";
			$catupdate=$this->db->update($query);
			if($catupdate){
				$msg="<span style='color:green'>Profile updated successfully.</span>";
				return $msg;
			}else{
				$msg="<span style='color:red'>Profile update failed.</span>";
				return $msg;
			}

		}

	}

	public function addNewUser($data){
		if(empty($data['name']) || empty($data['email']) || empty($data['phone']) || empty($data['pwd']) || empty($data['cpwd'])){
			$msg="<span style='color:red'>Fields must not be empty.</span>";
			return $msg;
		}
		$name=$this->fm->validation($data['name']);
		$email=$this->fm->validation($data['email']);
		$phone=$this->fm->validation($data['phone']);
		$pwd=$this->fm->validation(md5($data['pwd']));
		$cpwd=$this->fm->validation(md5($data['cpwd']));

		$name=mysqli_real_escape_string($this->db->link,$name);
		$email=mysqli_real_escape_string($this->db->link,$email);
		$phone=mysqli_real_escape_string($this->db->link,$phone);
		$pwd=mysqli_real_escape_string($this->db->link,$pwd);
		$cpwd=mysqli_real_escape_string($this->db->link,$cpwd);

		if($pwd != $cpwd){
			$msg="<span style='color:red'>Re-enter password.</span>";
			return $msg;
		}else{
			$query="INSERT INTO admin_registration(name,email,phone,password) VALUES('$name','$email','$phone','$cpwd')";
			$result=$this->db->insert($query);

			if($result!=FALSE){
				$msg="<span style='color:green;'>New admin added successfully.</span>";
				return $msg;
			}else{
				$msg="<span style='color:red;'>New admin addition failed.</span>";
				return $msg;
			}

		}
	}

	public function getAllAdmin(){
		$query="SELECT * FROM admin_registration ORDER BY date DESC";
		$adminselect=$this->db->select($query);
		return $adminselect;
	}
}
?>

