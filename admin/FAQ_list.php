<?php
function __autoload($classname){
  include_once("Classes/$classname.php");
}
?>
<div id="overlay" align="center">
 <img src="img/Loading_icon.gif" alt="Loading" />
</div>
<div id="main-content">
  <div class="container">
   <div class="panel panel-primary">
    <div class="panel-heading" style="text-align: center;font-size: 16px;">All FAQs</div>
    <div class="panel-body">
      <?php
      $othr = new Others();
      $allfaqs =$othr -> getAllFAQs();
      ?>
      <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>SlNo.</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Status</th>
             <th>Edit</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>SlNo.</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Status</th>
             <th>Edit</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          $sl=1;
          if($allfaqs){
            while ($arr=$allfaqs->fetch_assoc()){?>
            <tr>
              <td><?php echo $sl; ?></td>
              <td><?php echo $arr['question'] ?></td>
              <td><?php echo $arr['answer'] ?></td>
              <td>
                <?php 
                if($arr['status'] == 1){
                  ?>
                  <img src="img/active.png" height="30px" width="30px">
                  <?php
                }else{
                  ?>
                  <img src="img/inactive.png" height="30px" width="30px">
                  <?php
                }
                ?>
              </td>
              <td><a href="edit_FAQs.php?faq_id=<?php echo $arr['faq_id']; ?>"><img src="../Images/edit.png" height="40px" width="40px"></a></td>
              <td>
                <?php 
                if($arr['status'] == 1){?>
                <a href="faq_activate_deactivate.php?action=deactivate&faq_id=<?php echo $arr['faq_id']; ?>" class="btn btn-danger" role="button">Deactivate</a>
                <?php 
              }else{?>
              <a href="faq_activate_deactivate.php?action=activate&faq_id=<?php echo $arr['faq_id']; ?>" class="btn btn-success" role="button">&nbsp;&nbsp;Activate&nbsp;&nbsp;</a>
              <?php
            }
            ?>
          </td>

          </tr> 
          <?php 
          $sl++;
        }
      } 
      ?>        
    </tbody>
  </table>
</div>
</div>
</div>
</div>
