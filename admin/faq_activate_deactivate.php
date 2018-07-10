<?php
    function __autoload($classname){
  include_once("Classes/$classname.php");
}
   $fq = new Others();
if(isset($_GET['action']) && $_GET['action']=="deactivate"){
  $faqid = $_GET['faq_id'];
  $res = $fq -> deactivateFAQ($faqid);
  if($res){
   //header("location:manage_FAQs.php?FAQ_list");
   ?>
   <script>window.location="manage_FAQs.php?FAQ_list";</script>
   <?php
  }
}

if(isset($_GET['action']) && $_GET['action']=="activate"){
  $faqid = $_GET['faq_id'];
  $res = $fq -> activateFAQ($faqid);
  if($res){
   //header("location:manage_FAQs.php?FAQ_list");
   ?>
   <script>window.location="manage_FAQs.php?FAQ_list";</script>
   <?php
  }
}
?>