<?php include("inc/header.php"); ?>

 <div class="well">
  <h4>Manage City</h4>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_city.php?add_city';">Add New City</button>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_city.php?city_list';">All City List</button>
</div>
<div>
	<?php 
	if(isset($_GET['add_city']))
	{
		?>
		<div>
			<?php
			include("add_city.php");
		}
		?>
	</div>
	<?php 
	if(isset($_GET['city_list']))
	{
		?>
		<div>
			<?php
			include("city_list.php");
		}
		?>
	</div>
	<?php include 'Classes/City.php';?>
<?php
$ct=new City();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updatecity'])){
       $cityName=$_POST['cityname'];
       $cityId=$_POST['cityid'];
       $adminid = Session::get("userId");

       $updateCity=$ct->cityUpdate($cityName,$cityId,$adminid);
}
?>
 <div class="container">
<div class="col-lg-2">
</div>
<div class="panel panel-primary">
  <div class="panel-heading" style="text-align: center;font-size: 16px;">Edit City</div>
  <div class="panel-body">
  <div class="col-lg-8">
  <section style="margin-left:400px;font-size: 18px;">
	   <?php
		if(isset($updateCity)){
			echo "$updateCity";
		}
		?>
</section>
<form name="editcity" method="post" class="afrm">
<?php
  $cityid = $_GET['city_id'];
  $SelectedCity = $ct -> getCityById($cityid);
  if($SelectedCity){
    $arr=$SelectedCity->fetch_assoc();
    ?>
    <table cellpadding="10" cellspacing="10" align="center">
    <input type="hidden" name="cityid" value="<?php echo $arr['city_id'] ?>">
       <tr>
         <td class="atxt" style="padding-left: 80px;">New City :</td>
         <td><input type="text" name="cityname" value="<?php echo $arr['city_name'] ?>"></td>
       </tr>
     </table>
     <?php
 }
     ?>
     <input type="submit" name="updatecity" value="Update">
   </form>
</div>
 </div>
</div>
 <div class="col-lg-2">
</div>
</div>


<div class="panel panel-default">
  <div class="panel-body"><button type="button" class="btn btn-primary" onclick="location.href = 'admin_panel.php';"><< Go Back</button></div>
</div>
<?php include("inc/footer.php"); ?>
