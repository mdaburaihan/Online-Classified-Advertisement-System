<?php
//include_once("C:/wamp/www/Online_Classified_Advertisement/lib/Session.php");
//Session::checkUserLogin();
include_once("C:/wamp/www/Online_Classified_Advertisement/lib/database.php");
include_once("C:/wamp/www/Online_Classified_Advertisement/Helpers/Format.php");
//include_once(__DIR__."../lib/Database.php");
//include_once(__DIR__."../helpers/Format.php");
?>
<?php
class Others {
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function getCategoryNameBySubcatId($subcatId){

		$subcatId=$this->fm->validation($subcatId);

		$subcatId=mysqli_real_escape_string($this->db->link,$subcatId);

		$query="SELECT * 
		FROM subcategory 
		INNER JOIN category ON category.cat_id = subcategory.cat_id
		WHERE subcat_id='$subcatId'";

		$subcatselect=$this->db->select($query);
		return $subcatselect;
	}

	public function getSubcategoriesByCatId($catId){

		$catId=$this->fm->validation($catId);

		$catId=mysqli_real_escape_string($this->db->link,$catId);

		$query="SELECT * 
		FROM subcategory 
		INNER JOIN category ON category.cat_id = subcategory.cat_id
		WHERE subcategory.cat_id='$catId'";

		$subcatselect=$this->db->select($query);
		return $subcatselect;

	}

	public function contactUs($data){

		$name=$this->fm->validation($data['name']);
		$email=$this->fm->validation($data['email']);
		$message=$this->fm->validation($data['message']);

		$name=mysqli_real_escape_string($this->db->link,$name);
		$email=mysqli_real_escape_string($this->db->link,$email);
		$message=mysqli_real_escape_string($this->db->link,$message);


		if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
		{
			$msg="<span style='color:red;font-size:16px;'>Only letters and white space allowed in name.</span>";
			return $msg;
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$msg="<span style='color:red;font-size:16px;'>Invalid Email.</span>";
			return $msg;
		}

		else
		{	
			 $to="rohanraihan3@gmail.com";
             $subject="Message From Online Classified Advertisement System,Sender Name ".$name;
			 $header = "From:".$email."\r\n";
	         //$header .= "Cc:afgh@somedomain.com \r\n";
	         $header .= "MIME-Version: 1.0\r\n";
	         $header .= "Content-type: text/html\r\n";
	         
	         $retval = mail ($to,$subject,$message,$header);
	         
	         if( $retval == true ) {
	           $msg="<span style='color:green;font-size:16px;'>Message sent successfully.</span>";
			   return $msg;
	         }else {
	            $msg="<span style='color:red;font-size:16px;'>Message could not be sent.</span>";
			    return $msg;
	         }
		}
	}

}



