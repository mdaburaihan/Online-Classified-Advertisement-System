<?php 
$title="FAQs | Online Classified Advertisement System";
include("Inc/header.php");
include("admin/Classes/Others.php");
$othr=new Others();
?>
<div class="well" style="padding-top: 0px;">
  <div class="container">
    <div class="row">
     <ul class="breadcrumb">
       <li><a href="index.php"><i class="fa fa-home"></i></a></li>
       <li><a href="#">FAQs</a></li>
     </ul>
     <div class="col-sm-12 col-lg-12">
      <h2 class="h2">
       Frequently Asked Questions(FAQs) 
     </h2>
   </div>
 </div>
</div>
</div>
<div class="container">
<?php
  $getFaqs=$othr->getAllActiveFAQs();
  if(isset($getFaqs))
  {
    while($arr=$getFaqs->fetch_assoc())
    {
      ?>
      <div class="panel-group" id="faqAccordion">
        <div class="panel panel-info">
          <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="<?php echo '#'.$arr['faq_id'];  ?>" style="padding:20px 15px">
            <h3 class="panel-title" style="font-size: 16px">
              <a href="#" class="ing"><?php echo "Q:".$arr['question'];  ?> </a>
            </h3>

          </div>
          <div id="<?php echo $arr['faq_id']; ?>" class="panel-collapse collapse" style="height: 0px;">
            <div class="panel-body">
             <h5><span class="label label-primary" style="font-size: 12px;padding:5px 10px">Answer</span></h5>

             <p style="font-size: 14px">
              <?php echo $arr['answer'];  ?>
            </p>
          </div>
        </div>
      </div>       
    </div>
    <?php
  }
}
?>
</div>


<?php include("Inc/footer.php"); ?>