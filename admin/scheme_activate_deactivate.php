    <?php
    function __autoload($classname){
      include_once("Classes/$classname.php");
    }
    $schm = new Scheme();
    if(isset($_GET['action']) && $_GET['action']=="deactivate"){
      $schemeid = $_GET['scheme_id'];
      $res = $schm -> deactivateScheme($schemeid);
      if($res){
       //header("location:manage_scheme.php?scheme_list");
       ?>
       <script>window.location="manage_scheme.php?scheme_list";</script>
       <?php
     }
   }

   if(isset($_GET['action']) && $_GET['action']=="activate"){
    $schemeid = $_GET['scheme_id'];
    $res = $schm -> activateScheme($schemeid);
    if($res){
      //header("location:manage_scheme.php?scheme_list");
      ?>
       <script>window.location="manage_scheme.php?scheme_list";</script>
       <?php
   }
 }
 ?>