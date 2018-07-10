 <?php
  include("Classes/Others.php");
  $othr=new Others();
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['setFAQ'])){

   $addFAQ=$othr->addNewFAQ($_POST);
 }
 ?>

<div class="col-lg-12" style="margin-top: 20px;margin-left: 0px;margin-right: 0px">

 <div class="col-lg-2">
 </div>


 <div class="col-lg-8">
  <div class="panel panel-primary">
    <div class="panel-heading" style="text-align: center;font-size: 16px;">Add New FAQ</div>
    <div class="panel-body">

      <form name="faqpage" method="post">
        <div class="row">

          <section style="margin-left:350px;font-size: 16px;">
           <?php
           if(isset($addFAQ)){
            echo "$addFAQ";
          }
          ?>
        </section>
        <div class="col-lg-2">
          <h4>New Question :</h4>
        </div>
        <div class="col-lg-10">
          <input type="text" name="question" placeholder="Enter new question here..." value="<?php if(isset($_POST['question'])) { echo htmlentities ($_POST['question']); }?>" class="form-control" style="font-size: 16px">
        </div>
      </div>

      <div class="row" style="margin-top: 20px;margin-bottom: 20px">

        <div class="col-lg-2">
          <h4>Answer :</h4>
        </div>
        <div class="col-lg-10">
         <textarea name="answer" placeholder="Enter answer here..." rows="10" class="form-control" style="font-size: 16px" required><?php if(isset($_POST['answer'])) { echo htmlentities ($_POST['answer']); }?>
       </textarea>
        </div>
      </div>

      <div class="row" style="margin-top: 20px;margin-bottom: 20px">

        <div class="col-lg-6">
        </div>
        <div class="col-lg-4">
          <button type="submit" class="btn btn-primary btn-lg" name="setFAQ">Save</button>
        </div>
      </div>

    </form>
  </div>
</div>
</div>
<div class="col-lg-2">
</div>

</div>

