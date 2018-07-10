<?php
//include_once("C:/wamp/www/Online_Classified_Advertisement/lib/Session.php");
//Session::checkUserLogin();
include_once("C:/wamp/www/Online_Classified_Advertisement/lib/database.php");
include_once("C:/wamp/www/Online_Classified_Advertisement/Helpers/Format.php");
?>
<?php
class Buyer {
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function addProductToWishlist($data,$buyerId){
		$adid=$this->fm->validation($data['adid']);
		$buyerId=$this->fm->validation($buyerId);

		$adid=mysqli_real_escape_string($this->db->link,$adid);
		$buyerId=mysqli_real_escape_string($this->db->link,$buyerId);


		// if(checkDuplicateInWishlist($adid,$buyerId)) //check if the product is already added to wishlist
		// {
		// 	return false;
		// }
		// else
		// {

			$query="INSERT INTO wishlist(user_id,ad_id,status) VALUES ('".$buyerId."','".$adid."',1)";
			$result=$this->db->insert($query);
			if($result!=FALSE){
				return true;
			}else{
				return false;
			}
		//}
	}

	public function checkDuplicateInWishlist($data,$buyerId){
		$adid=$this->fm->validation($data['adid']);
		$buyerId=$this->fm->validation($buyerId);

		$adid=mysqli_real_escape_string($this->db->link,$adid);
		$buyerId=mysqli_real_escape_string($this->db->link,$buyerId);
		
		$query="SELECT * FROM wishlist WHERE ad_id='$adid' AND user_id='$buyerId' AND status IN('1','2')";
		$result=$this->db->select($query);
		if($result!=FALSE){
			return true;
		}else{
			return false;
		}
	}

	public function getAllWishlistedAdsByUserId($userId){

		$userId=$this->fm->validation($userId);

		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="SELECT *
		FROM wishlist
		LEFT JOIN ad_details ON ad_details.ad_id = wishlist.ad_id
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
        LEFT JOIN user_registration ON user_registration.user_id = wishlist.user_id
		WHERE wishlist.user_id='$userId' AND wishlist.status='1'";
		$res=$this->db->select($query);
		return $res;
	}

	public function removeFromWishlist($adId,$userId){

		$adId=$this->fm->validation($adId);
		$userId=$this->fm->validation($userId);

		$adId=mysqli_real_escape_string($this->db->link,$adId);
		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="UPDATE wishlist SET status='0' WHERE ad_id='$adId' AND user_id='$userId'";
		$res=$this->db->update($query);
		if($res!=FALSE){	
			//header("location:buyer_dashboard.php?wishlist");
			?>
			<script>window.location="buyer_dashboard.php?wishlist";</script>
			<?php
		}
	}

	public function markedAsConfirmed($adId,$userId){

		$adId=$this->fm->validation($adId);
		$userId=$this->fm->validation($userId);

		$adId=mysqli_real_escape_string($this->db->link,$adId);
		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="UPDATE wishlist SET status='2' WHERE ad_id='$adId' AND user_id='$userId' AND status != '0'";
		$res=$this->db->update($query);
		if($res!=FALSE){	
			//header("location:buyer_dashboard.php?wishlist");
		    	 /////getting the details of buyer (start)////////
                 $qry1="SELECT * FROM user_registration WHERE user_id='$userId'";
		         $res1=$this->db->select($qry1);
		         $buyerres=$res1->fetch_assoc();

		         $buyerName=$buyerres['name'];
		         $buyerEmail=$buyerres['email'];
		         $buyerPhone=$buyerres['phone'];
                /////getting the details of buyer (end)////////

		        /////getting the seller id and ad title from ad_details by ad_id (start)////
                 $qry2="SELECT title,user_id FROM ad_details WHERE ad_id='$adId'";
		         $res2=$this->db->select($qry2);      
             	 $getAddetails=$res2->fetch_assoc();

             	 $sellerid =  $getAddetails['user_id'];
             	 $ad_title =  $getAddetails['title'];
             	 /////getting the seller id and ad title from ad_details by ad_id (end)////

                 /////getting the seller details (start)//// 
                  $qry3="SELECT * FROM user_registration WHERE user_id='$sellerid'";
		          $res3=$this->db->select($qry3);

		          $sellerdetails = $res3->fetch_assoc();

		          $sellerEmail=$sellerdetails['email'];
                  /////getting the seller details (end)//// 
		    
				 //$to="rohanraihan3@gmail.com";
	             $subject="Message from Online Classified Advertisement System";
				 $header = "From:Classified@gmail.com \r\n";
		         //$header .= "Cc:afgh@somedomain.com \r\n";
		         $header .= "MIME-Version: 1.0\r\n";
		         $header .= "Content-type: text/html\r\n";
		         $message="Congratulations! ".$buyerName." has confirmed your Ad, ". $ad_title." Please Contact him/her by email ".$buyerEmail." or phone no".$buyerPhone." Thank you.";
		         
		         $sendmailtoseller = mail ($sellerEmail,$subject,$message,$header);
			
			
			return true;
		}
	}

public function getAllConfirmedAdsByUserId($userId){

		$userId=$this->fm->validation($userId);

		$userId=mysqli_real_escape_string($this->db->link,$userId);

		$query="SELECT *
		FROM wishlist
		LEFT JOIN ad_details ON ad_details.ad_id = wishlist.ad_id
		LEFT JOIN category ON category.cat_id = ad_details.cat_id
		LEFT JOIN subcategory ON subcategory.subcat_id = ad_details.subcat_id
		LEFT JOIN city ON city.city_id = ad_details.city_id
		LEFT JOIN user_registration ON user_registration.user_id = wishlist.user_id
		WHERE wishlist.user_id='$userId' AND wishlist.status='2'";
		$res=$this->db->select($query);
		return $res;
	}

	public function countConfirmedNo($adId){

		$adId=$this->fm->validation($adId);

		$adId=mysqli_real_escape_string($this->db->link,$adId);

		$query="SELECT *
		FROM wishlist
		WHERE ad_id='$adId' AND status='2'";
		$res=$this->db->select($query);
		return $res;
	}

	public function countWishlistedNo($adId){

		$adId=$this->fm->validation($adId);

		$adId=mysqli_real_escape_string($this->db->link,$adId);

		$query="SELECT *
		FROM wishlist
		WHERE ad_id='$adId' AND status='1'";
		$res=$this->db->select($query);
		return $res;
	}

	public function checkDuplicateConfirm($data,$buyerId){
		$adid=$this->fm->validation($data['ad_id']);
		$buyerId=$this->fm->validation($buyerId);

		$adid=mysqli_real_escape_string($this->db->link,$adid);
		$buyerId=mysqli_real_escape_string($this->db->link,$buyerId);
		
		$query="SELECT * FROM wishlist WHERE ad_id='$adid' AND user_id='$buyerId' AND status='2'";
		$result=$this->db->select($query);
		if($result!=FALSE){
			return true;
		}else{
			return false;
		}
	}
}