<?php
include_once("C:/wamp/www/Online_Classified_Advertisement/lib/database.php");
include_once("C:/wamp/www/Online_Classified_Advertisement/Helpers/Format.php");
//include_once("../lib/Database.php");
//include_once("../helpers/Format.php");
?>
<?php
class City{
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function cityInsert($cityname,$adminId){
		$cityname=$this->fm->validation($cityname);
        $adminId=$this->fm->validation($adminId);

		$cityname=mysqli_real_escape_string($this->db->link,$cityname);
		$adminId=mysqli_real_escape_string($this->db->link,$adminId);

		if(empty($cityname)){
			$msg="<span style='color:red;'>City field must not be empty.</span>";
			return $msg;
		}else{
			$query="INSERT INTO city(city_name,status,admin_id) VALUES ('$cityname',1,'$adminId')";
			$cityinsert=$this->db->insert($query);
			if($cityinsert){
				$msg="<span style='color:green;'>New city inserted successfully.</span>";
				return $msg;
			}else{
				$msg="<span style='color:red;'>City insertation failed.</span>";
				return $msg;
			}

		}

	}

	public function cityUpdate($cityName,$id,$adminId){
		$cityName=$this->fm->validation($cityName);
		$id=$this->fm->validation($id);
		$adminId=$this->fm->validation($adminId);

		$cityName=mysqli_real_escape_string($this->db->link,$cityName);
		$id=mysqli_real_escape_string($this->db->link,$id);
		$adminId=mysqli_real_escape_string($this->db->link,$adminId);

		if(empty($cityName)){
			$msg="<span style='color:red'>City field must not be empty.</span>";
			return $msg;
		}else{
			$query="UPDATE city SET city_name='$cityName',admin_id='$adminId' WHERE city_id='$id'";
			$cityupdate=$this->db->update($query);
			if($cityupdate){
				$msg="<span style='color:green'>City updated successfully.</span>";
				return $msg;
			}else{
				$msg="<span style='color:red'>City update failed.</span>";
				return $msg;
			}

		}

	}

	public function getAllCity(){
		$query="SELECT * FROM city ORDER BY date";
		$cityselect=$this->db->select($query);
		return $cityselect;
	}

	public function getCityById($id){
		$id=mysqli_real_escape_string($this->db->link,$id);
		$query="SELECT * FROM city WHERE city_id='$id'";
		$cityselect=$this->db->select($query);
		return $cityselect;
	}

	public function deactivateCity($cityid){
        $cityid=mysqli_real_escape_string($this->db->link,$cityid);
		$query="UPDATE city SET status = '0' WHERE city_id = '$cityid'";
        $cityupdate=$this->db->update($query);
        if($cityupdate){
           return $cityupdate;
        }
	}

	public function activateCity($cityid){
        $cityid=mysqli_real_escape_string($this->db->link,$cityid);
		$query="UPDATE city SET status = '1' WHERE city_id = '$cityid'";
        $cityupdate=$this->db->update($query);
        if($cityupdate){
           return $cityupdate;
        }
	}

	 public function deleteCity($cityid){
            $cityid =$this->fm->validation($cityid);
            $cityid=mysqli_real_escape_string($this->db->link,$cityid);

            $query = "DELETE FROM city WHERE city_id=$cityid";
            $result=$this->db->delete($query);
           if($result!=FALSE){	
            header("location:manage_city.php?city_list");
        }
    }

    public function getAllActiveCity(){
		$query="SELECT * FROM city WHERE status='1' ORDER BY city_id";
		$cityselect=$this->db->select($query);
		return $cityselect;
	}
	 public function getAllDeactiveCity(){
		$query="SELECT * FROM city WHERE status='0' ORDER BY city_id";
		$cityselect=$this->db->select($query);
		return $cityselect;
	}

}

?>