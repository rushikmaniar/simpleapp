<?php session_start();
if (!isset($_SESSION['user_username'])) {
    echo "hello";
    header("location:../index.php");
}
?>
<?php require_once('../config/config.php');
$con = new connection();
$current_username = $_SESSION['user_username'];
$query_for_id = "SELECT * FROM user WHERE user_username = '$current_username'";
$q = mysqli_query($con->mysqli, $query_for_id);
/*if($q){
	echo "query success";
}else{
	echo mysqli_error($con->mysqli);
	exit();
}*/
$user_array = mysqli_fetch_array($q);

$current_id = $user_array['user_id'];
//if submit button click
if (isset($_POST['update_profile']) && $_POST['update_profile'] == 'update_profile') {
    $user_firstname = mysqli_real_escape_string($con->mysqli, $_POST['user_firstname']);
    $user_lastname = mysqli_real_escape_string($con->mysqli, $_POST['user_lastname']);
    $user_gender = mysqli_real_escape_string($con->mysqli, $_POST['user_gender']);
    $user_age = mysqli_real_escape_string($con->mysqli, $_POST['user_age']);
    $user_dob = mysqli_real_escape_string($con->mysqli, $_POST['user_dob']);
    $user_phone = mysqli_real_escape_string($con->mysqli, $_POST['user_phone']);
    $user_city = mysqli_real_escape_string($con->mysqli, $_POST['user_city']);
    $user_state = mysqli_real_escape_string($con->mysqli, $_POST['user_state']);
    $user_country = mysqli_real_escape_string($con->mysqli, $_POST['user_country']);
    $user_email = mysqli_real_escape_string($con->mysqli, $_POST['user_email']);
    $user_username = mysqli_real_escape_string($con->mysqli, $_POST['user_username']);

    //check if file exits
    if (!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
        //echo "File Not Exits";
        // Nothing To Do
    } else {
        //check if file uploaded
        if ($_FILES['file']['error'] > 0) {

            echo 'Error during uploading, try again';
        }
        $maxWidth = 300;
        $maxHeight = 300;
        list($width, $height) = getimagesize($_FILES['file']['tmp_name']);
        //check if len and width proper
        if ($width > $maxWidth || $height > $maxHeight) {
            // Cancel upload

            echo "<script type='text/javascript'> alert('file size Exceeds or Something Wrong') </script>";
        } else {
            echo $data_path = $user_array['user_pic'];
            $path = str_replace('localhost/github/simpleapp/user/', '', $data_path);
            if (unlink($path)) {
                //echo "<script>alert('delete success')</script>";
                echo "delete success";
                //exit();
            } else {
                echo "delete failed";
                //exit();
            }

            //Set up valid image extensions
            $extsAllowed = array('jpg', 'jpeg', 'png', 'gif');
            //Extract extention from uploaded file
            //substr return ".jpg"
            //Strrchr return "jpg"

            $extUpload = strtolower(substr(strrchr($_FILES['file']['name'], '.'), 1));

            //Check if the uploaded file extension is allowed
            //check if file extension valid
            if (in_array($extUpload, $extsAllowed)) {

                //Upload the file on the server
                //$name = "http://".BASE_PATH."/user/uploads/profile/images/".$last_id."_profile_pic";
                $name = "uploads/profile/images/" . $current_id . "_profile_" . $_FILES['file']['name'];
                $result = move_uploaded_file($_FILES["file"]["tmp_name"], $name);
                $image_name = $last_id . "_profile_" . $_FILES['file']['name'];
                if ($result) {
                    echo $path = BASE_PATH . "user/" . $name;
                    $query = "UPDATE user SET user_pic = '$path',img_name='$image_name' WHERE user_id=$current_id";

                    $q = mysqli_query($con->mysqli, $query);
                    if ($q) {
                        echo "<font class='text-success'>Image Uploaded sucessfully</font>";
                        header("location:index.php");
                    } else {
                        echo mysqli_error($con->mysqli);
                    }
                } else {
                    echo 'File is not valid. Please try again';
                }//$result end

            }//extension check end

        }//file upload check end
    }//check of file exists close

    $con->user_update_proflie(
        $user_firstname,
        $user_lastname,
        $user_gender,
        $user_age,
        $user_dob,
        $user_phone,
        $user_city,
        $user_state,
        $user_country,
        $user_email,
        $user_username,
        $current_id
    );

}

if (isset($_POST['update_password']) && $_POST['update_password'] == 'update') {
    if ((isset($_POST['user_oldpassword'])) && (isset($_POST['new_password'])) && (isset($_POST['confirm_password']))) {
        if ($_POST['confirm_password'] == $_POST['new_password']) {
            $old_password = mysqli_real_escape_string($con->mysqli, $_POST['user_oldpassword']);
            //if old password matches with databse then updat
            if (password_verify($old_password, $user_array['user_password'])) {
                echo "passwword verify";
                //exit();
                $new_password = password_hash(mysqli_real_escape_string(
                    $con->mysqli, $_POST['new_password']), PASSWORD_DEFAULT);                        //update password function called
                $con->user_update_password(
                    $new_password,
                    $current_id
                );
            } else {
                echo "old password wrong";
                //exit();
            }
        } else {
            echo "password not matching";
            exit();
            //exit(); 
        }

    }
}
?>
<html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>My APP</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700' rel='stylesheet'
          type='text/css'>
    <link rel="stylesheet" href="assets/css/fonticons.css">
    <link rel="stylesheet" href="assets/fonts/stylesheet.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--For Plugins external css-->
    <link rel="stylesheet" href="assets/css/plugins.css"/>

    <!--Theme custom css -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!--Theme Responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.css"/>

    <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>

<body>

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<div class='preloader'>
    <div class='loaded'>&nbsp;</div>
</div>
<!--Home page style-->
<header id="main_menu" class="header">
    <div class="main_menu_bg navbar-fixed-top">
        <div class="container">
            <div class="row">
                <div class="nave_menu wow fadeInDown" data-wow-duration="1s">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>

                                <a class="navbar-brand" href="#">DigiTize</a>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#home">Home</a></li>
                                    <!-- <li class="dropdown">
                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Plans and Services <span class="caret"></span></a>
                                          <ul class="dropdown-menu">
                                            <li><a href="#">Dedicated</a></li>
                                            <li><a href="#">Servers</a></li>
                                            <li><a href="#">VPS Servers</a></li>
                                            <li><a href="#">Shared Hosting</a></li>
                                            <li><a href="#">Colcation</a></li>
                                          </ul>
                                        </li>
                                        <li><a href="#pricing">Infrastructure</a></li>
                                        <li><a href="#myworks">News</a></li> -->

                                    <li><a href="#about">About</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#myModal">MY PROFILE</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#password_modal">Change
                                            Password</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

        </div>

    </div>
</header>
<!--End of header -->


<section id="home" class="home">
    <div class="home_overlay">
        <div class="container">
            <div class="row">

                <div class="col-sm-10 col-sm-offset-1">
                    <div class="main_home">
                        <div class="mainhomecontent">
                            <div class="single_home">
                                <div class="col-sm-7">
                                    <div class="single_home_left">
                                        <h2>Welcome To DigiTize Info System</h2>
                                        <h3>Welcome Back </h3>
                                        <div class="col-sm-5">
                                            <div class="single_home_right">
                                                <a href=""><span>Call us :</span> <strong>(818) 995-1560</strong></a>
                                                <a href=""><span>E-mail us :</span>
                                                    <strong>rushikmaniar107@gmail.com</strong> </a>
                                                <!-- <button href="" class="btn btn-lg">Compare Our Pricing Plans</button> -->
                                            </div>
                                        </div>
                                        <!--<img src="assets/images/homepc.png" alt="" />-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
</section>
<!-- End of Banner Section -->

<!--
    <section id="newsstory" class="sewsstory">
        <div class="container">
            <div class="row">
                <div class="main_newsstory text-center">
                    <p><i class="fa fa-rss"> We have recently Upgraded several services. Our Severs are faster than even. <a href="">Read full our News story</a></i></p>
                </div>
            </div>
        </div>
    </section>



    <section id="pricing" class="pricing">
        <div class="container">
            <div class="row">


                <div class="pricing_content_area">
                    <div class="head_title text-center">
                        <p>Grow your business with <strong>Digital Landscape</strong></p>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="single_pricing_text wow fadeIn" data-wow-duration="1s">
                            <div class="pricing_head_text">
                                <h3>Dedicated Servers</h3>
                                <div class="separator"></div>
                                <p>$99.90<span>/month</span></p>
                            </div>
                            <ul>
                                <li><strong>1 TB</strong> Hard Drive</li>
                                <li><strong>8 GB</strong> ECC DDR3</li>
                                <li><strong>4000 GB</strong> Transfer</li>
                                <li><strong>100 Mbps</strong> Uplink</li>
                                <li></li>
                            </ul>
                            <a href="" class="btn btn-primary">Start Free Trial</a>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="single_pricing_text wow fadeIn" data-wow-duration="1.5s">
                            <div class="pricing_head_text">
                                <h3>VPS</h3>
                                <div class="separator"></div>
                                <p>$16.90<span>/month</span></p>
                            </div>
                            <ul>
                                <li><strong>1 TB</strong> Hard Drive</li>
                                <li><strong>8 GB</strong> ECC DDR3</li>
                                <li><strong>4000 GB</strong> Transfer</li>
                                <li><strong>100 Mbps</strong> Uplink</li>
                                <li></li>
                            </ul>
                            <a href="" class="btn btn-primary">Start Free Trial</a>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="single_pricing_text wow fadeIn" data-wow-duration="1.8s">
                            <div class="pricing_head_text">
                                <h3>Shared Hosting</h3>
                                <div class="separator"></div>
                                <p>$14.90<span>/month</span></p>
                            </div>
                            <ul>
                                <li><strong>1 TB</strong> Hard Drive</li>
                                <li><strong>8 GB</strong> ECC DDR3</li>
                                <li><strong>4000 GB</strong> Transfer</li>
                                <li><strong>100 Mbps</strong> Uplink</li>
                                <li></li>
                            </ul>
                            <a href="" class="btn btn-primary">Start Free Trial</a>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="single_pricing_text wow fadeIn" data-wow-duration="2s">
                            <div class="pricing_head_text">
                                <h3>Colocation</h3>
                                <div class="separator"></div>
                                <p>$567.99<span>/month</span></p>
                            </div>
                            <ul>
                                <li><strong>1 TB</strong> Hard Drive</li>
                                <li><strong>8 GB</strong> ECC DDR3</li>
                                <li><strong>4000 GB</strong> Transfer</li>
                                <li><strong>100 Mbps</strong> Uplink</li>
                                <li></li>
                            </ul>
                            <a href="" class="btn btn-primary">Start Free Trial</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section><!-- End of Pricing Section -->
<!--

    <section id="callus" class="callus">
        <div class="container">
            <div class="row">
                <div class="main_callus">
                    <div class="callus_top_content text-center">
                        <p>Can't decide which one best suits you?</p>
                        <p class="phone_call">Call us - <strong>(818) 995-1560</strong></p>
                        <div class="or_section">
                            <div class="separator"></div>
                            <p>or</p>
                        </div>
                        <p class="email_call">Email us - <strong>sales@digitallandscape.com</strong></p>
                    </div>


                    <div class="callus_bottom_content">
                        <div class="col-sm-6">
                            <div class="single_callus_bottom_content">
                                <p>Every business has unique IT requirements, and that's why we provide a wide range of hosted solutions. And since the best configuration for your business may include more than one platform, we can help you mix-and-match to create the optimal hosting solution for your needs. </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="single_callus_bottom_content">
                                <p>Digital Landscape supplies enterprise-grade dedicated servers to resellers, VPS and shared hosts, cloud hosts, gamers, and other clients. With a global presence and multilingual sales and support capabilities, you can rely on Digital Landscape to be ready to help whenever you need it.</p>
                            </div>
                        </div>

                    </div>

                    <div class="callus_client_logo text-center wow fadeInUp" data-wow-duration="1s">
                        <p>Some of our satisfied clients include...</p>
                        <a href=""><img src="assets/images/c1.png" alt="" /></a>
                        <a href=""><img src="assets/images/c6.png" alt="" /></a>
                        <a href=""><img src="assets/images/c3.png" alt="" /></a>
                        <a href=""><img src="assets/images/c4.png" alt="" /></a>
                        <a href=""><img src="assets/images/c5.png" alt="" /></a>
                        <a href=""><img src="assets/images/c2.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->
<!-- Trigger the modal with a button -->
<!--
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
-->
<strong><?php $con->check_birthday($user_array['user_dob']); ?></strong>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">MY PROFILE</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="" role="login" enctype="multipart/form-data">
                    <img src="assets/images/logo2.png" class="img-responsive" alt=""/>

                    <h2 class="h2" align="center">Update Profile</h2>
                    <h5>Firstname</h5>
                    <input type="text" name="user_firstname" placeholder="Firstname" required
                           class="form-control input-lg" value="<?php echo $user_array['user_firstname'] ?>">
                    <h5>Lastname</h5>
                    <input type="text" name="user_lastname" placeholder="LastName" required
                           class="form-control input-lg" value="<?php echo $user_array['user_lastname'] ?>">
                    <br>
                    <h5>Update Pic</h5>
                    <label for="file"> Update Profile pic (max size : (160x160)) : </label>
                    <br>
                    <button name="upload_img"><img src="http://<?php echo $user_array['user_pic']; ?>">
                        <input type="file" name="file">
                    </button>
                    <br>
                    <h5>Gender</h5>
                    <?php
                    if ($user_array['user_gender'] == 1) {
                        ?>
                        <input type="radio" name="user_gender" value="1" checked="checked"> Male
                        <input type="radio" name="user_gender" value="0"> Female
                        <br>
                        <?php
                    } else {
                        ?>
                        <input type="radio" name="user_gender" value="1"> Male
                        <input type="radio" name="user_gender" value="0" checked="checked"> Female
                        <?php
                    }

                    ?>

                    <h5>Age</h5>
                    <input type="number" name="user_age" placeholder="Age" required class="form-control input-lg"
                           value="<?php echo $user_array['user_age'] ?>">

                    <h5>Date Of Birth</h5>
                    <input type="date" name="user_dob" required class="form-control input-lg"
                           value="<?php echo $user_array['user_dob']; ?>">

                    <h5>Phone Number</h5>
                    <input type="text" name="user_phone" required class="form-control input-lg"
                           placeholder="Phone Number" value="<?php echo $user_array['user_phone'] ?>">

                    <h5>City</h5>
                    <input type="text" name="user_city" required class="form-control input-lg" placeholder="City"
                           value="<?php echo $user_array['user_city'] ?>">

                    <h5>State</h5>
                    <input type="text" name="user_state" required class="form-control input-lg" placeholder="State"
                           value="<?php echo $user_array['user_state'] ?>">

                    <h5>Country</h5>
                    <input type="text" name="user_country" required class="form-control input-lg" placeholder="Country"
                           value="<?php echo $user_array['user_country'] ?>">

                    <h5>Email</h5>
                    <input type="email" name="user_email" placeholder="Email" required class="form-control input-lg"
                           value="<?php echo $user_array['user_email'] ?>"/>

                    <h5>UserName</h5>
                    <input type="text" name="user_username" required class="form-control input-lg"
                           placeholder="UserName" value="<?php echo $user_array['user_username'] ?>">

                    <button type="submit" name="update_profile" class="btn btn-lg btn-primary btn-block"
                            value="update_profile">Update Profile
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="password_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Password</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="" role="login" enctype="multipart/form-data">
                    <h5>Old Password</h5>
                    <input type="password" name="user_oldpassword" placeholder="Enter Old Password"
                           class="form-control input-lg" id="user_oldpassword" required="required">

                    <h5>New Password</h5>
                    <input type="password" name="new_password" placeholder="Enter New Passsword"
                           class="form-control input-lg" id="new_password" required="required"/>

                    <h5>Confirm Password</h5>
                    <input type="password" name="confirm_password" placeholder="Enter New Passsword"
                           class="form-control input-lg" id="new_password" required="required"/>

                    <button type="submit" name="update_password" class="btn btn-lg btn-primary btn-block"
                            value="update">Update Password
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<section id="footerwidget" class="footerwidget">
    <div class="container">
        <div class="row">
            <div class="main_footerwidget">
                <div class="col-sm-2 col-xs-6">
                    <div class="single_widget">
                        <h4>Home</h4>
                        <a href="#" class="navbar-brande">DigiTize</a>
                        <br>
                        <a href="#" class="navbar-brande" data-toggle="modal" data-target="#myModal">My Profile</a>
                        <br>
                        <a href="#" class="navbar-brande" data-toggle="modal" data-target="#password_modal">Update
                            Password</a>
                    </div>
                </div>
                <!--<div class="col-sm-2 col-xs-6">
                        <div class="single_widget">
                            <h4>Plans and Services</h4>
                            <ul>
                                <li><a href="">Dedicated</a></li>
                                <li><a href="">Servers</a></li>
                                <li><a href="">About company</a></li>
                                <li><a href="">VPS</a></li>
                                <li><a href="">Servers</a></li>
                                <li><a href="">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-6">
                        <div class="single_widget">
                            <h4>Infrastructure</h4>
                            <ul>
                                <li><a href="">Dedicated</a></li>
                                <li><a href="">Servers</a></li>
                                <li><a href="">About company</a></li>
                                <li><a href="">VPS</a></li>
                                <li><a href="">Servers</a></li>
                                <li><a href="">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-6">
                        <div class="single_widget">
                            <h4>News</h4>
                            <ul>
                                <li><a href="">Dedicated</a></li>
                                <li><a href="">Servers</a></li>
                                <li><a href="">About company</a></li>
                                <li><a href="">VPS</a></li>
                                <li><a href="">Servers</a></li>
                                <li><a href="">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-6">
                        <div class="single_widget">
                            <h4>About</h4>
                            <ul>
                                <li><a href="">Shared Hosting</a></li>
                                <li><a href="">Colocation</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-6">
                        <div class="single_widget">
                            <h4>Support</h4>
                            <ul>
                                <li><a href=""><span>Call us :</span>  <strong>(818) 995-1560</strong></a>
                                        </li>
                                <li><a href=""><span>E-mail us :</span> <strong>XpeedStudio@gmail.com</strong> </a></li>

                            </ul>
                        </div>
                    </div> -->
            </div>
        </div>
    </div>
</section>

<footer id="footer" class="footer">
    <div class="container">
        <div class="row">
            <div class="main_footer">
                <div class="col-sm-6 col-xs-12">
                    <div class="single_footer_left">
                        <p>Design: <strong>Rushik</strong></p>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="single_footer_right wow fadeInDown" data-wow-duration="1s">
                        <p>Made with <i class="fa fa-heart"></i> by <strong><a href="http://bootstrapthemes.co">Bootstrap
                                    Themes</a></strong> 2016. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- STRAT SCROLL TO TOP -->

<div class="scrollup">
    <a href="#"><i class="fa fa-chevron-up"></i></a>
</div>

<script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
<script src="assets/js/vendor/bootstrap.min.js"></script>
<script src="assets/js/vendor/isotope.min.js"></script>

<script src="assets/js/jquery.easypiechart.min.js"></script>
<script src="assets/js/jquery.mixitup.min.js"></script>


<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>

</body>

</html>
