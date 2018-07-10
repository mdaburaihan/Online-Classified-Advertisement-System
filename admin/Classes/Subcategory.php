<?php
include_once("C:/wamp/www/Online_Classified_Advertisement/lib/database.php");
include_once("C:/wamp/www/Online_Classified_Advertisement/Helpers/Format.php");
//include_once("../lib/Database.php");
//include_once("../helpers/Format.php");
?>
<?php
class Subcategory{
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function subcatInsert($subcatName,$catId,$adminId){
		$subcatName=$this->fm->validation($subcatName);
		$catId=$this->fm->validation($catId);
		$adminId=$this->fm->validation($adminId);

		$subcatName=mysqli_real_escape_string($this->db->link,$subcatName);
		$catId=mysqli_real_escape_string($this->db->link,$catId);
		$adminId=mysqli_real_escape_string($this->db->link,$adminId);

		if(empty($subcatName)){
			$msg="<span style='color:red;'>Subcategory field must not be empty.</span>";
			return $msg;
		}
		else if($catId == ""){
			$msg="<span style='color:red;'>Please select a category.</span>";
			return $msg;
		}else{
			$query="INSERT INTO subcategory(subcat_name,cat_id,status,admin_id) VALUES ('$subcatName','$catId',1,'$adminId')";
			$subcatinsert=$this->db->insert($query);
			if($subcatinsert){
				$msg="<span style='color:green;'>Subcategory inserted successfully.</span>";
				return $msg;
			}else{
				$msg="<span style='color:red;'>Subcategory insertation failed.</span>";
				return $msg;
			}

		}

	}

	public function getAllSubcategory(){
		$query="SELECT subcat_id,subcat_name,subcategory.cat_id,subcategory.status,category.cat_name FROM subcategory LEFT JOIN category ON category.cat_id = subcategory.cat_id ORDER BY subcategory.date;";
		$subcatselect=$this->db->select($query);
		return $subcatselect;
	}

public function getAllActiveSubcategoryByCatId($catId){

	    $catId=$this->fm->validation($catId);

	    $catId=mysqli_real_escape_string($this->db->link,$catId);

		$query="SELECT * FROM subcategory WHERE status='1' AND cat_id='$catId'";
		$subcatselect=$this->db->select($query);
		return $subcatselect;
	}
	public function getSubcategoryById($id){
		$id=mysqli_real_escape_string($this->db->link,$id);
		$query="SELECT * FROM subcategory WHERE subcat_id='$id'";
		$catselect=$this->db->select($query);
		return $catselect;
	}

	public function subcatUpdate($subcatName,$catid,$subcatid,$adminId){
		$subcatName=$this->fm->validation($subcatName);
		$catid=$this->fm->validation($catid);
		$subcatid=$this->fm->validation($subcatid);
		$adminId=$this->fm->validation($adminId);

		$subcatName=mysqli_real_escape_string($this->db->link,$subcatName);
		$catid=mysqli_real_escape_string($this->db->link,$catid);
		$subcatid=mysqli_real_escape_string($this->db->link,$subcatid);
		$adminId=mysqli_real_escape_string($this->db->link,$adminId);

		if(empty($subcatName)){
			$msg="<span style='color:red;'>Subcategory field must not be empty.</span>";
			return $msg;
		}else{
			$query="UPDATE subcategory SET subcat_name='$subcatName',cat_id = '$catid',admin_id='$adminId' WHERE subcat_id='$subcatid'";
			$scatupdate=$this->db->update($query);
			if($scatupdate){
				$msg="<span style='color:green;'>Subcategory updated successfully.</span>";
				return $msg;
			}else{
				$msg="<span style='color:red;'>Subcategory update failed.</span>";
				return $msg;
			}

		}

	}


	public function deactivateSubcategory($subcatid){
        $subcatid=mysqli_real_escape_string($this->db->link,$subcatid);
		$query="UPDATE subcategory SET status = '0' WHERE subcat_id = '$subcatid'";
        $subcatupdate=$this->db->update($query);
        if($subcatupdate){
           return $subcatupdate;
        }
	}

	public function activateSubcategory($subcatid){
        $subcatid=mysqli_real_escape_string($this->db->link,$subcatid);
		$query="UPDATE subcategory SET status = '1' WHERE subcat_id = '$subcatid'";
        $subcatupdate=$this->db->update($query);
        if($subcatupdate){
           return $subcatupdate;
        }
	}

	  public function deleteSubcategory($subcatid){
            $subcatid =$this->fm->validation($subcatid);
            $subcatid=mysqli_real_escape_string($this->db->link,$subcatid);

            $query = "DELETE FROM subcategory WHERE subcat_id=$subcatid";
            $result=$this->db->delete($query);
           if($result!=FALSE){	
            header("location:manage_cat_subcat.php?subcategory_list");
        }
    }
      public function getAllActiveSubcategory(){
		$query="SELECT * FROM subcategory WHERE status='1' ORDER BY subcat_id";
		$cityselect=$this->db->select($query);
		return $cityselect;
	}
	 public function getAllDeactiveSubcategory(){
		$query="SELECT * FROM subcategory WHERE status='0' ORDER BY subcat_id";
		$cityselect=$this->db->select($query);
		return $cityselect;
	}

}

?>