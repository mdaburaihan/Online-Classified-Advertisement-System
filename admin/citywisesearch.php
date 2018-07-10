<?php include("inc/header.php"); ?>
<?php 
include("../Classes/AdsManage.php"); 
$ads = new AdsManage();
?>

<script>
  /* Formatting function for row details - modify as you need */
  function formatt ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
    '<tr>'+
    '<td>DATE:</td>'+
    '<td>'+d.adpostdate+'</td>'+
    '</tr>'+
    '<tr>'+
    '<td>Extra info:</td>'+
    '<td>And any further details here (images etc)...</td>'+
    '</tr>'+
    '</table>';
  }

  $(document).ready(function() {
    var dt = $('#tblCityWiseSearch').DataTable( {
      "ajax": {
        "url":"citydata.php",
        "dataSrc":""
      },
      "columns": [ 
      {
        "class":          "details-control",
        "orderable":      false,
        "data":           null,
        "defaultContent": ""
      },
      { "data": "title" },
      { "data": "price" },
      { "data": "description" },
       [ {
        "data": "active_status",
       "render": function ( data, type, row, meta ) {
        if(data==0)
        {
           
        }
        return '<a href="'+data+'">Download</a>';
        }
      } ],
      { "data" : "pic1", render: getImg},
     
      ]
    } );

    // Array to track the ids of the details displayed rows
    var detailRows = [];

    $('#tblCityWiseSearch tbody').on( 'click', 'tr td:first-child', function () {
      var tr = $(this).parents('tr');
      var row = dt.row( tr );
      var idx = $.inArray( tr.attr('id'), detailRows );

      if ( row.child.isShown() ) {
        tr.removeClass( 'details' );
        row.child.hide();

            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
          }
          else {
            tr.addClass( 'details' );
            row.child( formatt( row.data() ) ).show();

            // Add to the 'open' array
            if ( idx === -1 ) {
              detailRows.push( tr.attr('id') );
            }
          }
        } );
    
    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
      $.each( detailRows, function ( i, id ) {
        $('#'+id+' td:first-child').trigger( 'click' );
      } );
    } );
  });

  function getImg(data, type, full, meta) {
    var orderType = data.OrderType;
    return '<img src="../Upload/'+data+'" border="0" widht="25" height="25" />';
  }
</script>

<style>
td.details-control {
  background: url('img/plus.png') no-repeat center center;
  cursor: pointer;
}
tr.shown td.details-control {
  background: url('img/minus.png') no-repeat center center;
  cursor: pointer;
}
</style>


<?php 
include("Classes/City.php"); 
?>
<?php
if(isset($_GET['action']) && $_GET['action']=="block")
{
  $adid = $_GET['adid'];


  $res = $ads -> blockAd($adid);
  if($res)
  {
    ?>
    <script>
      $(document).ready(function(){
       $('#blockstatusdisplay').html("Advertisement is blocked successfully.");
       $("#myModalBlock").modal('show');

     });
   </script>
   <?php
 }
 else
 {
  header("location:404.php");
}

}





if(isset($_GET['action']) && $_GET['action']=="unblock")
{
  $adid = $_GET['adid'];


  $res = $ads -> deactivateAd($adid);
  if($res)
  {
    ?>
    <script>
      $(document).ready(function(){
       $('#blockstatusdisplay').html("Advertisement is unblocked successfully.");
       $("#myModalBlock").modal('show');

     });
   </script>
   <?php
 }
 else
 {
  header("location:404.php");
}

}
?>


<div class="well" style="height: 130px;">
	<h4>Search Advertisments City Wise</h4>
 <form name="search_ads" method="post" style="">  
   <div class="col-lg-8" style="margin-top: 20px;">
    <div class="col-lg-2" style="font-size: 16px;text-align: right;">
     <label>City :</label>
   </div>
   <div class="col-lg-4">
    <select class="cat_select form-control" name="cityid" id="setcityid">
     <option value="">---Select---</option>
     <?php
     $ct = new City();
     $allCities =$ct -> getAllCity();

     if($allCities){
      while ($cityarr=$allCities->fetch_assoc()){
        ?>
        <option value="<?php echo $cityarr['city_id'] ?>"><?php echo $cityarr['city_name'] ?></option>
        <?php
      }
    }
    ?>
  </select>
</div>
<div class="col-lg-2" style="font-size: 16px;">
 <button type="submit" name="search" class="btn btn-primary">Search</button>
</div>

<div class="col-lg-4">

</div>
</div>
</form>
<div class="col-lg-4" style="text-align: right;margin-top: 20px;">
 <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalHelp">
  <img src="img/help.png"/>
</button>
<a href="#">Need Help?</a>
</div>
</div>

<script type="text/javascript">
  document.getElementById('setcityid').value = "<?php echo $_POST['cityid'];?>";
</script>

<div id="overlay" align="center" style="padding-top: 100px;padding-left: 100px;">
 <img src="img/Loading_icon.gif" alt="Loading" />
</div>
<!-- <div id="test" style="display: none;">
  <div class="alert alert-danger" style="font-size:18px;text-align: center;">
    No Advertisements Available.
  </div>
</div> -->
<div id="main-content">
  <div class="container-fluid">
    <div class="panel panel-primary">
      <div class="panel-heading" style="text-align: center;font-size: 16px;">Advertisements Submitted by Sellers</div>
      <div class="panel-body">
        <?php
        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['search'])){

         $cityid=$_POST['cityid'];


         if($cityid=="")
         {
          echo "<script>alert('Please Select City.');</script>";
          ?>
          <script>
            window.location="search_city_wise.php";
          </script>
          <?php
        }
        
        $allAds =$ads -> getAdsCityWise($_POST);
        if(empty($allAds))
        {
          echo"<script>alert('No Advertisements Found');</script>";
          ?>
          <script>
            window.location="search_city_wise.php";
          </script>
          <?php
        }

      }
      ?>

      <table id="tblCityWiseSearch" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th></th>
            <th>Title</th>
            <th>Price</th>
            <th>Description</th>
            <th>Status</th>
            <th>Image1</th>

          </tr>
        </thead>
        <tfoot>
          <tr>
           <th></th>
           <th>Title</th>
           <th>Price</th>
           <th>Description</th>
           <th>Status</th>
           <th>Image1</th>
         </tr>
       </tfoot>
     </table>
   </div>
 </div>
</div>
</div>


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
   window.location="search_city_wise.php";
 })
</script>
<!-- refresh page on modal close-->
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
        <p><img src="img/active.png" height="30px" width="30px"/> Signify Active Ads. </p>
        <p><img src="img/inactive.png" height="30px" width="30px"/> Signify Inactive Ads. </p>
        <p><img src="img/blocked.png" height="30px" width="30px"/> Signify Blocked Ads. </p>
        <p><img src="img/soldout.png" height="30px" width="30px"/> Signify Sold product's Ads. </p>
        <p><img src="img/deleted.jpg" height="30px" width="30px"/> Signify Deleted Ads. </p>
      </div>
      <div class="modal-footer" style="padding: 6px;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>