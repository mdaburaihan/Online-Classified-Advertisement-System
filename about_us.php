<?php 
$title="About Us | Online Classified Advertisement System";
include("Inc/header.php"); 
include("C:/wamp/www/Online_Classified_Advertisement/admin/Classes/Others.php");
$othr=new Others();
?>
<div class="well" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
        	<ul class="breadcrumb">
			<li><a href="index.php"><i class="fa fa-home"></i></a></li>
			<li><a href="#">About Us</a></li>
		   </ul>
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    About us 
                </h1>
                </div>
            </div>
        </div>
  </div>
  <div class="container">
  	<div class="well" style="background-color: #e7ebff;">
  		<h2>here are some words about us...</h2>
      <?php
       $getAbout=$othr->getAboutUs();
        if(isset($getAbout))
        {
          $arr=$getAbout->fetch_assoc();
          ?>
  		<p> <?php echo $arr['about_us']; ?></p>
      <?php
    }
      ?>
  	</div>
  </div>


<?php include("Inc/footer.php"); ?>