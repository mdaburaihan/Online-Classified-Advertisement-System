<?php
include_once("C:/wamp/www/Online_Classified_Advertisement/lib/database.php");
include_once("C:/wamp/www/Online_Classified_Advertisement/Helpers/Format.php");
//include_once("../lib/Database.php");
//include_once("../helpers/Format.php");
?>
<?php
class Scheme{
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function schemeInsert($days,$ads,$adminId){
		$days=$this->fm->validation($days);
		$ads=$this->fm->validation($ads);
		$adminId=$this->fm->validation($adminId);

		$days=mysqli_real_escape_string($this->db->link,$days);
		$ads=mysqli_real_escape_string($this->db->link,$ads);
		$adminId=mysqli_real_escape_string($this->db->link,$adminId);

		if(empty($days)){
			$msg="<span style='color:red;'>No. of days field must not be empty.</span>";
			return $msg;
		}
		else if(empty($ads)){
			$msg="<span style='color:red;'>No. of ads field must not be empty.</span>";
			return $msg;
		}else{
			$query="INSERT INTO scheme(days,Ads,status,admin_id) VALUES ('$days','$ads',1,'$adminId')";
			$schemeinsert=$this->db->insert($query);
			if($schemeinsert){
				$msg="<span style='color:green;'>Scheme inserted successfully.</span>";
				return $msg;
			}else{
				$msg="<span style='color:red;'>Scheme insertation failed.</span>";
				return $msg;
			}

		}

	}

	public function getAllScheme(){
		$query="SELECT * FROM scheme ORDER BY date";
		$schemeselect=$this->db->select($query);
		return $schemeselect;
	}

	public function getSchemeById($id){
		$id=mysqli_real_escape_string($this->db->link,$id);
		$query="SELECT * FROM scheme WHERE scheme_id='$id'";
		$schemeselect=$this->db->select($query);
		return $schemeselect;
	}

	public function schemeUpdate($days,$ads,$schemeid,$adminId){
		$days=$this->fm->validation($days);
		$ads=$this->fm->validation($ads);
		$schemeid=$this->fm->validation($schemeid);
		$adminId=$this->fm->validation($adminId);

		$days=mysqli_real_escape_string($this->db->link,$days);
		$ads=mysqli_real_escape_string($this->db->link,$ads);
		$schemeid=mysqli_real_escape_string($this->db->link,$schemeid);
		$adminId=mysqli_real_escape_string($this->db->link,$adminId);

		if(empty($days)){
			$msg="<span style='color:red;'>No. of days field must not be empty.</span>";
			return $msg;
		}
		else if(empty($ads)){
			$msg="<span style='color:red;'>No. of ads field must not be empty.</span>";
			return $msg;
		}else{
			$query="UPDATE scheme SET days='$days',Ads='$ads',admin_id='$adminId' WHERE scheme_id='$schemeid'";
			$catupdate=$this->db->update($query);
			if($catupdate){
				$msg="<span style='color:green;'>Scheme updated successfully.</span>";
				return $msg;
			}else{
				$msg="<span style='color:red;'>Scheme update failed.</span>";
				return $msg;
			}

		}

	}
	public function deactivateScheme($schemeid){
        $schemeid=mysqli_real_escape_string($this->db->link,$schemeid);
		$query="UPDATE scheme SET status = '0' WHERE scheme_id = '$schemeid'";
        $schemeupdate=$this->db->update($query);
        if($schemeupdate){
           return $schemeupdate;
        }
	}

	public function activateScheme($schemeid){
        $schemeid=mysqli_real_escape_string($this->db->link,$schemeid);
		$query="UPDATE scheme SET status = '1' WHERE scheme_id = '$schemeid'";
        $schemeupdate=$this->db->update($query);
        if($schemeupdate){
           return $schemeupdate;
        }
	}
	 public function deleteScheme($schemeid){
            $schemeid =$this->fm->Validation($schemeid);
            $schemeid=mysqli_real_escape_string($this->db->link,$schemeid);

            $query = "DELETE FROM scheme WHERE scheme_id='$schemeid'";
            $result=$this->db->delete($query);
           if($result!=FALSE){	
            header("location:manage_scheme.php?scheme_list");
        }
    }

    public function getAllActiveScheme(){
		$query="SELECT * FROM scheme WHERE status='1' ORDER BY date";
		$schemeselect=$this->db->select($query);
		return $schemeselect;
	}
	public function getAllDeactiveScheme(){
		$query="SELECT * FROM scheme WHERE status='0' ORDER BY date";
		$schemeselect=$this->db->select($query);
		return $schemeselect;
	}

	public function selectedSchemeInsert($data,$userid){
		$userid=$this->fm->validation($userid);
		$schemeid=$this->fm->validation($data['scheme']);

		$userid=mysqli_real_escape_string($this->db->link,$userid);
		$schemeid=mysqli_real_escape_string($this->db->link,$schemeid);

		$query="SELECT days FROM scheme WHERE scheme_id=$schemeid";
		$daySelect=$this->db->select($query);
        if($daySelect){
        	$arr=$daySelect->fetch_assoc();
            $days=$arr['days']-1;
        }
        $deactivationDate = date('Y-m-d', strtotime("+$days days"));

        $query="INSERT INTO selected_scheme(user_id,scheme_id,days,deactivation_date,status) VALUES ('$userid','$schemeid','$days', '$deactivationDate',1)";
			$selectedSchemeInsert=$this->db->insert($query);
			if($selectedSchemeInsert){
				/////updating selected_scheme_id in ad_details with new selected_scheme (start)
				$userid= Session::get("userId"); 
			    $qry="SELECT * FROM selected_scheme WHERE user_id='$userid' AND status='1'";
			    $res=$this->db->select($qry);
			    if($res){
				$arr=$res->fetch_assoc();
				$selectedSchemeId = $arr['selected_scheme_id'];
			    }

			    $qry2="UPDATE ad_details SET selected_scheme_id='$selectedSchemeId' WHERE user_id='$userid'";
			    $res2=$this->db->update($qry2);
			    /////updating selected_scheme_id in ad_details with new selected_scheme (end)
				$msg="<span style='color:green;'>You have successfully selected a scheme.</span>";
				return $msg;
			}else{
				$msg="<span style='color:red;'>Scheme selection failed! Please try again after some time.</span>";
				return $msg;
			}

	}

	public function getAllActiveSelectedScheme(){
		$query="SELECT * FROM selected_scheme WHERE status='1'";
		$selectedschemeselect=$this->db->select($query);
		return $selectedschemeselect;
	}

	
	public function updateOnSelectedSchemeExpired($selectedSchemeId,$userId){
		$selectedSchemeId=$this->fm->validation($selectedSchemeId);
		$userId=$this->fm->validation($userId);

		$selectedSchemeId=mysqli_real_escape_string($this->db->link,$selectedSchemeId);
		$userId=mysqli_real_escape_string($this->db->link,$userId);

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

?>