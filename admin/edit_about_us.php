<?php include("inc/header.php"); ?>

<?php
include("Classes/Others.php");
$othr=new Others();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['setAboutUs'])){

 $addAboutUs=$othr->editAboutUs($_POST);
}
?>


<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function () {

    $('textarea.tinymce').tinymce({
        // Location of TinyMCE script
        script_url: 'js/tiny-mce/tiny_mce.js',

        // General options
        theme: "advanced",
        plugins: "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

        // Theme options
        theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
        theme_advanced_toolbar_location: "top",
        theme_advanced_toolbar_align: "left",
        theme_advanced_statusbar_location: "bottom",
        theme_advanced_resizing: true,

        // Example content CSS (should be your site CSS)
        content_css: "css/content.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url: "lists/template_list.js",
        external_link_list_url: "lists/link_list.js",
        external_image_list_url: "lists/image_list.js",
        media_external_list_url: "lists/media_list.js",

        // Replace values for the template plugin
        template_replace_values: {
          username: "Some User",
          staffid: "991234"
        }
      });

  });
</script>

<!-- Load TinyMCE -->
<div class="col-lg-12" style="margin-top: 30px;margin-left: 0px;margin-right: 0px">

 <div class="col-lg-3">
 </div>
 <div class="col-lg-6">
  <div class="row">
    <div class="col-lg-4">
    </div>
    <div class="panel panel-primary">
      <div class="panel-heading" style="text-align: center;font-size: 16px;">Edit About Us</div>
      <div class="panel-body">
        <form name="aboutuspage" method="post" class="addUserFrm">
          <section style="margin-left:200px;font-size: 16px;">
           <?php
           if(isset($addAboutUs)){
            echo "$addAboutUs";
          }
          ?>
        </section>
        <?php
        $getAbout=$othr->getAboutUs();
        if(isset($getAbout))
        {
          $arr=$getAbout->fetch_assoc();
          ?>

          <div class="col-lg-8">

            <textarea class="tinymce" name="aboutus" row="50" col="80"><?php echo $arr['about_us']; ?></textarea>

          </div>
          <?php
        }
        ?>

    </div>
    <div class="row" style="margin-top: 20px;margin-bottom: 20px">
      <div class="col-lg-5">
      </div>
      <div class="col-lg-2">
        <button type="submit" class="btn btn-primary btn-lg" name="setAboutUs">Save</button>
      </div>
      <div class="col-lg-5">
      </div>
    </div>
  </form>
  </div>
</div>

</div>
<div class="col-lg-3">
</div>

</div>
<div class="panel panel-default">
  <div class="panel-body"><button type="button" class="btn btn-primary" onclick="location.href = 'admin_panel.php';"><< Go Back</button></div>
</div>
<?php include("inc/footer.php"); ?>
