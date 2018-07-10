<?php 
$title="Login | Online Classified Advertisement System";
include("Inc/header.php"); 
?>
<?php Session::checkUserLogin(); ?>
<?php
include("Classes/User.php");
$usr=new User();
?>

<!--   <link href="css/login_style.css" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<div class="container">
  <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="index.php">Account</a></li>
        <li><a href="login.php">Login</a></li>
  </ul>
  <div class="col-sm-4" style="margin-top: 20px;margin-left: 150px;">       
    <div class="well col-sm-12" style="background-color: white;padding-bottom: 110px;">     
      <h2 class="main-text">New User</h2>
      <p><strong>Register Account</strong></p>
      <p>By creating an account you will be able to sell or buy any product. You can give and manage your advertisements of your products you want to sell by register yourself as seller. You can also search needed products, manage wishlist and confirm product by register yourself as buyer. Create account and enjoy our services.</p>
      <a href="register.php" class="btn btn-success btn-md" style="">Continue</a>
    </div>
  </div>

  <div class="login-page">
    <div class="form">
    <h2 class="main-text">Login here</h2>
     <form class="login-form" method="post">
       <?php
       if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){
         $uLogin=$usr->userLogin($_POST);
       }
      ?>
       <div>
     <?php
       if(isset($uLogin)){
         echo "$uLogin";
       }
       ?>
     </div>
       
       <input type="text" name="email" placeholder="Email Id" value="<?php if(isset($_POST['email'])) { echo htmlentities ($_POST['email']); }?>"/>
       <input type="password" name="pass" placeholder="password" value="<?php if(isset($_POST['pass'])) { echo htmlentities ($_POST['pass']); }?>"/>
       <select name="role">

        <option value="">Login As</option>
         <option value="admin">
         Admin
       </option>
        <option value="seller">Seller
        </option>
        <option value="buyer">
          Buyer
        </option>
       
      </select>
      <button name= "login" id="show_button">Login</button>
      <p class="message">Forgot Password? <a href="forgot_password.php" onmouseover="this.style.color='red'"
        onmouseout="this.style.color='#337ab7'">Click here</a></p>
      </form>
    </div>
  </div>
</div>

<?php include("Inc/footer.php"); ?>
