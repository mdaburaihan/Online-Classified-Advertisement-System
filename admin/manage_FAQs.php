<?php include("inc/header.php"); ?>
 <div class="well">
  <h4>Manage FAQs Section</h4>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_FAQs.php?add_FAQs';">Add New FAQ</button>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_FAQs.php?FAQ_list';">All FAQs</button>

</div>
<div style="height:auto;">
	<?php 
	if(isset($_GET['add_FAQs']))
	{
		include("add_FAQs.php");
	}
	
	else if(isset($_GET['FAQ_list']))
	{
		
		include("FAQ_list.php");
	}
	else
	{
		include("FAQ_list.php");
	}
	?>
</div>
<div class="panel panel-default">
	<div class="panel-body"><button type="button" class="btn btn-primary" onclick="location.href = 'admin_panel.php';"><< Go Back</button></div>
</div>
<?php include("inc/footer.php"); ?>

