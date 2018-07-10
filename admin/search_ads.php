<?php include("inc/header.php"); ?>
<?php include("../Classes/AdsManage.php"); ?>

<script>
  $(document).ready(function(){
    $('#blockBtn').click(function(){
      var adid= document.getElementById("hidden_adid").value;
      alert(adid);
      $.ajax({
        type: "GET",
        url: "ad_block.php",
        data: {adid:adid,action:'block'},
        cache: false,
        success: function(data) {

         var result = $.trim(data);
         if(result=="trueBlock")
         {
         $('#blockstatusdisplay').html("Advertisement is blocked successfully.");
          $("#myModalBlock").modal('show');
        }
        
        if(result=="falseBlock")
        {
          window.location="404.php";
        }
       

      },
      error: function(err) {
        alert(err);
      }
    });
    });



  });
</script>






<div class="well">
	<h4>Search Advertisments</h4>
	<form name="search_ads" class="search" align="center">    
		<select name="searchfor" id="srch">
			<option value="Anything">Anything</option>
			<option value="Category">Category</option>
			<option value="Subcategory">Subcategory</option>
			<option value="City">City</option>
		</select>
		<input type="text" name="search" id="searchAds" placeholder="Enter search details here..." value="<?php if(isset($_GET['search'])) { echo htmlentities ($_GET['search']); }?>" style="border-radius: 2px 0px 0px 2px">
		<input type="submit" name="submit" value="GO" style="border-radius: 0px 2px 2px 0px">
	</form>
	<div  class="alert alert-info" id="searchstatus" style="width:405px;margin-left:572px;display:none;background-color: white;border:1px solid #ccc;"></div>      
	<script type="text/javascript">
  document.getElementById('srch').value = "<?php echo $_GET['searchfor'];?>";
</script>
</div>
<div class="container-fluid">
<div class="panel panel-primary">
    <div class="panel-heading" style="text-align: center;font-size: 16px;">Advertisements Submitted by Sellers</div>
    <div class="panel-body">
<?php
if(isset($_GET['submit']))	
{	
	if(empty($_GET['search']))
	{
				//echo "<h1>"."Search data not submitted!!"."</h1>";
		?>
		<div class="alert alert-danger" style="font-size:18px;text-align: center;">
			Search data not submitted!!
		</div>
		<?php
	}
	else
	{
		$ads = new AdsManage();
		$allAds =$ads -> getAllAds();
		?>
		<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Sl.</th>
					<th>AD ID</th>
					<th>Date</th>
					<th>Title</th>
					<th>Category</th>
					<th>Subcategory</th>
					<th>Description</th>
					<th>Image1</th>
					<th>Image2</th>
					<th>Image3</th>
					<th>City</th>
					<th>Price</th>
					<th>Status</th>
					<th>Action</th>

				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Sl.</th>
					<th>AD ID</th>
					<th>Date</th>
					<th>Title</th>
					<th>Category</th>
					<th>Subcategory</th>
					<th>Description</th>
					<th>Image1</th>
					<th>Image2</th>
					<th>Image3</th>
					<th>City</th>
					<th>Price</th>
					<th>Status</th>
					<th>Action</th>

				</tr>
			</tfoot>
			<tbody>
				<?php
				$sl=1;
				if($allAds)
				{
					while ($arr=$allAds->fetch_assoc())
					{
						?>
						
						<?php
						if($_GET['searchfor']=='Category')
						{
							if(stristr($arr['cat_name'],$_GET['search']))
							{
								?>
								<tr>
									<td>
									<?php echo $sl; ?>
								</td>
								<td>
									<?php echo $arr['ad_id']; ?>
									 <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arr['ad_id']; ?>">
									</td>
									<td><?php echo $arr['adpostdate'] ?></td>
									<td><?php echo $arr['title'] ?></td>
									<td><?php echo $arr['cat_name'] ?></td>
									<td><?php echo $arr['subcat_name'] ?></td>
									<td><?php echo $arr['description'] ?></td>
									<td><img src="<?php echo '../Upload' . '/' . $arr['pic1']; ?>" height="100" width="100"/></td>
									<td><img src="<?php echo '../Upload' . '/' . $arr['pic2']; ?>" height="100" width="100"/></td>
									<td><img src="<?php echo '../Upload' . '/' . $arr['pic3']; ?>" height="100" width="100"/></td>
									<td><?php echo $arr['city_name'] ?></td>
									<td><?php echo "₹".$arr['price'] ?></td>
									<td>
										<?php 
										if($arr['active_status'] == 0){
											?>
											<img src="img/inactive.png" height="40px" width="40px">
											<?php
										}else if($arr['active_status'] == 1){
											?>
										    <img src="img/active.png" height="40px" width="40px">
											<?php
										}else if($arr['active_status'] == 2){
											?>
											<img src="img/deleted.jpg" height="40px" width="40px">
											<?php
										  }else if($arr['active_status'] == 3){
   											?>
											<img src="img/soldout.png" height="40px" width="40px">
											<?php
                                        }else if($arr['active_status'] == 4){
                                        	?>
											<img src="img/blocked.png" height="40px" width="40px">
											<?php
										}else{
											echo"Not Found.";
										}
										?>
									</td>
									<td>

									<?php
									if($arr['active_status'] == 0 || $arr['active_status'] == 1)
									{
								    ?>
									<button type="button" class="btn btn-danger btn-xs" id="blockBtn">Block</button>
									<?php
							     	}
							     	else if($arr['active_status'] == 2 || $arr['active_status'] == 3)
							     	{
							     		echo"None";
							     	}
							     	else
							     	{
							     		?>
							        <button type="button" class="btn btn-success btn-xs" id="unblockBtn">Activate</button>
							     		<?php
							     	}
									?>
									<!-- <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arr['ad_id']; ?>"> -->
									</td>
								</tr> 
								<?php 
								$sl++;
							}
						} 
						if($_GET['searchfor']=='Subcategory')
						{
							if(stristr($arr['subcat_name'],$_GET['search']))
							{
								?>
								<tr>
									<td>
									<?php echo $sl; ?>
								</td>
								<td>
								    <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arr['ad_id']; ?>">

									</td>
									<td><?php echo $arr['adpostdate'] ?></td>
									<td><?php echo $arr['title'] ?></td>
									<td><?php echo $arr['cat_name'] ?></td>
									<td><?php echo $arr['subcat_name'] ?></td>
									<td><?php echo $arr['description'] ?></td>
									<td><img src="<?php echo '../Upload' . '/' . $arr['pic1']; ?>" height="100" width="100"/></td>
									<td><img src="<?php echo '../Upload' . '/' . $arr['pic2']; ?>" height="100" width="100"/></td>
									<td><img src="<?php echo '../Upload' . '/' . $arr['pic3']; ?>" height="100" width="100"/></td>
									<td><?php echo $arr['city_name'] ?></td>
									<td><?php echo "₹".$arr['price'] ?></td>
									<td>
										<?php 
										if($arr['active_status'] == 0){
											?>
											<img src="img/inactive.png" height="40px" width="40px">
											<?php
										}else if($arr['active_status'] == 1){
											?>
										    <img src="img/active.png" height="40px" width="40px">
											<?php
										}else if($arr['active_status'] == 2){
											?>
											<img src="img/deleted.jpg" height="40px" width="40px">
											<?php
										  }else if($arr['active_status'] == 3){
   											?>
											<img src="img/soldout.png" height="40px" width="40px">
											<?php
                                        }else if($arr['active_status'] == 4){
                                        	?>
											<img src="img/blocked.png" height="40px" width="40px">
											<?php
										}else{
											echo"Not Found.";
										}
										?>
									</td>
									<td>

									<?php
									if($arr['active_status'] == 0 || $arr['active_status'] == 1)
									{
								    ?>
									<button type="button" class="btn btn-danger btn-xs" id="blockBtn">Block</button>
									<?php
							     	}
							     	else if($arr['active_status'] == 2 || $arr['active_status'] == 3)
							     	{
							     		echo"None";
							     	}
							     	else
							     	{
							     		?>
							        <button type="button" class="btn btn-success btn-xs" id="unblockBtn">Activate</button>
							     		<?php
							     	}
									?>
									<!-- <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arr['ad_id']; ?>"> -->
									</td>
								</tr> 
								<?php 
								$sl++;
							}
						} 
						if($_GET['searchfor']=='City')
						{
							if(stristr($arr['city_name'],$_GET['search']))
							{
								?>
								<tr>
									<td>
									<?php echo $sl; ?>
								    </td>
								    <td>
								    <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arr['ad_id']; ?>">
									</td>
									<td><?php echo $arr['adpostdate'] ?></td>
									<td><?php echo $arr['title'] ?></td>
									<td><?php echo $arr['cat_name'] ?></td>
									<td><?php echo $arr['subcat_name'] ?></td>
									<td><?php echo $arr['description'] ?></td>
									<td><img src="<?php echo '../Upload' . '/' . $arr['pic1']; ?>" height="100" width="100"/></td>
									<td><img src="<?php echo '../Upload' . '/' . $arr['pic2']; ?>" height="100" width="100"/></td>
									<td><img src="<?php echo '../Upload' . '/' . $arr['pic3']; ?>" height="100" width="100"/></td>
									<td><?php echo $arr['city_name'] ?></td>
									<td><?php echo "₹".$arr['price'] ?></td>
									<td>
										<?php 
										if($arr['active_status'] == 0){
											?>
											<img src="img/inactive.png" height="40px" width="40px">
											<?php
										}else if($arr['active_status'] == 1){
											?>
										    <img src="img/active.png" height="40px" width="40px">
											<?php
										}else if($arr['active_status'] == 2){
											?>
											<img src="img/deleted.jpg" height="40px" width="40px">
											<?php
										  }else if($arr['active_status'] == 3){
   											?>
											<img src="img/soldout.png" height="40px" width="40px">
											<?php
                                        }else if($arr['active_status'] == 4){
                                        	?>
											<img src="img/blocked.png" height="40px" width="40px">
											<?php
										}else{
											echo"Not Found.";
										}
										?>
									</td>
									<td>
									<?php
									if($arr['active_status'] == 0 || $arr['active_status'] == 1)
									{
								    ?>
									<button type="button" class="btn btn-danger btn-xs" id="blockBtn">Block</button>
									<?php
							     	}
							     	else if($arr['active_status'] == 2 || $arr['active_status'] == 3)
							     	{
							     		echo"None";
							     	}
							     	else
							     	{
							     		?>
							        <button type="button" class="btn btn-success btn-xs" id="unblockBtn">Activate</button>
							     		<?php
							     	}
									?>
									<!-- <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arr['ad_id']; ?>"> -->
									</td>
								</tr> 
								<?php 
								$sl++;
							}
						} 
						if($_GET['searchfor']=='Anything')
						{
							if(stristr($arr['cat_name'],$_GET['search']) || stristr($arr['subcat_name'],$_GET['search']) || stristr($arr['description'],$_GET['search']) || stristr($arr['title'],$_GET['search']) || stristr($arr['city_name'],$_GET['search']))
							{
								?>
								<tr>
									<td>
									<?php echo $sl; ?>
								</td>
								<td>
									<?php echo $arr['ad_id']; ?>
								    <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arr['ad_id']; ?>">
									</td>
									<td><?php echo $arr['adpostdate'] ?></td>
									<td><?php echo $arr['title'] ?></td>
									<td><?php echo $arr['cat_name'] ?></td>
									<td><?php echo $arr['subcat_name'] ?></td>
									<td><?php echo $arr['description'] ?></td>
									<td><img src="<?php echo '../Upload' . '/' . $arr['pic1']; ?>" height="100" width="100"/></td>
									<td><img src="<?php echo '../Upload' . '/' . $arr['pic2']; ?>" height="100" width="100"/></td>
									<td><img src="<?php echo '../Upload' . '/' . $arr['pic3']; ?>" height="100" width="100"/></td>
									<td><?php echo $arr['city_name'] ?></td>
									<td><?php echo "₹".$arr['price'] ?></td>
									<td>
										<?php 
										if($arr['active_status'] == 0){
											?>
											<img src="img/inactive.png" height="40px" width="40px">
											<?php
										}else if($arr['active_status'] == 1){
											?>
										    <img src="img/active.png" height="40px" width="40px">
											<?php
										}else if($arr['active_status'] == 2){
											?>
											<img src="img/deleted.jpg" height="40px" width="40px">
											<?php
										  }else if($arr['active_status'] == 3){
   											?>
											<img src="img/soldout.png" height="40px" width="40px">
											<?php
                                        }else if($arr['active_status'] == 4){
                                        	?>
											<img src="img/blocked.png" height="40px" width="40px">
											<?php
										}else{
											echo"Not Found.";
										}
										?>
									</td>
									<td>
	
									<?php
									if($arr['active_status'] == 0 || $arr['active_status'] == 1)
									{
								    ?>
									<button type="button" class="btn btn-danger btn-xs" id="blockBtn">Block</button>
									<?php
							     	}
							     	else if($arr['active_status'] == 2 || $arr['active_status'] == 3)
							     	{
							     		echo"None";
							     	}
							     	else
							     	{
							     		?>
							        <button type="button" class="btn btn-success btn-xs" id="unblockBtn">Activate</button>
							     		<?php
							     	}
									?>
									
									</td>
								</tr> 
								<?php 
								$sl++;
							}
						} 
					}
						
					?>        
				</tbody>
			</table>
			<?php
		}
					  
	}
}

?>


<!--Modal For answer of deactivation-->
<div class="modal fade" id="myModalBlock" role="dialog" style="margin-top: 200px;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #5088d7;color: white;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <i class='fa fa-check-circle' style='color: yellow;position:static'></i><strong> Message.</strong>
        </h4>
      </div>
      <div class="modal-body" id="blockstatusdisplay" style="font-size: 16px;">         

      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
     </div>
   </div>
 </div>
</div>
<!--Modal For answer of deactivation-->

<!-- refresh page on modal close-->
<script>
  $('#myModalBlock').on('hidden.bs.modal', function () {
   location.reload();
 })
</script>
<!-- refresh page on modal close-->



</div>
</div>
</div>



<div class="panel panel-default">
<div class="panel-body"><button type="button" class="btn btn-primary" onclick="location.href = 'admin_panel.php';"><< Go Back</button></div>
</div>
<script>
 $(document).ready(function() {
 	$('#example').DataTable();
} );
</script>
<?php include("inc/footer.php"); ?>

