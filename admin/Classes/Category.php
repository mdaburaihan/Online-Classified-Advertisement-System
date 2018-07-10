<?php
include_once("C:/wamp/www/Online_Classified_Advertisement/lib/database.php");
include_once("C:/wamp/www/Online_Classified_Advertisement/Helpers/Format.php");
//include_once("../lib/Database.php");
//include_once("../helpers/Format.php");
?>
<?php
class Category{
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function catInsert($catName,$adminId){
		$catName=$this->fm->validation($catName);
		$adminId=$this->fm->validation($adminId);
        
		$catName=mysqli_real_escape_string($this->db->link,$catName);
		$adminId=mysqli_real_escape_string($this->db->link,$adminId);

		if(empty($catName)){
			$msg="<span style='color:red'>Category field must not be empty.</span>";
			return $msg;
		}else{
			$query="INSERT INTO category(cat_name,status,admin_id) VALUES ('$catName',1,'$adminId')";
			$catinsert=$this->db->insert($query);
			if($catinsert){
				$msg="<span style='color:green'>Category inserted successfully.</span>";
				return $msg;
			}else{
				$msg="<span style='color:red'>Category insert failed.</span>";
				return $msg;
			}

		}

	}

	public function getAllCategory(){
		$query="SELECT * FROM category ORDER BY date";
		$catselect=$this->db->select($query);
		return $catselect;
	}

	public function getCategoryById($id){
		$id=mysqli_real_escape_string($this->db->link,$id);
		$query="SELECT * FROM category WHERE cat_id='$id'";
		$catselect=$this->db->select($query);
		return $catselect;
	}

	public function catUpdate($catName,$id,$adminId){
		$catName=$this->fm->validation($catName);
		$id=$this->fm->validation($id);
		$adminId=$this->fm->validation($adminId);


		$catName=mysqli_real_escape_string($this->db->link,$catName);
		$id=mysqli_real_escape_string($this->db->link,$id);
		$adminId=mysqli_real_escape_string($this->db->link,$adminId);

		if(empty($catName)){
			$msg="<span style='color:red'>Category field must not be empty.</span>";
			return $msg;
		}else{
			$query="UPDATE category SET cat_name='$catName',admin_id='$adminId' WHERE cat_id='$id'";
			$catupdate=$this->db->update($query);
			if($catupdate){
				$msg="<span style='color:green'>Category updated successfully.</span>";
				return $msg;
			}else{
				$msg="<span style='color:red'>Category update failed</span>";
				return $msg;
			}

		}

	}

	public function delCatById($id){
		$id=mysqli_real_escape_string($this->db->link,$id);
		$query="DELETE FROM tbl_category WHERE catId='$id'";
        $catdelete=$this->db->delete($query);
        if($catdelete){
        	$msg="<span class='success'>Category deleted successfully.</span>";
			return $msg;
        }else{
        	$msg="<span class='error'>Category not deleted!</span>";
			return $msg;
        }
	}

	public function deactivateCategory($catid){
        $catid=mysqli_real_escape_string($this->db->link,$catid);
		$query="UPDATE category SET status = '0' WHERE cat_id = '$catid'";
        $catupdate=$this->db->update($query);
        if($catupdate){
           return $catupdate;
        }
	}

	public function activateCategory($catid){
        $catid=mysqli_real_escape_string($this->db->link,$catid);
		$query="UPDATE category SET status = '1' WHERE cat_id = '$catid'";
        $catupdate=$this->db->update($query);
        if($catupdate){
           return $catupdate;
        }
	}

	public function getAllActiveCategory(){
		$query="SELECT * FROM category WHERE status='1' ORDER BY cat_id";
		$catselect=$this->db->select($query);
		return $catselect;
	}
	public function getAllDeactiveCategory(){
		$query="SELECT * FROM category WHERE status='0' ORDER BY cat_id";
		$catselect=$this->db->select($query);
		return $catselect;
	}

	 public function deleteCategory($catid){
            $catid =$this->fm->Validation($catid);
            $catid=mysqli_real_escape_string($this->db->link,$catid);

            $query = "DELETE FROM category WHERE cat_id=$catid";
            $result=$this->db->delete($query);
           if($result!=FALSE){	
            header("location:manage_cat_subcat.php?category_list");
        }
    }
}

?>