<?php include("inc/header.php"); ?>

<div class="well">
  <h4>Manage FAQs Section</h4>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_FAQs.php?add_FAQs';">Add New FAQ</button>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_FAQs.php?FAQ_list';">All FAQs</button>
</div>
<div>

  <div style="height:auto;">
    <?php 
    if(isset($_GET['add_FAQs']))
    {
      include("add_FAQs.php");
    }
    elseif(isset($_GET['FAQ_list']))
    {

      include("FAQ_list.php");
    }
    else
    {

    }
    ?>
  </div>
  <?php include 'Classes/Others.php';?>
  <?php
  $fq=new Others();
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updateFAQ'])){
   $question=$_POST['question'];
   $answer=$_POST['answer'];
   $faqid=$_POST['faqid'];

   $updateFAQ=$fq->faqUpdate($question,$answer,$faqid);
 }
 ?>
 <div class="col-lg-12" style="margin-top: 20px;margin-left: 0px;margin-right: 0px">

   <div class="col-lg-2">
   </div>


   <div class="col-lg-8">
    <div class="panel panel-primary">
      <div class="panel-heading" style="text-align: center;font-size: 16px;">Edit FAQ</div>
      <div class="panel-body">

        <form name="faqpage" method="post">
          <div class="row">

            <section style="margin-left:400px;font-size: 16px;">
             <?php
             if(isset($updateFAQ)){
              echo "$updateFAQ";
            }
            ?>
          </section>
          <?php
          $faqid = $_GET['faq_id'];
          $SelectedFaq = $fq -> getFAQbyId($faqid);
          if($SelectedFaq){
            $arr=$SelectedFaq->fetch_assoc();
            ?>
            <div class="col-lg-2">
              <input type="hidden" name="faqid" value="<?php echo $arr['faq_id'] ?>">
              <h4>New Question :</h4>
            </div>
            <div class="col-lg-10">
              <input type="text" name="question" placeholder="Enter new question here..." value="<?php echo $arr['question'] ?>" class="form-control" style="font-size: 16px">
            </div>
          </div>

          <div class="row" style="margin-top: 20px;margin-bottom: 20px">

            <div class="col-lg-2">
              <h4>Answer :</h4>
            </div>
            <div class="col-lg-10">
             <textarea name="answer" placeholder="Enter answer here..." rows="10" class="form-control" style="font-size: 16px" required>
              <?php echo $arr['answer'] ?>
            </textarea>
          </div>
        </div>
     <?php
   }
     ?>
        <div class="row" style="margin-top: 20px;margin-bottom: 20px">

          <div class="col-lg-6">
          </div>
          <div class="col-lg-4">
            <button type="submit" class="btn btn-primary btn-lg" name="updateFAQ">Update</button>
          </div>
        </div>

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
