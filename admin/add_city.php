
<?php include 'Classes/City.php';?>
<?php
$ct=new City();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['addcity'])){
       $cityName=$_POST['cityname'];
       $adminid = Session::get("userId");

       $insertCity=$ct->cityInsert($cityName,$adminid);
}
?>
<div class="container">
<div class="col-lg-2">
</div>
<div class="panel panel-primary">
  <div class="panel-heading" style="text-align: center;font-size: 16px;">Add New City</div>
  <div class="panel-body">
  <div class="col-lg-8">
  <section style="margin-left:400px;font-size: 18px;">
	   <?php
		if(isset($insertCity)){
			echo "$insertCity";
		}
		?>
</section>
<form name="addcity" method="post" class="afrm">
    <table cellpadding="10" cellspacing="10" align="center">
       <tr>
         <td class="atxt" style="padding-left: 80px;">New City :</td>
         <td><input type="text" name="cityname" placeholder="Enter city name here..." value="<?php if(isset($_POST['cityname'])) { echo htmlentities ($_POST['cityname']); }?>"></td>
       </tr>
     </table>
     <input type="submit" name="addcity" value="ADD">
   </form>
</div>
 </div>
</div>
 <div class="col-lg-2">
</div>
</div>
