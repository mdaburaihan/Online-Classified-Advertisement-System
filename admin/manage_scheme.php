<?php include("inc/header.php"); ?>
<div class="well">
	<h4>Manage Schemes</h4>
	<button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_scheme.php?add_scheme';">Add New Scheme</button>
	<button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_scheme.php?scheme_list';">All Scheme List</button>

	  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalHelp" style="margin-left: 1050px;">
	  	<img src="img/help.png"/>
	  </button>
	  <a href="#">Need Help?</a>
</div>
<div style="height:auto;">
	<?php 
	if(isset($_GET['add_scheme']))
	{

		include("add_scheme.php");
    }
	else if(isset($_GET['scheme_list']))
	{

		include("scheme_list.php");
	}
	else
	{
		include("scheme_list.php");
	}
	?>
</div>
<div class="panel panel-default">
	<div class="panel-body"><button type="button" class="btn btn-primary" onclick="location.href = 'admin_panel.php';"><< Go Back</button></div>
</div>
<?php include("inc/footer.php"); ?>


<!-- Modal -->
  <div class="modal fade" id="myModalHelp" role="dialog" style="margin-top: 100px;margin-left: 800px;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#2299ca;color:white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-question-circle" style="font-size:20px;position:static"></i> Status icon signification</h4>
        </div>
        <div class="modal-body" style="font-size: 16px">
        <p><img src="img/active.png" height="30px" width="30px"/> Signify Active Schemes. </p>
        <p><img src="img/inactive.png" height="30px" width="30px"/> Signify Inactive Schemes. </p>
        </div>
        <div class="modal-footer" style="padding: 6px;">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>