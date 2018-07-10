<?php
class Session{
 public static function init(){
  if (version_compare(phpversion(), '5.4.0', '<')) {
        if (session_id() == '') {
            session_start();
        }
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
 }

 public static function set($key, $val){
  $_SESSION[$key] = $val;
 }

 public static function get($key){
  if (isset($_SESSION[$key])) {
   return $_SESSION[$key];
  } else {
   return false;
  }
 }

 public static function checkAdminSession(){
  self::init();
  if (self::get("login")== false) {
   self::adminDestroy();
   //header("Location:../login.php");
   ?>
   <script>window.location="../login.php";</script>
   <?php
  }
 }

 public static function checkUserSession(){
  self::init();
  if (self::get("login")== false) {
   self::userDestroy();
   //header("Location:login.php");
   ?>
   <script>window.location="login.php";</script>
   <?php
  }

 }

 // public static function checkAdminLogin(){
 //  self::init();
 //  if (self::get("login")== true) {
 //   header("Location:index.php");
 //  }
 // }

 public static function checkUserLogin(){
  self::init();
  if (self::get("login")== true) {
    if(self::get("role")=="S"){
      //header("Location:seller_dashboard.php");
      ?>
   <script>window.location="seller_dashboard.php";</script>
   <?php
  }elseif (self::get("role")=="B") {
    //header("Location:buyer_dashboard.php");
    ?>
   <script>window.location="buyer_dashboard.php";</script>
   <?php
  }
   else{
    //header("Location:admin/admin_panel.php");
    ?>
   <script>window.location="admin/admin_panel.php";</script>
   <?php
  }
 }
}

 public static function adminDestroy(){
  session_destroy();
  //header("Location:../login.php");
   ?>
   <script>window.location="../login.php";</script>
   <?php
 }

  public static function userDestroy(){
  session_destroy();
  //header("Location:login.php");
  ?>
   <script>window.location="login.php";</script>
   <?php
 }


public static function Destroy(){
  session_destroy();
 }
}
?>