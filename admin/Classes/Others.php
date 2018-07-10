<?php
include_once("C:/wamp/www/Online_Classified_Advertisement/lib/database.php");
include_once("C:/wamp/www/Online_Classified_Advertisement/Helpers/Format.php");
//include_once("../lib/Database.php");
//include_once("../helpers/Format.php");
?>
<?php
class Others{
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}


public function autoCompleteSearchListCategory($searchAds)
	{
		//echo $searchAds;
     	$sql="SELECT * FROM category
     	      WHERE cat_name LIKE '%$searchAds%'";

     	     
		$getName=$this->db->select($sql);
		$result='';
		$result .='<div class="searchAds" style="font-size:18px;cursor:pointer;"><ul>';
		if($getName)
		{
			while($data=$getName->fetch_assoc())
			{
				$result .='<li style="list-style-type: none;">'.$data['cat_name'].'</li>';
				
			}
		}
		else
			{
				$result .='<li style="list-style-type: none;">No Data Found</li>';
			}
			$result .='</ul></div>';
		    echo $result;
	}

	public function autoCompleteSearchListSubcategory($searchAds)
	{
		//echo $searchAds;
     	$sql="SELECT * FROM subcategory
     	      WHERE subcat_name LIKE '%$searchAds%'";

     	     
		$getScat=$this->db->select($sql);
		$result='';
		$result .='<div class="searchAds" style="font-size:18px;cursor:pointer;"><ul>';
		if($getScat)
		{
			while($data=$getScat->fetch_assoc())
			{
				$result .='<li style="list-style-type: none;">'.$data['subcat_name'].'</li>';
				
			}
		}
		else
			{
				$result .='<li style="list-style-type: none;">No Data Found</li>';
			}
			$result .='</ul></div>';
		    echo $result;
	}

	public function autoCompleteSearchListCity($searchAds)
	{
		//echo $searchAds;
     	$sql="SELECT * FROM city
     	      WHERE city_name LIKE '%$searchAds%'";

     	     
		$getScat=$this->db->select($sql);
		$result='';
		$result .='<div class="searchAds" style="font-size:18px;cursor:pointer;"><ul>';
		if($getScat)
		{
			while($data=$getScat->fetch_assoc())
			{
				$result .='<li style="list-style-type: none;">'.$data['city_name'].'</li>';
				
			}
		}
		else
			{
				$result .='<li style="list-style-type: none;">No Data Found</li>';
			}
			$result .='</ul></div>';
		    echo $result;
	}

	public function autoCompleteSearchListAnything($searchAds)
	{
		//echo $searchAds;
     	$sql="SELECT * FROM ad_details
     	      WHERE title LIKE '%$searchAds%'";

     	     
		$getScat=$this->db->select($sql);
		$result='';
		$result .='<div class="searchAds" style="font-size:18px;cursor:pointer;"><ul>';
		if($getScat)
		{
			while($data=$getScat->fetch_assoc())
			{
				$result .='<li style="list-style-type: none;">'.$data['title'].'</li>';
				
			}
		}
		else
			{
				$result .='<li style="list-style-type: none;">No Data Found</li>';
			}
			$result .='</ul></div>';
		    echo $result;
	}

	public function editAboutUs($data)
	{
		$about=mysqli_real_escape_string($this->db->link,$data['aboutus']);

		if(empty($about))
		{
			$msg="<span style='color:red;'>Please write some texts.</span>";
			return $msg;
		}
		else
		{
			$sql="UPDATE others SET about_us='$about'";
	        $insertpost=$this->db->update($sql);
			
			if($insertpost){
				$msg="<span style='color:green;'>About Us section updated successfully.</span>";
			    return $msg;
			}else{
				$msg="<span style='color:red;'>About Us section update failed.</span>";
			    return $msg;
			}
		}

	}
	public function getAboutUs()
	{
		$query="SELECT * FROM others";
		$res=$this->db->select($query);
		return $res;
	}
	
	public function addNewFAQ($data)
	{
		$question=mysqli_real_escape_string($this->db->link,$data['question']);
		$answer=mysqli_real_escape_string($this->db->link,$data['answer']);

		if(empty($question) || empty($answer))
		{
			$msg="<span style='color:red;'>Question or answer must not be empty.</span>";
			return $msg;
		}
		else
		{
			$sql="INSERT INTO faqs(question,answer,status) VALUES ('$question','$answer',1)";
	        $insertpost=$this->db->update($sql);
			
			if($insertpost){
				$msg="<span style='color:green;'>FAQs section updated successfully.</span>";
			    return $msg;
			}else{
				$msg="<span style='color:red;'>FAQs section update failed.</span>";
			    return $msg;
			}
		}

	}
	
	public function getAllFAQs()
	{
		$query="SELECT * FROM faqs";
		$res=$this->db->select($query);
		return $res;
	}
	
	public function deactivateFAQ($faqid){
        $faqid=mysqli_real_escape_string($this->db->link,$faqid);
		$query="UPDATE faqs SET status = '0' WHERE faq_id = '$faqid'";
        $faqupdate=$this->db->update($query);
        if($faqupdate){
           return $faqupdate;
        }
	}

	public function activateFAQ($faqid){
        $faqid=mysqli_real_escape_string($this->db->link,$faqid);
		$query="UPDATE faqs SET status = '1' WHERE faq_id = '$faqid'";
        $faqupdate=$this->db->update($query);
        if($faqupdate){
           return $faqupdate;
        }
	}

	public function getFAQbyId($id){
		$id=mysqli_real_escape_string($this->db->link,$id);
		$query="SELECT * FROM faqs WHERE faq_id='$id'";
		$faqselect=$this->db->select($query);
		return $faqselect;
	}
	
	public function faqUpdate($question,$answer,$faqid){
		$question=$this->fm->validation($question);
		$answer=$this->fm->validation($answer);
		$faqid=$this->fm->validation($faqid);

		$question=mysqli_real_escape_string($this->db->link,$question);
		$answer=mysqli_real_escape_string($this->db->link,$answer);
		$faqid=mysqli_real_escape_string($this->db->link,$faqid);

		if(empty($question)){
			$msg="<span style='color:red;'>Question field must not be empty.</span>";
			return $msg;
		}
		else if(empty($answer)){
			$msg="<span style='color:red;'>Answer field must not be empty.</span>";
			return $msg;
		}else{
			$query="UPDATE faqs SET question='$question',answer='$answer' WHERE faq_id='$faqid'";
			$catupdate=$this->db->update($query);
			if($catupdate){
				$msg="<span style='color:green;'>FAQ updated successfully.</span>";
				return $msg;
			}else{
				$msg="<span style='color:red;'>FAQ update failed.</span>";
				return $msg;
			}

		}

	}
	public function getAllActiveFAQs()
	{
		$query="SELECT * FROM faqs WHERE status=1";
		$res=$this->db->select($query);
		return $res;
	}
}