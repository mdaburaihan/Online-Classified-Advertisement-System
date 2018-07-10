<?php
//include_once("C:/wamp/www/Online_Classified_Advertisement/lib/Session.php");
//Session::checkUserLogin();
include_once("C:/wamp/www/Online_Classified_Advertisement/lib/database.php");
include_once("C:/wamp/www/Online_Classified_Advertisement/Helpers/Format.php");

?>
<?php
class AdsManage {
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}
	public function postAd($data,$file){
		//$userId=Session::get("userId");
		$title=$this->fm->validation($data['title']);
		$catid=$this->fm->validation($data['catid']);
		$subcatid=$this->fm->validation($data['subcatid']);
		$descrp=$this->fm->validation($data['descrp']);
		$price=$this->fm->validation($data['price']);
		$cityid=$this->fm->validation($data['cityid']);

		$title=mysqli_real_escape_string($this->db->link,$title);
		$catid=mysqli_real_escape_string($this->db->link,$catid);
		$subcatid=mysqli_real_escape_string($this->db->link,$subcatid);
		$descrp=mysqli_real_escape_string($this->db->link,$descrp);
		$price=mysqli_real_escape_string($this->db->link,$price);
		$cityid=mysqli_real_escape_string($this->db->link,$cityid);

		$permited=array('jpg','jpeg','png');

		$pimg1=uniqid().$file['pimg1']['name'];
		$pimg2=uniqid().$file['pimg2']['name'];
		$pimg3=uniqid().$file['pimg3']['name'];

		$temp1=$file["pimg1"]["tmp_name"];
		$error1=$file["pimg1"]["error"];
		$size1=$_FILES["pimg1"]["size"];

		$temp2=$file["pimg2"]["tmp_name"];
		$error2=$file["pimg2"]["error"];
		$size2=$_FILES["pimg2"]["size"];

		$temp3=$file["pimg3"]["tmp_name"];
		$error3=$file["pimg3"]["error"];
		$size3=$_FILES["pimg3"]["size"];

		$div1=explode('.',$pimg1);
		$file_ext1=strtolower(end($div1));

		$div2=explode('.',$pimg2);
		$file_ext2=strtolower(end($div2));

		$div3=explode('.',$pimg3);
		$file_ext3=strtolower(end($div3));

		if(empty($title) || empty($catid) || empty($subcatid) || empty($descrp) || empty($price) || empty($cityid)){
			$msg="<span style='color:red;'>Fields must not be empty!</span>";
			return $msg;
		}

		if(!is_uploaded_file($temp1) || !is_uploaded_file($temp2) || !is_uploaded_file($temp3)) //file_exists($pimg1) || file_exists($pimg2) || file_exists($pimg3))|| !is_uploaded_file($temp1) || !is_uploaded_file($temp2) || !is_uploaded_file($temp3))
		{
			$msg="<span style='color:red;'>Please upload product images.</span>";
			return $msg;
		}
		/*else if($size1>1048576 || $size2>1048576 || $size3>1048576)
		{
			$msg="<span style='color:red;'>Image size must be less than 1mb.</span>";
			return $msg;
		}*/
		else if(in_array($file_ext1,$permited)===false || in_array($file_ext2,$permited)===false || in_array($file_ext3,$permited)===false)
		{
			$msg="<span style='color:red;'>You can only upload:".implode(',',$permited)."</span>";
			return $msg;
		}
		else
		{
			move_uploaded_file($temp1,"Upload/".$pimg1);
			move_uploaded_file($temp2,"Upload/".$pimg2);
			move_uploaded_file($temp3,"Upload/".$pimg3);

			$userid= Session::get("userId"); 
			$qry="SELECT * FROM selected_scheme WHERE user_id='$userid' AND status='1'";
			$res=$this->db->select($qry);
			if($res){
				$arr=$res->fetch_assoc();
				$selectedSchemeId = $arr['selected_scheme_id'];
			}

			$query="INSERT INTO ad_details(user_id,title,cat_id,subcat_id,description,pic1,pic2,pic3,city_id,price,active_status,selected_scheme_id,seller_status) VALUES ('".$userid."','".$title."','".$catid."','".$subcatid."','".$descrp."','".$pimg1."','".$pimg2."','".$pimg3."','".$cityid."','".$price."','".'1'."','".$selectedSchemeId."','".'1'."')";
			$result=$this->db->insert($query);

			if($result!=FALSE){				
				//$msg="<span style='color:green;'>1</span>";
				//return $msg;
				?>
				<script>
					alert("Your advertisement posted successfully.");
				</script>
				<?php
				//header("location:seller_dashboard.php?active_ads");
				//header("Refresh:5; url=seller_dashboard.php?active_ads");
				?>
				<script>window.location="seller_dashboard.php?active_ads";</script>
				<?php

			}else{
				$msg="<span style='color:red;'>Advertisement post failed.Please try again later.</span>";
				return $msg;
			}
		}
	}

	public function getAllActiveAds($userId){

		$userId=$this->fm->validation($userId);

		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="SELECT *
		FROM ad_details
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		WHERE active_status = '1' AND user_id='$userId'";
		$res=$this->db->select($query);
		return $res;
	}

	public function getAdById($adid){
		$query="SELECT 
		ad_details.ad_id AS ad_id,
		ad_details.title AS title,
		ad_details.description AS description,
		ad_details.pic1 AS pic1,
		ad_details.pic2 AS pic2,
		ad_details.pic3 AS pic3,
		ad_details.price AS price,
		ad_details.active_status AS active_status,
		ad_details.date AS date,
		user_registration.name AS name,
		user_registration.email AS email,
		user_registration.phone AS phone,
		category.cat_name AS cat_name,
		subcategory.subcat_name AS subcat_name,
		city.city_name AS city_name
	    FROM ad_details 
		INNER JOIN user_registration ON user_registration.user_id = ad_details.user_id
		INNER JOIN city ON city.city_id = ad_details.city_id
		INNER JOIN category ON category.cat_id = ad_details.cat_id
		INNER JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		WHERE ad_id = '$adid'";
		$res=$this->db->select($query);
		if($res!=FALSE)
			return $res;

	}

	public function UpdateAd($data,$file){
    	//$userId=Session::get("userId");
		$adid =$this->fm->validation($data['adid']);
		$title=$this->fm->validation($data['title']);
		$catid=$this->fm->validation($data['catid']);
		$subcatid=$this->fm->validation($data['subcatid']);
		$descrp=$this->fm->validation($data['descrp']);
		$price=$this->fm->validation($data['price']);
		$cityid=$this->fm->validation($data['cityid']);

		$adid=mysqli_real_escape_string($this->db->link,$adid);
		$title=mysqli_real_escape_string($this->db->link,$title);
		$catid=mysqli_real_escape_string($this->db->link,$catid);
		$subcatid=mysqli_real_escape_string($this->db->link,$subcatid);
		$descrp=mysqli_real_escape_string($this->db->link,$descrp);
		$price=mysqli_real_escape_string($this->db->link,$price);
		$cityid=mysqli_real_escape_string($this->db->link,$cityid);

		$permited=array('jpg','jpeg','png');

		$pimg1=uniqid().$file['pimg1']['name'];
		$pimg2=uniqid().$file['pimg2']['name'];
		$pimg3=uniqid().$file['pimg3']['name'];

		$temp1=$file["pimg1"]["tmp_name"];
		$error1=$file["pimg1"]["error"];
		$size1=$_FILES["pimg1"]["size"];

		$temp2=$file["pimg2"]["tmp_name"];
		$error2=$file["pimg2"]["error"];
		$size2=$_FILES["pimg2"]["size"];

		$temp3=$file["pimg3"]["tmp_name"];
		$error3=$file["pimg3"]["error"];
		$size3=$_FILES["pimg3"]["size"];

		$div1=explode('.',$pimg1);
		$file_ext1=strtolower(end($div1));

		$div2=explode('.',$pimg2);
		$file_ext2=strtolower(end($div2));

		$div3=explode('.',$pimg3);
		$file_ext3=strtolower(end($div3));

		if( empty($title) || empty($catid) || empty($subcatid) || empty($descrp) || empty($price))
		{
			$msg="<span style='color:red;'>Fields must not be empty.</span>";
			return $msg;
		}

		if(file_exists($pimg1) || file_exists($pimg2) || file_exists($pimg3) || is_uploaded_file($temp1) || is_uploaded_file($temp2) || is_uploaded_file($temp3))
		{
			/*if($size1>1048576 || $size2>1048576 || $size3>1048576)
			{
				$msg="<span style='color:red;'>Image size must be less than 1mb.</span>";
				return $msg;
			}*/
			if(in_array($file_ext1,$permited)===false || in_array($file_ext2,$permited)===false || in_array($file_ext3,$permited)===false)
			{
				$msg="<span style='color:red;'>You can only upload:".implode(',',$permited)."</span>";
				return $msg;
			}
			else
			{
				move_uploaded_file($temp1,"Upload/".$pimg1);
				move_uploaded_file($temp2,"Upload/".$pimg2);
				move_uploaded_file($temp3,"Upload/".$pimg3);

				$query="UPDATE ad_details SET title='$title',cat_id='$catid',subcat_id='$subcatid',description='$descrp',pic1='$pimg1',pic2='$pimg2',pic3='$pimg3', city_id='$cityid', price='$price' WHERE ad_id=$adid";
			//$query="UPDATE ad_details SET title='$title',cat_id='$catid',subcat_id='$subcatid',description='$descrp',city_id='$cityid', price='$price' WHERE ad_id=$adid";
				$result=$this->db->update($query);

				if($result!=FALSE){				
					$msg="<span style='color:green;'>Your Advertisement updated successfully.</span>";
					return $msg;
				}else{
					$msg="<span style='color:red;'>Advertisement updation failed.Please try again later.</span>";
					return $msg;
				}
			}
		}
		else
		{
		 	//move_uploaded_file($temp1,"Upload/".$pimg1);
			// move_uploaded_file($temp2,"Upload/".$pimg2);
			// move_uploaded_file($temp3,"Upload/".$pimg3);

		  	//$query="UPDATE ad_details SET title='$title',cat_id='$catid',subcat_id='$subcatid',description='$descrp',pic1='$pimg1',pic2='$pimg2',pic3='$pimg3', city_id='$cityid', price='$price' WHERE ad_id=$adid";
			$query="UPDATE ad_details SET title='$title',cat_id='$catid',subcat_id='$subcatid',description='$descrp',city_id='$cityid', price='$price' WHERE ad_id=$adid";
			$result=$this->db->update($query);

			if($result!=FALSE){				
				$msg="<span style='color:green;'>Your Advertisement updated successfully.</span>";
				return $msg;
			}else{
				$msg="<span style='color:red;'>Advertisement updation failed.Please try again later.</span>";
				return $msg;
			}
		}

	}




	public function deleteAdDetail($adid){
		$adid =$this->fm->validation($adid);
		$adid=mysqli_real_escape_string($this->db->link,$adid);

		$query = "DELETE FROM ad_details WHERE ad_id=$adid";
		$result=$this->db->delete($query);
		if($result!=FALSE){	
			header("location:seller_dashboard.php?manage_active_ads");
		}
	}

	public function getAdByUserId($userId){
		$userId =$this->fm->validation($userId);
		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query = "SELECT FROM ad_details WHERE ad_id=$adid";
		$result=$this->db->delete($query);
		if($result!=FALSE){	
			header("location:seller_dashboard.php?manage_active_ads");
		}
	}
	
	public function getPostedAdsBySellerId($userId){
		$userId =$this->fm->validation($userId);
		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query = "SELECT * FROM ad_details
        LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id 
		LEFT JOIN user_registration ON user_registration.user_id = ad_details.user_id   
		WHERE ad_details.user_id=$userId";
		$result=$this->db->select($query);
		if($result!=FALSE){	
			return $result;
		}
	}

	public function deactivateAd($adid){
		$adid=mysqli_real_escape_string($this->db->link,$adid);
		$query="UPDATE ad_details SET active_status = '0' WHERE ad_id = '$adid'";
		$AdUpdate=$this->db->update($query);
		if($AdUpdate){
			return $AdUpdate;
		}
	}

	public function deactivateForSold($adid){
		$adid=mysqli_real_escape_string($this->db->link,$adid);
		$query="UPDATE ad_details SET active_status = '3' WHERE ad_id = '$adid'";
		$AdUpdate=$this->db->update($query);
		if($AdUpdate){
			return $AdUpdate;
		}
	}

	public function activateAd($adid){
		$adid=mysqli_real_escape_string($this->db->link,$adid);
		$query="UPDATE ad_details SET active_status = '1' WHERE ad_id = '$adid'";
		$AdUpdate=$this->db->update($query);
		if($AdUpdate){
			return $AdUpdate;
		}
	}

	public function getAllDeactiveAds($userId){
		$userId =$this->fm->validation($userId);

		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="SELECT *
		FROM ad_details
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		WHERE active_status = '0' AND user_id='$userId'";
		$res=$this->db->select($query);
		return $res;
	}	

public function getAllAds(){
		$query="SELECT 
		ad_details.ad_id as ad_id,
		ad_details.title as title,
		ad_details.price as price,
		ad_details.description as description,
		ad_details.pic1 as pic1,
		ad_details.pic2 as pic2,
		ad_details.pic3 as pic3,
		ad_details.date as adpostdate,
		ad_details.active_status as active_status,
		category.cat_name as cat_name,
		subcategory.subcat_name as subcat_name,
		city.city_name as city_name,
		ad_details.user_id as user_id,
		user_registration.name as name,
		user_registration.email as email,
		user_registration.phone as phone,
		user_registration.block as block
		FROM ad_details
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		LEFT JOIN user_registration ON user_registration.user_id = ad_details.user_id";
		$res=$this->db->select($query);
		return $res;
	}	

	public function getAllActiveAdsNo(){
		$query="SELECT *
		FROM ad_details WHERE active_status = '1'";
		$res=$this->db->select($query);
		return $res;
	}	
	public function getAllDeactiveAdsNo(){
		$query="SELECT *
		FROM ad_details WHERE active_status = '0'";
		$res=$this->db->select($query);
		return $res;
	}
	public function getAllSoldProductsAdsNo(){
		$query="SELECT *
		FROM ad_details WHERE active_status = '3'";
		$res=$this->db->select($query);
		return $res;
	}

	public function getblockedAdsNo(){
		$query="SELECT *
		FROM ad_details WHERE active_status = '4'";
		$res=$this->db->select($query);
		return $res;
	}

	public function updateAdStatusOnDelete($adid){
		$adid =$this->fm->validation($adid);
		$adid=mysqli_real_escape_string($this->db->link,$adid);

		$query = "UPDATE ad_details SET active_status='2' WHERE ad_id=$adid";
		$result=$this->db->update($query);
		if($result){	
			//header("location:seller_dashboard.php?active_ads");
			return $result;
		}
	}

	public function fetchAllActiveAds(){
		$query="SELECT *
		FROM ad_details
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		WHERE active_status = '1' AND ad_id NOT IN(SELECT ad_id
		FROM ad_details
		WHERE active_status = '1' AND DATE(ad_details.date) BETWEEN curdate() - interval 3 day and curdate())
		ORDER BY rand()";
		$res=$this->db->select($query);
		return $res;
	}

	public function fetchAllActiveAdsOfLastThreeDays(){
		$query="SELECT *
		FROM ad_details
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		WHERE active_status = '1' AND DATE(ad_details.date) BETWEEN curdate() - interval 3 day and curdate()
		ORDER BY rand()";
		$res=$this->db->select($query);
		return $res;
	}

	public function getAdStatus($userId){

		$userId=$this->fm->validation($userId);

		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="SELECT DISTINCT
		ad_details.ad_id AS ad_id, 
		ad_details.title AS title,
		category.cat_name AS cat_name,
		subcategory.subcat_name AS subcat_name,
		ad_details.description AS description,
		ad_details.pic1 AS pic1,
		city.city_name AS city_name,
		ad_details.price AS price,
		ad_details.active_status AS active_status,
		wishlist.status AS status,
		ad_details.date AS date
		FROM ad_details
		LEFT JOIN wishlist ON wishlist.ad_id = ad_details.ad_id
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		WHERE ad_details.user_id='$userId' AND active_status IN('0','1','3','4')";
		$res=$this->db->select($query);
		return $res;
	}

	public function blockAd($adid){
		$adid =$this->fm->validation($adid);
		$adid=mysqli_real_escape_string($this->db->link,$adid);
		$query="UPDATE ad_details SET active_status = '4' WHERE ad_id=$adid";
		$AdUpdate=$this->db->update($query);
		
		if($AdUpdate){
		    ///get seller id and ad title by ad id (start)///
		     $queryGetSellerIdAdId="SELECT title,user_id FROM ad_details WHERE ad_id=$adid";
	       	 $resultGetSellerIdAdId=$this->db->select($queryGetSellerIdAdId);
	       	 
	       	  $getSellerAdDetails = $resultGetSellerIdAdId->fetch_assoc();
	       	  
	       	  $sellerId=  $getSellerAdDetails['user_id'];
	       	  $adTitle=  $getSellerAdDetails['title'];
		    ///get seller id and ad title by ad id (end)///
		    
		    ///get seller details (start)///
		     $queryGetSellerDetails="SELECT * FROM user_registration WHERE user_id=$sellerId";
	       	 $resultGetSellerDetails=$this->db->select($queryGetSellerDetails);
	       	 
	       	  $getSellerInfo = $resultGetSellerDetails->fetch_assoc();
	       	  
	       	  $sellerEmail =  $getSellerInfo['email'];
		    ///get seller details (end)///
		    
		    ///send mail to seller (start)///
		    
		         //$to="rohanraihan3@gmail.com";
	             $subject="Admin(Online Classified Advertisement System)";
				 $header = "From:Classified@gmail.com \r\n";
		         //$header .= "Cc:afgh@somedomain.com \r\n";
		         $header .= "MIME-Version: 1.0\r\n";
		         $header .= "Content-type: text/html\r\n";
		         $message="Your Ad ".$adTitle." is blocked by Admin.If this was a mistake then it will be unblocked and you can find it in deactive ads.";
		         
		         $sendmailtoseller = mail ($sellerEmail,$subject,$message,$header);
		    ///send mail to seller (end)///
		    
			return $AdUpdate;
		}
	}

	public function getAdsCatSubcatWise($data){
		$catId =$this->fm->validation($data['catid']);
		$subcatId=$this->fm->validation($data['subcatid']);

		$catId=mysqli_real_escape_string($this->db->link,$catId);
		$subcatId=mysqli_real_escape_string($this->db->link,$subcatId);

		

		if(!empty($catId) && empty($subcatId))
		{
			$query="SELECT 
			ad_details.ad_id as ad_id,
			ad_details.title as title,
			ad_details.price as price,
			ad_details.description as description,
			ad_details.pic1 as pic1,
			ad_details.pic2 as pic2,
			ad_details.pic3 as pic3,
			ad_details.date as adpostdate,
			ad_details.active_status as active_status,
			category.cat_name as cat_name,
			subcategory.subcat_name as subcat_name,
			city.city_name as city_name,
			ad_details.user_id as user_id
			FROM ad_details
			LEFT JOIN category ON category.cat_id = ad_details.cat_id
			LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
			LEFT JOIN city ON city.city_id = ad_details.city_id
			LEFT JOIN user_registration ON user_registration.user_id = ad_details.user_id
			WHERE ad_details.cat_id='$catId'";
			$res=$this->db->select($query);
			return $res;
		}

		if(empty($catId) && !empty($subcatId))
		{
			$query="SELECT 
			ad_details.ad_id as ad_id,
			ad_details.title as title,
			ad_details.price as price,
			ad_details.description as description,
			ad_details.pic1 as pic1,
			ad_details.pic2 as pic2,
			ad_details.pic3 as pic3,
			ad_details.date as adpostdate,
			ad_details.active_status as active_status,
			category.cat_name as cat_name,
			subcategory.subcat_name as subcat_name,
			city.city_name as city_name,
			ad_details.user_id as user_id
			FROM ad_details
			LEFT JOIN category ON category.cat_id = ad_details.cat_id
			LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
			LEFT JOIN city ON city.city_id = ad_details.city_id
			LEFT JOIN user_registration ON user_registration.user_id = ad_details.user_id
			WHERE ad_details.subcat_id='$subcatId'";
			$res=$this->db->select($query);
			return $res;
		}

		if(!empty($catId) && !empty($subcatId))
		{
			$query="SELECT 
			ad_details.ad_id as ad_id,
			ad_details.title as title,
			ad_details.price as price,
			ad_details.description as description,
			ad_details.pic1 as pic1,
			ad_details.pic2 as pic2,
			ad_details.pic3 as pic3,
			ad_details.date as adpostdate,
			ad_details.active_status as active_status,
			category.cat_name as cat_name,
			subcategory.subcat_name as subcat_name,
			city.city_name as city_name,
			ad_details.user_id as user_id
			FROM ad_details
			LEFT JOIN category ON category.cat_id = ad_details.cat_id
			LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
			LEFT JOIN city ON city.city_id = ad_details.city_id
			LEFT JOIN user_registration ON user_registration.user_id = ad_details.user_id
			WHERE  ad_details.cat_id='$catId' AND ad_details.subcat_id='$subcatId'";
			$res=$this->db->select($query);
			return $res;
		}
		
	}


public function getAdsCityWise($data){
		$cityId =$this->fm->validation($data['cityid']);

		$cityId=mysqli_real_escape_string($this->db->link,$cityId);

		$query="SELECT 
		ad_details.ad_id as ad_id,
		ad_details.title as title,
		ad_details.price as price,
		ad_details.description as description,
		ad_details.pic1 as pic1,
		ad_details.pic2 as pic2,
		ad_details.pic3 as pic3,
		ad_details.date as adpostdate,
		ad_details.active_status as active_status,
		category.cat_name as cat_name,
		subcategory.subcat_name as subcat_name,
		city.city_name as city_name,
		ad_details.user_id as user_id
		FROM ad_details
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		LEFT JOIN user_registration ON user_registration.user_id = ad_details.user_id
		WHERE  ad_details.city_id='$cityId'";
		$res=$this->db->select($query);
		return $res;
	}

public function getAdsStatusWise($data){
		$status =$this->fm->validation($data['status']);

		$status=mysqli_real_escape_string($this->db->link,$status);

		$query="SELECT 
		ad_details.ad_id as ad_id,
		ad_details.title as title,
		ad_details.price as price,
		ad_details.description as description,
		ad_details.pic1 as pic1,
		ad_details.pic2 as pic2,
		ad_details.pic3 as pic3,
		ad_details.date as adpostdate,
		ad_details.active_status as active_status,
		category.cat_name as cat_name,
		subcategory.subcat_name as subcat_name,
		city.city_name as city_name,
		ad_details.user_id as user_id
		FROM ad_details
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		LEFT JOIN user_registration ON user_registration.user_id = ad_details.user_id
		WHERE  ad_details.active_status='$status'";
		$res=$this->db->select($query);
		return $res;
	}
	
	public function getAdsbyFromDateToDate($data){
		$FromDate =$this->fm->validation($data['datepickerFrom']);
		$ToDate =$this->fm->validation($data['datepickerTo']);

		$FromDate=mysqli_real_escape_string($this->db->link,$FromDate);
		$ToDate=mysqli_real_escape_string($this->db->link,$ToDate);

		//$FromDate=STR_TO_DATE('$FromDate','%Y-%m-%d');
        //$ToDate=STR_TO_DATE('$ToDate','%Y-%m-%d');
		
		$query="SELECT 
		ad_details.ad_id as ad_id,
		ad_details.title as title,
		ad_details.price as price,
		ad_details.description as description,
		ad_details.pic1 as pic1,
		ad_details.pic2 as pic2,
		ad_details.pic3 as pic3,
		ad_details.date as adpostdate,
		ad_details.active_status as active_status,
		category.cat_name as cat_name,
		subcategory.subcat_name as subcat_name,
		city.city_name as city_name,
		ad_details.user_id as user_id,
		user_registration.name as name,
		user_registration.email as email,
		user_registration.phone as phone,
		user_registration.block as block
		FROM ad_details
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		LEFT JOIN user_registration ON user_registration.user_id = ad_details.user_id
		WHERE DATE(ad_details.date) BETWEEN '$FromDate' AND '$ToDate'";
		$res=$this->db->select($query);
		return $res;
	}

	public function getAdsbyFromDateToDateCity($data){
		$FromDate =$this->fm->validation($data['datepickerFrom']);
		$ToDate =$this->fm->validation($data['datepickerTo']);
		$cityId =$this->fm->validation($data['cityid']);

		$FromDate=mysqli_real_escape_string($this->db->link,$FromDate);
		$ToDate=mysqli_real_escape_string($this->db->link,$ToDate);
		$cityId=mysqli_real_escape_string($this->db->link,$cityId);

		//$FromDate=STR_TO_DATE('$FromDate','%Y-%m-%d');
        //$ToDate=STR_TO_DATE('$ToDate','%Y-%m-%d');
		
		$query="SELECT 
		ad_details.ad_id as ad_id,
		ad_details.title as title,
		ad_details.price as price,
		ad_details.description as description,
		ad_details.pic1 as pic1,
		ad_details.pic2 as pic2,
		ad_details.pic3 as pic3,
		ad_details.date as adpostdate,
		ad_details.active_status as active_status,
		category.cat_name as cat_name,
		subcategory.subcat_name as subcat_name,
		city.city_name as city_name,
		ad_details.user_id as user_id,
		user_registration.name as name,
		user_registration.email as email,
		user_registration.phone as phone,
		user_registration.block as block
		FROM ad_details
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		LEFT JOIN user_registration ON user_registration.user_id = ad_details.user_id
		WHERE ad_details.city_id ='$cityId' AND DATE(ad_details.date) BETWEEN '$FromDate' AND '$ToDate'";
		$res=$this->db->select($query);
		return $res;
	}

	public function getAdsbyFromDateToDateStatus($data){
		$FromDate =$this->fm->validation($data['datepickerFrom']);
		$ToDate =$this->fm->validation($data['datepickerTo']);
		$status =$this->fm->validation($data['status']);

		$FromDate=mysqli_real_escape_string($this->db->link,$FromDate);
		$ToDate=mysqli_real_escape_string($this->db->link,$ToDate);
		$status=mysqli_real_escape_string($this->db->link,$status);

		//$FromDate=STR_TO_DATE('$FromDate','%Y-%m-%d');
        //$ToDate=STR_TO_DATE('$ToDate','%Y-%m-%d');
		
		$query="SELECT 
		ad_details.ad_id as ad_id,
		ad_details.title as title,
		ad_details.price as price,
		ad_details.description as description,
		ad_details.pic1 as pic1,
		ad_details.pic2 as pic2,
		ad_details.pic3 as pic3,
		ad_details.date as adpostdate,
		ad_details.active_status as active_status,
		category.cat_name as cat_name,
		subcategory.subcat_name as subcat_name,
		city.city_name as city_name,
		ad_details.user_id as user_id,
		user_registration.name as name,
		user_registration.email as email,
		user_registration.phone as phone,
		user_registration.block as block
		FROM ad_details
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		LEFT JOIN user_registration ON user_registration.user_id = ad_details.user_id
		WHERE ad_details.active_status ='$status' AND DATE(ad_details.date) BETWEEN '$FromDate' AND '$ToDate'";
		$res=$this->db->select($query);
		return $res;
	}

	public function getAdsbyFromDateToDateCatSubcat($data){
		$FromDate =$this->fm->validation($data['datepickerFrom']);
		$ToDate =$this->fm->validation($data['datepickerTo']);
		$catId =$this->fm->validation($data['catid']);
		$subcatId =$this->fm->validation($data['subcatid']);

		$FromDate=mysqli_real_escape_string($this->db->link,$FromDate);
		$ToDate=mysqli_real_escape_string($this->db->link,$ToDate);
		$catId=mysqli_real_escape_string($this->db->link,$catId);
		$subcatId=mysqli_real_escape_string($this->db->link,$subcatId);

		//$FromDate=STR_TO_DATE('$FromDate','%Y-%m-%d');
        //$ToDate=STR_TO_DATE('$ToDate','%Y-%m-%d');
		if(!empty($catId) && empty($subcatId))
		{
			$query="SELECT 
			ad_details.ad_id as ad_id,
			ad_details.title as title,
			ad_details.price as price,
			ad_details.description as description,
			ad_details.pic1 as pic1,
			ad_details.pic2 as pic2,
			ad_details.pic3 as pic3,
			ad_details.date as adpostdate,
			ad_details.active_status as active_status,
			category.cat_name as cat_name,
			subcategory.subcat_name as subcat_name,
			city.city_name as city_name,
			ad_details.user_id as user_id,
			user_registration.name as name,
			user_registration.email as email,
			user_registration.phone as phone,
			user_registration.block as block
			FROM ad_details
			LEFT JOIN category ON category.cat_id = ad_details.cat_id
			LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
			LEFT JOIN city ON city.city_id = ad_details.city_id
			LEFT JOIN user_registration ON user_registration.user_id = ad_details.user_id
			WHERE ad_details.cat_id ='$catId' AND DATE(ad_details.date) BETWEEN '$FromDate' AND '$ToDate'";
			$res=$this->db->select($query);
			return $res;
		}

		if(empty($catId) && !empty($subcatId))
		{
			$query="SELECT 
			ad_details.ad_id as ad_id,
			ad_details.title as title,
			ad_details.price as price,
			ad_details.description as description,
			ad_details.pic1 as pic1,
			ad_details.pic2 as pic2,
			ad_details.pic3 as pic3,
			ad_details.date as adpostdate,
			ad_details.active_status as active_status,
			category.cat_name as cat_name,
			subcategory.subcat_name as subcat_name,
			city.city_name as city_name,
			ad_details.user_id as user_id,
			user_registration.name as name,
			user_registration.email as email,
			user_registration.phone as phone,
			user_registration.block as block
			FROM ad_details
			LEFT JOIN category ON category.cat_id = ad_details.cat_id
			LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
			LEFT JOIN city ON city.city_id = ad_details.city_id
			LEFT JOIN user_registration ON user_registration.user_id = ad_details.user_id
			WHERE ad_details.subcat_id='$subcatId' AND DATE(ad_details.date) BETWEEN '$FromDate' AND '$ToDate'";
			$res=$this->db->select($query);
			return $res;
		}

		if(!empty($catId) && !empty($subcatId))
		{
			$query="SELECT 
			ad_details.ad_id as ad_id,
			ad_details.title as title,
			ad_details.price as price,
			ad_details.description as description,
			ad_details.pic1 as pic1,
			ad_details.pic2 as pic2,
			ad_details.pic3 as pic3,
			ad_details.date as adpostdate,
			ad_details.active_status as active_status,
			category.cat_name as cat_name,
			subcategory.subcat_name as subcat_name,
			city.city_name as city_name,
			ad_details.user_id as user_id,
			user_registration.name as name,
			user_registration.email as email,
			user_registration.phone as phone,
			user_registration.block as block
			FROM ad_details
			LEFT JOIN category ON category.cat_id = ad_details.cat_id
			LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
			LEFT JOIN city ON city.city_id = ad_details.city_id
			LEFT JOIN user_registration ON user_registration.user_id = ad_details.user_id
			WHERE  ad_details.cat_id='$catId' AND ad_details.subcat_id='$subcatId' AND DATE(ad_details.date) BETWEEN '$FromDate' AND '$ToDate'";
			$res=$this->db->select($query);
			return $res;
		}
		
	}

	public function getAdsSubcategoryWise($subcatId){
		$subcatId =$this->fm->validation($subcatId);

		$subcatId=mysqli_real_escape_string($this->db->link,$subcatId);

		$query="SELECT 
		ad_details.ad_id as ad_id,
		ad_details.title as title,
		ad_details.price as price,
		ad_details.description as description,
		ad_details.pic1 as pic1,
		ad_details.pic2 as pic2,
		ad_details.pic3 as pic3,
		ad_details.date as adpostdate,
		ad_details.active_status as active_status,
		category.cat_name as cat_name,
		subcategory.subcat_name as subcat_name,
		city.city_name as city_name
		FROM ad_details
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		WHERE  ad_details.subcat_id='$subcatId' AND ad_details.active_status='1'";
		$res=$this->db->select($query);
		return $res;
	}

	public function getActiveAdvertisements(){
		$query="SELECT *
		FROM ad_details
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		WHERE ad_details.active_status='1'";
		$res=$this->db->select($query);
		return $res;
	}	

	public function getAdsCategoryWise($catId){
		$catId =$this->fm->validation($catId);

		$catId=mysqli_real_escape_string($this->db->link,$catId);

		$query="SELECT 
		ad_details.ad_id as ad_id,
		ad_details.title as title,
		ad_details.price as price,
		ad_details.description as description,
		ad_details.pic1 as pic1,
		ad_details.pic2 as pic2,
		ad_details.pic3 as pic3,
		ad_details.date as adpostdate,
		ad_details.active_status as active_status,
		category.cat_name as cat_name,
		subcategory.subcat_name as subcat_name,
		city.city_name as city_name
		FROM ad_details
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		WHERE  ad_details.cat_id='$catId' AND ad_details.active_status='1'";
		$res=$this->db->select($query);
		return $res;
	}


}

