<?php session_start(); ?>
<?php
require_once("../config/config.php");
$con = new connection();
$display_query = "SELECT * FROM user";
$display_user = mysqli_query($con->mysqli, $display_query);
if ((isset($_SESSION['user_username'])) && (isset($_SESSION['usertype']))) {
    $q = "SELECT user_id FROM user WHERE user_username = '" . $_SESSION['user_username'] . "'";
    $query = mysqli_query($con->mysqli, $q);
    $arr = mysqli_fetch_assoc($query);
    $con->disable_id = $arr['user_id'];
} else {
    header("location:../login/index.php");
}

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
    $current_id = $_POST['user_id'];

    $con->user_update_profile(
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

    header("location:manage_user.php");

}
if (isset($_POST['insert_user']) && $_POST['insert_user'] == 'insert_user') {
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
    $user_password = mysqli_real_escape_string($con->mysqli, $_POST['user_password']);
    $user_type = mysqli_real_escape_string($con->mysqli, $_POST['user_type']);
    //$current_id = $_POST['user_id'];

    $con->add_user(
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
        $user_password,
        $user_type
    );

    if ($con->add_query) {
        echo $last_id = mysqli_insert_id($con->mysqli);
        //exit();

        if ($_FILES['file']['error'] > 0) {
            echo 'Error during uploading, try again';
        }
        $maxWidth = 300;
        $maxHeight = 300;

        list($width, $height) = getimagesize($_FILES['file']['tmp_name']);

        if ($width > $maxWidth || $height > $maxHeight) {
            // Cancel upload
            echo "<script type='text/javascript'> alert('file size Exceeds or Something Wrong') </script>";
        } else {
            //We won't use $_FILES['file']['type'] to check the file extension for security purpose

            //Set up valid image extensions
            $extsAllowed = array('jpg', 'jpeg', 'png', 'gif');

            //Extract extention from uploaded file
            //substr return ".jpg"
            //Strrchr return "jpg"

            $extUpload = strtolower(substr(strrchr($_FILES['file']['name'], '.'), 1));

            //Check if the uploaded file extension is allowed

            if (in_array($extUpload, $extsAllowed)) {

                //Upload the file on the server
                //$name = "http://".BASE_PATH."/user/uploads/profile/images/".$last_id."_profile_pic";
                $name = "../user/uploads/profile/images/" . $last_id . "_profile_" . $_FILES['file']['name'];
                $result = move_uploaded_file($_FILES["file"]["tmp_name"], $name);
                $image_name = $last_id . "_profile_" . $_FILES['file']['name'];
                if ($result) {

                    $path = str_replace('../', BASE_PATH, $name);
                    $query = "UPDATE user SET user_pic = '$path',img_name='$image_name' WHERE user_id=$last_id";
                    $q = mysqli_query($con->mysqli, $query);
                    if ($q) {
                        echo "<font class='text-success'>Image Uploaded sucessfully</font>";
                        echo "<script>alert('user inserted success</script>')";
                        header("location:manage_user.php");
                    } else {
                        echo mysqli_error($con->mysqli);
                    }
                }

            } else {
                echo 'File is not valid. Please try again';
            }

        }

    } else {
        echo '<script>alert("' . mysqli_error($con->mysqli) . "\")</script>";
        echo "<font class='text-danger>Something Wrong</font>'";
        //exit();
    }

}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Simple App Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet"/>
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet"/>
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
</head>
<body>


<div id="wrapper">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="adjust-nav">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="assets/img/logo.png"/>

                </a>

            </div>

            <span class="logout-spn">
                  <a href="logout.php" style="color:#fff;">LOGOUT</a>  

                </span>
        </div>
    </div>
    <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">


                <li class="active-link">
                    <a href="index.php"><i class="fa fa-desktop "></i>Dashboard</a>
                </li>

                <li>
                    <a href="manage_user.php"><i class="fa fa-qrcode "></i>Manage Users</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o"></i>My Link Two</a>
                </li>
            </ul>
        </div>

    </nav>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div id="page-inner">
            <div>
                <div class="col-lg-12">
                    <h2>ADMIN DASHBOARD</h2>
                </div>
            </div>

            <!-- /. ROW  -->
            <label>Add New User</label><br>
            <button class="btn-primary btn-lg"><img src="assets/img/add_new_user.png" alt="" data-toggle="modal"
                                                    data-target="#insert_user"></button>
            <hr/>
            <table class="table-striped table-bordered table-hover table-responsive">
                <th>Profile Pic</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>DOB</th>
                <th>Phone NO</th>
                <th>City</th>
                <th>Email</th>
                <th>Username</th>
                <th>Status</th>
                <th>User Type</th>
                <th>View User</th>
                <th>Edit User</th>
                <th>Delete User</th>
                <?php
                while ($rec = mysqli_fetch_assoc($display_user)) {
                    ?>

                    <tr class="row_"<?php echo $rec['user_id']; ?> >
                        <td><img src="../user/uploads/profile/images/<?php echo $rec['img_name']; ?>" height="42"
                                 width="42" alt=""></td>
                        <td class="<?php echo "row_" . $rec['user_id']; ?>"
                            name="user_fullname"><?php echo $rec['user_firstname'] . ' ' . $rec['user_lastname']; ?></td>
                        <td class="<?php echo "row_" . $rec['user_id']; ?>"
                            name="user_gender"><?php echo $rec['user_gender'] == 1 ? "Male" : "Female"; ?></td>
                        <td class="<?php echo "row_" . $rec['user_id']; ?>"
                            name="user_age"><?php echo $rec['user_age']; ?></td>
                        <td class="<?php echo "row_" . $rec['user_id']; ?>"
                            name="user_dob"><?php echo $rec['user_dob']; ?></td>
                        <td class="<?php echo "row_" . $rec['user_id']; ?>"
                            name="user_phone"><?php echo $rec['user_phone']; ?></td>
                        <td class="<?php echo "row_" . $rec['user_id']; ?>"
                            name="user_city"><?php echo $rec['user_city']; ?></td>
                        <td class="<?php echo "row_" . $rec['user_id']; ?>"
                            name="user_email"><?php echo $rec['user_email']; ?></td>
                        <td class="<?php echo "row_" . $rec['user_id']; ?>"
                            name="user_username"><?php echo $rec['user_username']; ?></td>
                        <td class="<?php echo "row_" . $rec['user_id']; ?>"
                            name="user_status"><?php echo $rec['user_status']; ?></td>
                        <td class="<?php echo "row_" . $rec['user_id']; ?>"
                            name="user_type"><?php echo $rec['user_type']; ?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#view_user_modal">
                                <button class="btn btn-default btn-view-user"
                                        value="<?php echo $rec["user_id"]; ?>"><img src="assets/img/view_user.png"
                                                                                    alt="View user" title="View User">
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#update_user_modal">
                                <button class="btn btn-success btn-edit" value="<?php echo $rec['user_id']; ?>"><img
                                            src="assets/img/edit_user.png" alt="Edit user" title="Edit User"></button>
                            </a>
                        </td>

                        <?php
                        if ($rec['user_id'] == $con->disable_id) {
                            ?>

                            <td>
                                <button class="btn btn-danger btn-delete" disabled title="Delete Disabled"
                                        value=<?php echo $rec['user_id']; ?>><img src="assets/img/delete_user.png"
                                                                                  alt="delete user" title="Delete User">
                                </button>
                            </td>
                            <?php
                        } else {
                            ?>
                            <td>
                                <button class="btn btn-danger btn_delete" value=<?php echo $rec['user_id']; ?>><img
                                            src="assets/img/delete_user.png" alt="Delete user" title="delete user">
                                </button>
                            </td>
                        <?php } ?>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <!-- /. ROW  -->
            <!-- modal edit user-->
            <!-- Modal -->
            <div id="update_user_modal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" id="modalContent">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">UPDATE USER</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="" role="login" enctype="multipart/form-data">
                                <input type="hidden" name="user_id">
                                <br>
                                <h2 class="h2" align="center">Update Profile</h2>
                                <h5>Firstname</h5>
                                <input type="text" name="user_firstname" id="user_firstname" placeholder="Firstname"
                                       required class="form-control input-lg">
                                <h5>Lastname</h5>
                                <input type="text" name="user_lastname" placeholder="LastName" required
                                       class="form-control input-lg">
                                <br>

                                <h5>Gender</h5>


                                <input type="radio" name="user_gender" value="1" id="gender_male"> Male
                                <input type="radio" name="user_gender" value="0" id="gender_female"> Female

                                <h5>Age</h5>
                                <input type="number" name="user_age" placeholder="Age" required
                                       class="form-control input-lg">

                                <h5>Date Of Birth</h5>
                                <input type="date" name="user_dob" required class="form-control input-lg">

                                <h5>Phone Number</h5>
                                <input type="text" name="user_phone" required class="form-control input-lg"
                                       placeholder="Phone Number">

                                <h5>City</h5>
                                <input type="text" name="user_city" required class="form-control input-lg"
                                       placeholder="City">

                                <h5>State</h5>
                                <input type="text" name="user_state" required class="form-control input-lg"
                                       placeholder="State">

                                <h5>Country</h5>
                                <input type="text" name="user_country" required class="form-control input-lg"
                                       placeholder="Country">

                                <h5>Email</h5>
                                <input type="email" name="user_email" placeholder="Email" required
                                       class="form-control input-lg"/>

                                <h5>UserName</h5>
                                <input type="text" name="user_username" required class="form-control input-lg"
                                       placeholder="UserName">

                                <button type="submit" name="update_profile" class="btn btn-lg btn-primary btn-block"
                                        value="update_profile" id="btn_update" data-id="<?php echo $rec['user_id']; ?>">
                                    Update Profile
                                </button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- modal add new user-->
            <!-- Modal -->
            <div id="insert_user" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" id="modalContent">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">ADD NEW USER</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="" role="login" enctype="multipart/form-data">
                                <input type="hidden" name="user_id">
                                <label for="file"> Upload Profile(max size : (160x160)) : </label><br>
                                <input type="file" name="file">
                                <h5>Firstname</h5>
                                <input type="text" name="user_firstname" id="user_firstname" placeholder="Firstname"
                                       required class="form-control input-lg">
                                <h5>Lastname</h5>
                                <input type="text" name="user_lastname" placeholder="LastName" required
                                       class="form-control input-lg">
                                <br>

                                <h5>Gender</h5>


                                <input type="radio" name="user_gender" value="1" id="gender_male"> Male
                                <input type="radio" name="user_gender" value="0" id="gender_female"> Female

                                <h5>Age</h5>
                                <input type="number" name="user_age" placeholder="Age" required
                                       class="form-control input-lg">

                                <h5>Date Of Birth</h5>
                                <input type="date" name="user_dob" required class="form-control input-lg">

                                <h5>Phone Number</h5>
                                <input type="text" name="user_phone" required class="form-control input-lg"
                                       placeholder="Phone Number">

                                <h5>City</h5>
                                <input type="text" name="user_city" required class="form-control input-lg"
                                       placeholder="City">

                                <h5>State</h5>
                                <input type="text" name="user_state" required class="form-control input-lg"
                                       placeholder="State">

                                <h5>Country</h5>
                                <input type="text" name="user_country" required class="form-control input-lg"
                                       placeholder="Country">

                                <h5>Email</h5>
                                <input type="email" name="user_email" placeholder="Email" required
                                       class="form-control input-lg"/>

                                <h5>UserName</h5>
                                <input type="text" name="user_username" required class="form-control input-lg"
                                       placeholder="UserName">

                                <h5>Password</h5>
                                <input type="text" name="user_password" required class="form-control input-lg"
                                       placeholder="password">

                                <select name="user_type">
                                    <option value="admin" class="form-control input-lg">admin</option>
                                    <option value="subscriber" selected="selected" class="form-control input-lg">
                                        subscriber
                                    </option>
                                </select>

                                <button type="submit" name="insert_user" class="btn btn-lg btn-primary btn-block"
                                        value="insert_user" id="btn_insert" data-id="<?php echo $rec['user_id']; ?>">Add
                                    User
                                </button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- modal view user-->

            <div id="view_user_modal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" id="modalContent">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">UPDATE USER</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-bordered view-user">
                                <th>Title</th>
                                <th>Description</th>
                                <tr>
                                    <td>Profile pic</td>
                                    <td name="user_pic"></td>
                                </tr>
                                <tr>
                                    <td>Firstname</td>
                                    <td name="user_firstname"></td>
                                </tr>
                                <tr>
                                    <td>LastName</td>
                                    <td name="user_lastname"></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td name="user_gender"></td>
                                </tr>
                                <tr>
                                    <td>Age</td>
                                    <td name="user_age"></td>
                                </tr>
                                <tr>
                                    <td>DOB</td>
                                    <td name="user_dob"></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td name="user_phone"></td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td name="user_city"></td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td name="user_state"></td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td name="user_country"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td name="user_email"></td>
                                </tr>
                                <tr>
                                    <td>UserName</td>
                                    <td name="user_country"></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td name="user_username"></td>
                                </tr>
                                <tr>
                                    <td>User Type</td>
                                    <td name="user_type"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>


            <!-- /. PAGE WRAPPER  -->
        </div>
    </div>
    <div class="footer">


        <div class="row">
            <div class="col-lg-12">
                &copy; 2017 rushik.com | Design by: <a href="#" style="color:#fff;">rushik</a>
            </div>
        </div>
    </div>


    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
