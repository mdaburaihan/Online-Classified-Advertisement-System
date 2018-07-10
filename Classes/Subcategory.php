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

	public function subCatInsert($subcatName,$catId){
		$subcatName=$this->fm->validation($subcatName);
		$catId=$this->fm->validation($catId);

		$subcatName=mysqli_real_escape_string($this->db->link,$subcatName);
		$catId=mysqli_real_escape_string($this->db->link,$catId);

		if(empty($subcatName) || empty($catId)){
			$msg="<span class='error'>Subcategory or category field must not be empty!</span>";
			return $msg;
		}else{
			$query="INSERT INTO tbl_subcategory(subcatName,catId) VALUES ('$subcatName','$catId')";
			$subcatinsert=$this->db->insert($query);
			if($subcatinsert){
				$msg="<span class='success'>Subcategory inserted successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Subcategory not inserted!</span>";
				return $msg;
			}

		}
	}

	public function getAllSubcategory(){
		$query="SELECT * FROM tbl_subcategory s,tbl_category c WHERE s.catId=c.catId";
		$subcatselect=$this->db->select($query);
		return $subcatselect;
	}

	public function delSubcatById($id){
		$id=mysqli_real_escape_string($this->db->link,$id);
		$query="DELETE FROM tbl_subcategory WHERE subcatId='$id'";
        $subcatdelete=$this->db->delete($query);
        if($subcatdelete){
        	$msg="<span class='success'>Subcategory deleted successfully.</span>";
			return $msg;
        }else{
        	$msg="<span class='error'>Subcategory not deleted!</span>";
			return $msg;
        }
	}

	public function getSubcatById($id){
		$id=mysqli_real_escape_string($this->db->link,$id);
		$query="SELECT * FROM tbl_subcategory WHERE subcatId='$id'";
		$subcatselect=$this->db->select($query);
		return $subcatselect;
	}

	public function subcatUpdate($subcatName,$catId,$id){
		$subcatName=$this->fm->validation($subcatName);
		$catId=$this->fm->validation($catId);
		$id=$this->fm->validation($id);

		$subcatName=mysqli_real_escape_string($this->db->link,$subcatName);
		$catId=mysqli_real_escape_string($this->db->link,$catId);
		$id=mysqli_real_escape_string($this->db->link,$id);

		if(empty($subcatName) || empty($catId)){
			$msg="<span class='error'>Subcategory or category field must not be empty!</span>";
			return $msg;
		}else{
			$query="UPDATE tbl_subcategory SET subcatName='$subcatName',catId='$catId' WHERE subcatId='$id'";
			$subcatupdate=$this->db->update($query);
			if($subcatupdate){
				$msg="<span class='success'>Subcategory updated successfully.</span>";
				return $msg;
			}else{
				$msg="<span class='error'>Subcategory not updated!</span>";
				return $msg;
			}

		}

	}
}

?>