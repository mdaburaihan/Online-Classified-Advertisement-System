<?php include("inc/header.php"); ?>
<?php 
include("../Classes/AdsManage.php"); 
$ads = new AdsManage();
?>
<?php 
include("Classes/City.php"); 
?>
<script>
 $(document).ready(function(){
   $('#download').click(function(){
     //var fromdate = document.getElementById("datepickerFrom").value;
     var fromdate = "<?php echo $_POST['datepickerFrom'];?>";
    // var todate = document.getElementById("datepickerTo").value;
    var todate = "<?php echo $_POST['datepickerTo'];?>";
    var cityid = "<?php echo $_POST['cityid'];?>";
    //alert(cityid);
     window.open("Ad_Register_Report_By_City.php?fromdate="+fromdate+"&todate="+todate+"&cityid="+cityid,"_blank");
   });
 });
</script>

<!--Date Picker-->
<script>
$( function() {
    $( "#datepickerFrom" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'

    });

    $( "#datepickerTo" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });

  });
</script>
<!--Date Picker-->


<div class="well" style="height: 130px;">
<div class="col-lg-12">
  <div class="row">
 <form name="search_ads" method="post" style="">  
   <div class="col-lg-12" style="">
    <div class="col-lg-1" style="font-size: 16px;text-align: right;">
     <label>From :</label>
   </div>
   <div class="col-lg-2">
    <input type="text" class="form-control" name="datepickerFrom" id="datepickerFrom" placeholder="From Date">
  </div>
<div class="col-lg-1" style="font-size: 16px;text-align: right;">
 <label>To:</label>
</div>
<div class="col-lg-2">
   <input type="text" class="form-control" name="datepickerTo" id="datepickerTo" placeholder="To Date">
</div>
<div class="col-lg-1" style="font-size: 16px;text-align: right;">
 <label>City:</label>
</div>
<div class="col-lg-2">
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
<div class="col-lg-1">
    <button type="submit" name="show" class="btn btn-primary">Show</button>
</div>
<div class="col-lg-1">
   <button type="button" id="download" class="btn btn-default" style="background-color: #f5f5f5;border:0px;color:blue;display:none">
    <img src="img/pdf_icon.png">Click to download
  </button>
</div>
</div>
</form>
</div>

<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12" style="padding-left: 500px;">
   <strong style="font-size: 20px;">Advertisement Register </strong> From  <label id="frmdate">Date</label> To <label id="todate">Date</label> of the city <label id="setcity">City Name</label>
  </div>
 <!--  <div class="col-lg-3" style="font-size: 16px;color:blue;text-align: right;">
    <label>From Date:</label>
  </div>
  <div class="col-lg-2">
    <label id="frmdate"></label>
  </div>
  <div class="col-lg-3" style="font-size: 16px;color:blue;text-align: right;">
    <label>To Date:</label>
  </div>
  <div class="col-lg-2">
    <label id="todate"></label>
  </div> -->
</div>
</div>
</div>


<script type="text/javascript">
  document.getElementById('frmdate').innerHTML = "<?php echo $_POST['datepickerFrom'];?>";
  document.getElementById('todate').innerHTML = "<?php echo $_POST['datepickerTo'];?>";
  document.getElementById('setcityid').value = "<?php echo $_POST['cityid'];?>";
  document.getElementById('datepickerFrom').value = "<?php echo $_POST['datepickerFrom'];?>";
  document.getElementById('datepickerTo').value = "<?php echo $_POST['datepickerTo'];?>";
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
    <div class="panel panel-primary">
      <div class="panel-heading" style="text-align: center;font-size: 16px;">Advertisements</div>
      <div class="panel-body">
        <div class="container-fluid" style="overflow-y:hidden;overflow-x: scroll;">
        <?php
        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['show'])){

         $FromDate=$_POST['datepickerFrom'];
         $ToDate=$_POST['datepickerTo'];
         $cityid=$_POST['cityid'];
         // echo "<script>alert('$FromDate');</script>";
        //echo "<script>alert('$ToDate');</script>";

         if($FromDate=="" || $ToDate=="" || $cityid=="")
         {
          echo "<script>alert('Please Enter From Date,To Date & City.');</script>";
           ?>
            <script>
            window.location="ads_by_fromdate_todate_city.php";
          </script>
          <?php
        }
        
        $allAds =$ads -> getAdsbyFromDateToDateCity($_POST);
        if(empty($allAds))
        {
            echo"<script>alert('No Advertisements Found');</script>";
            ?>
            <script>
            window.location="ads_by_fromdate_todate_city.php";
          </script>
          <?php
        }
        ?>
        <script>
          $(document).ready(function(){

             var cityid = $("#setcityid option:selected").val();
             //alert(catid);
             $.ajax({
              type: "GET",
              url: "FetchCityById.php",
              data: {cityid:cityid,type:'city'},
              cache: false,
              success: function(data){

                  //alert("hello");
                  var result = $.trim(data);
                  document.getElementById('setcity').innerHTML = result;

                },
                error: function(err) {
                  alert(err);
                }
              });
           });

          document.getElementById("download").style.display='block';
        </script>
     <?php

      }
      ?>

      <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Sl.</th>
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
            <th>Seller's Name</th>
            <th>Seller's Email</th>
            <th>Seller's Phone</th>
            <th>Seller's Status</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Sl.</th>
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
            <th>Seller's Name</th>
            <th>Seller's Email</th>
            <th>Seller's Phone</th>
            <th>Seller's Status</th>
          </tr>
        </tfoot>
        <tbody>    
         <?php
         $sl=1;
         if(isset($allAds))
         {
          while ($arr=$allAds->fetch_assoc())
          {
            ?>

            <tr>
             <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arr['ad_id']; ?>">
             <td>
              <?php echo $sl; ?>
            </td>
            <td><?php echo $arr['adpostdate'] ?></td>
            <td><?php echo $arr['title'] ?></td>
            <td><?php echo $arr['cat_name'] ?></td>
            <td><?php echo $arr['subcat_name'] ?></td>
            <td><?php echo $arr['description'] ?></td>
            <td><img src="<?php echo '../Upload' . '/' . $arr['pic1']; ?>" height="100" width="100" class="zoomeffect"/></td>
            <td><img src="<?php echo '../Upload' . '/' . $arr['pic2']; ?>" height="100" width="100" class="zoomeffect"/></td>
            <td><img src="<?php echo '../Upload' . '/' . $arr['pic3']; ?>" height="100" width="100" class="zoomeffect"/></td>
            <td><?php echo $arr['city_name'] ?></td>
            <td><?php echo "₹".$arr['price'] ?></td>
            <td>
              <?php 
              if($arr['active_status'] == 0){

                echo"<strong>Inactive</strong>";

              }else if($arr['active_status'] == 1){

                echo"<strong>Active</strong>";

              }else if($arr['active_status'] == 2){

                echo"<strong>Deleted</strong>";

              }else if($arr['active_status'] == 3){

               echo"<strong>Sold out</strong>";

              }else if($arr['active_status'] == 4){

                echo"<strong>Blocked</strong>";

              }else{
                echo"Not Found.";
              }
              ?>
            </td>
             <td>
          <?php echo $arr['name'] ?>
        </td>
        <td>
          <?php echo $arr['email'] ?>
        </td>
         <td>
          <?php echo $arr['phone'] ?>
        </td>
         <td>
          <?php
            if($arr['block'] == 0)
            {
              echo"<strong>Active User</strong>";
            }
            else
            {
              echo"<strong>Blocked User</strong>";
            }
           ?>
        </td>
          </tr> 
          <?php 
          $sl++;
        }

      }
      else
      {
        
      $sl=1;
      $allAdsdisplay =$ads -> getAllAds();
       if($allAdsdisplay)
        {
        while ($arrr=$allAdsdisplay->fetch_assoc())
          {
            ?>

            <tr>
             <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arrr['ad_id']; ?>">
             <td>
              <?php echo $sl; ?>
            </td>
            <td><?php echo $arrr['adpostdate'] ?></td>
            <td><?php echo $arrr['title'] ?></td>
            <td><?php echo $arrr['cat_name'] ?></td>
            <td><?php echo $arrr['subcat_name'] ?></td>
            <td><?php echo $arrr['description'] ?></td>
            <td><img src="<?php echo '../Upload' . '/' . $arrr['pic1']; ?>" height="100" width="100" class="zoomeffect"/></td>
            <td><img src="<?php echo '../Upload' . '/' . $arrr['pic2']; ?>" height="100" width="100" class="zoomeffect"/></td>
            <td><img src="<?php echo '../Upload' . '/' . $arrr['pic3']; ?>" height="100" width="100" class="zoomeffect"/></td>
            <td><?php echo $arrr['city_name'] ?></td>
            <td><?php echo "₹".$arrr['price'] ?></td>
            <td>
              <?php 
              if($arrr['active_status'] == 0){

                echo"<strong>Inactive</strong>";

              }else if($arrr['active_status'] == 1){

                echo"<strong>Active</strong>";

              }else if($arrr['active_status'] == 2){

                echo"<strong>Deleted</strong>";

              }else if($arrr['active_status'] == 3){

               echo"<strong>Sold out</strong>";

              }else if($arrr['active_status'] == 4){

                echo"<strong>Blocked</strong>";

              }else{
                echo"Not Found.";
              }
              ?>
            </td>
             <td>
          <?php echo $arrr['name'] ?>
        </td>
        <td>
          <?php echo $arrr['email'] ?>
        </td>
         <td>
          <?php echo $arrr['phone'] ?>
        </td>
         <td>
          <?php
            if($arrr['block'] == 0)
            {
              echo"<strong>Active User</strong>";
            }
            else
            {
              echo"<strong>Blocked User</strong>";
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
</div>
</div>
</div>
</div>

<?php include("inc/footer.php"); ?>