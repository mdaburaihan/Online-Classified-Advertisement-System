<?php
//include_once("C:/wamp/www/Online_Classified_Advertisement/lib/Session.php");
//Session::checkUserLogin();
include_once("C:/wamp/www/Online_Classified_Advertisement/lib/database.php");
include_once("C:/wamp/www/Online_Classified_Advertisement/Helpers/Format.php");
//include_once(__DIR__."../lib/Database.php");
//include_once(__DIR__."../helpers/Format.php");
?>
<?php
class Seller {
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function isSchemeSelected($userId){
		$userId=$this->fm->validation($userId);
		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="SELECT * FROM selected_scheme WHERE user_id='$userId' AND status=1";
		$result=$this->db->select($query);
		if($result!=FALSE){
		$arr = $result->fetch_assoc();
		$scheme_id = $arr['scheme_id'];
		$deactivation_date = $arr['deactivation_date'];
		$deactivation_date = substr("$deactivation_date",0,10);
		$date=date_create("$deactivation_date");
        $deactivation_date = date_format($date,"d/m/Y");
        
			$qry="SELECT * FROM scheme WHERE scheme_id='$scheme_id'";
	     	$res=$this->db->select($qry);
			$arrr = $res->fetch_assoc();
			$ads = $arrr['Ads'];
			$days = $arrr['days'];

			$msg="Your current selected scheme is <strong>$ads Ads for $days days</strong>! Which is valid till $deactivation_date.";
			return $msg;
		}else{
		     $msg="Currenctly you have selected no scheme.";
			 return $msg;
		}
	}

	public function ifAnySchemeSelected($userId){
		$userId=$this->fm->validation($userId);
		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="SELECT * FROM selected_scheme WHERE user_id='$userId' AND status=1";
		$result=$this->db->select($query);
		if($result!=FALSE){
		return true;
	}else{
		return false;
	}
  }

  public function getSelectedSchemeByUserId($userId){
     	$userId=$this->fm->validation($userId);

		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="SELECT * FROM selected_scheme WHERE user_id='$userId' AND status=1";
		$schemeselected=$this->db->select($query);
		return $schemeselected;
	}

	 public function getPostedAdNo($userId){
     	$userId=$this->fm->validation($userId);

		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$qry="SELECT * FROM selected_scheme WHERE user_id='$userId' AND status=1";
		$res=$this->db->select($qry);
		if($res!=FALSE){
		$arr = $res->fetch_assoc();
		$selected_scheme_id = $arr['selected_scheme_id'];
	}

	  if(!empty($selected_scheme_id))
      {
		$query="SELECT * FROM ad_details WHERE user_id='$userId' AND selected_scheme_id='$selected_scheme_id' AND active_status IN('0','1')";
		$postedAds= $this->db->select($query);
		return $postedAds;
	  }
	}

	public function getAdNoUnderCurrentScheme($userId){
     	$userId=$this->fm->validation($userId);

		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="SELECT * FROM selected_scheme 
		        INNER JOIN scheme ON scheme.scheme_id = selected_scheme.scheme_id
		        WHERE user_id='$userId' AND selected_scheme.status=1";
		$AdNo= $this->db->select($query);
		return $AdNo;
	}

	public function getAdsOfPreviousSelectedSchemes($userId){
     	$userId=$this->fm->validation($userId);

		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="SELECT DISTINCT ad_id FROM previous_selected_scheme WHERE user_id='$userId' AND active_status IN('0','1')";
		$PreviousSchemeAdNo= $this->db->select($query);
		return $PreviousSchemeAdNo;
	}

	public function getAllSoldProductsByUserId($userId){

		$userId=$this->fm->validation($userId);

		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="SELECT 
		title,
		pic1,
		price,
		description,
		ad_details.date as date
		FROM ad_details
		INNER JOIN category ON category.cat_id = ad_details.cat_id
		INNER JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		INNER JOIN city ON city.city_id = ad_details.city_id
		WHERE ad_details.user_id='$userId' AND ad_details.active_status='3'";
		$res=$this->db->select($query);
		return $res;
	}
}