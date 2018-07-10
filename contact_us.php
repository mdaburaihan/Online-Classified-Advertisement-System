<?php
$title="Contact Us | Online Classified Advertisement System";
 include("Inc/header.php"); 
include("Classes/Others.php"); 
$othr=new Others();
?>

<div class="well" style="padding-top: 0px">
    <div class="container">
        <div class="row">
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Contact Us</a></li>
           </ul>
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    Contact us <small>Feel free to contact us</small></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="well well-sm" style="background-color: #e7ebff;">
                    <form name="contactform" method="post" class="contactus">
                        <?php
                        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['ContactUs'])){
                            $uContact=$othr->contactUs($_POST);
                       }
                       ?>  
                           <span style="margin-left: 200px">
                            <?php
                           if(isset($uContact)){
                               echo "$uContact";
                           }
                           ?>
                           </span>
                           <div class="row" style="margin-top: 20px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                    Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter name" required="required" value="<?php if(isset($_POST['name'])) { echo htmlentities ($_POST['name']); }?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="email">
                                    Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                    </span>
                                    <input type="text" class="form-control" name="email" placeholder="Enter email" required="required" value="<?php if(isset($_POST['email'])) { echo htmlentities ($_POST['email']); }?>"/></div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                    Message</label>
                                    <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                    placeholder="Message">
                                        <?php if(isset($_POST['message'])) { echo htmlentities ($_POST['message']); }?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right" name="ContactUs">
                                Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <form>
                    <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
                    <address>
                        <strong>Classified Advertisement</strong><br>
                        Berhampore<br>
                        Murshidabad, Pin 742102<br>
                        <abbr title="Phone">
                        P:</abbr>
                        9609328343
                    </address>
                    <address>
                        <strong>Email</strong><br>
                        <a href="mailto:#">classified@gmail.com</a>
                    </address>
                </form>
            </div>
        </div>
    </div>

    <?php include("Inc/footer.php"); ?>