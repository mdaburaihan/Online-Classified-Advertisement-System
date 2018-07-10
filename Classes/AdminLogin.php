<?php
include_once($_SERVER['DOCUMENT_ROOT']."/lib/Session.php");
Session::checkAdminLogin();
include_once($_SERVER['DOCUMENT_ROOT']."/lib/Database.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Helpers/Format.php");
?>
<?php
class Adminlogin {
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function AdminLogin($adminUser,$adminPass){
		$adminUser=$this->fm->validation($adminUser);
		$adminPass=$this->fm->validation(md5($adminPass));

		$adminUser=mysqli_real_escape_string($this->db->link,$adminUser);
		$adminPass=mysqli_real_escape_string($this->db->link,$adminPass);

		if(empty($adminUser) || empty($adminPass)){
			$loginmsg="Username or password must not be empty!";
			return $loginmsg;
		}else{
			$query="SELECT * FROM tbl_admin WHERE adminUsername='$adminUser' AND adminPassword='$adminPass'";
			$result=$this->db->select($query);

			if($result!=FALSE){
				$value=$result->fetch_assoc();
				Session::set("login",true);
				Session::set("adminId",$value['adminId']);
				Session::set("adminName",$value['adminName']);
				Session::set("adminUsername",$value['adminUsername']);
				Session::set("adminPassword",$value['adminPassword']);
				Session::set("adminrole",$value['role']);

				header("Location:index.php");
			}else{
				$loginmsg="Username or password does not match!";
				return $loginmsg;
			}
		}

	}
}
?>
