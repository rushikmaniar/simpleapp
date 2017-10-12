<?php session_start(); ?>
<?php

require_once('../config/config.php');
$con = new connection();

if (isset($_POST['submitbtn']) && $_POST['submitbtn'] == 'SignUp') {

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
    $user_password = password_hash(mysqli_real_escape_string($con->mysqli, $_POST['user_password']), PASSWORD_DEFAULT);

    $con->insert_func = $con->user_signup($user_firstname, $user_lastname, $user_gender, $user_age, $user_dob, $user_phone, $user_city, $user_state, $user_country, $user_email, $user_username, $user_password);

    if ($con->signup_query) {
        echo $last_id = mysqli_insert_id($con->mysqli);
        // exit();

        if ($_FILES['file']['error'] > 0) {
            echo 'Error during uploading, try again';
        }
        $maxWidth = 300;
        $maxHeight = 300;

        list ($width, $height) = getimagesize($_FILES['file']['tmp_name']);

        if ($width > $maxWidth || $height > $maxHeight) {
            // Cancel upload
            echo "<script type='text/javascript'> alert('file size Exceeds or Something Wrong') </script>";
        } else {
            // We won't use $_FILES['file']['type'] to check the file extension for security purpose

            // Set up valid image extensions
            $extsAllowed = array(
                'jpg',
                'jpeg',
                'png',
                'gif'
            );

            // Extract extention from uploaded file
            // substr return ".jpg"
            // Strrchr return "jpg"

            $extUpload = strtolower(substr(strrchr($_FILES['file']['name'], '.'), 1));

            // Check if the uploaded file extension is allowed

            if (in_array($extUpload, $extsAllowed)) {

                // Upload the file on the server
                // $name = "http://".BASE_PATH."/user/uploads/profile/images/".$last_id."_profile_pic";
                $name = "../user/uploads/profile/images/" . $last_id . "_profile_" . $_FILES['file']['name'];
                $result = move_uploaded_file($_FILES["file"]["tmp_name"], $name);
                $image_name = $last_id . "_profile_" . $_FILES['file']['name'];
                if ($result) {

                    $path = str_replace('../', BASE_PATH, $name);
                    $query = "UPDATE user SET user_pic = '$path',img_name='$image_name' WHERE user_id=$last_id";
                    $q = mysqli_query($con->mysqli, $query);
                    if ($q) {
                        echo "<font class='text-success'>Image Uploaded sucessfully</font>";
                        header("location:index.php?status=1");
                    } else {
                        echo mysqli_error($con->mysqli);
                    }
                }
            } else {
                echo 'File is not valid. Please try again';
            }
        }
    } else {
        echo mysqli_error($con->mysqli);
        echo "<font class='text-danger'>Something Wrong</font>";
        // exit();
    }
}

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=1,initial-scale=1,user-scalable=1"/>
    <title>Simple App</title>

    <link
            href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900"
            rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css"
          href="assets/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body>

<section class="container">
    <section class="signup-form">
        <form method="post" action="" role="login" enctype="multipart/form-data" id="signupForm">
            <img src="assets/images/logo2.png" class="img-responsive" alt=""/>
            <h2 class="h2" align="center">SignUpForm</h2>
            <input type="text" name="user_firstname" placeholder="Firstname"
                   required class="form-control input-lg"> <input type="text"
                                                                  name="user_lastname" placeholder="LastName" required
                                                                  class="form-control input-lg"> <label for="file">
                Upload
                Profile(max size : (160x160)) : </label><br> <input type="file"
                                                                    name="file"> <input type="radio" name="user_gender"
                                                                                        value="1"> Male
            <input type="radio" name="user_gender" value="0"> Female
            <br>
            <input type="number" name="user_age" id="age" placeholder="Age" required="required"
                   class="form-control input-lg">
            <br> Date Of Birth
            <input type="date" name="user_dob" required class="form-control input-lg"
                   id="dob">
            <br>
            <input type="text" name="user_phone" required
                   class="form-control input-lg" placeholder="Phone Number">
            <input type="text" name="user_city" required class="form-control input-lg"
                   placeholder="City">
            <input type="text" name="user_state" required
                   class="form-control input-lg" placeholder="State">
            <input type="text" name="user_country" required
                   class="form-control input-lg" placeholder="Country">
            <input type="email" name="user_email" placeholder="Email" required
                   class="form-control input-lg"/>
            <input type="text" name="user_username" required class="form-control input-lg"
                   placeholder="UserName" id="user_username">
            <input type="password" name="user_password" placeholder="Password" required
                   class="form-control input-lg"/>
            <input type="submit" name="submitbtn" class="btn btn-lg btn-primary btn-block" value="SignUp"
                   id="submitbtn"/>
            <div>
                <a href="index.php">Already Memeber ?</a>
            </div>
        </form>
        <!--<div class="form-links">
            <a href="#">www.website.com</a>
        </div>-->
    </section>
    <script
            src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
</body>
</html>