<?php session_start(); ?>
<?php 
require_once("../config/config.php");
$con = new connection();
$display_query = "SELECT * FROM user";
$display_user = mysqli_query($con->mysqli,$display_query);

if(isset($_POST['update_profile']) && $_POST['update_profile']=='update_profile'){
  $user_firstname = mysqli_real_escape_string($con->mysqli,$_POST['user_firstname']);
  $user_lastname = mysqli_real_escape_string($con->mysqli,$_POST['user_lastname']);
  $user_gender = mysqli_real_escape_string($con->mysqli,$_POST['user_gender']);
  $user_age = mysqli_real_escape_string($con->mysqli,$_POST['user_age']);
  $user_dob = mysqli_real_escape_string($con->mysqli,$_POST['user_dob']);
  $user_phone = mysqli_real_escape_string($con->mysqli,$_POST['user_phone']);
  $user_city = mysqli_real_escape_string($con->mysqli,$_POST['user_city']);
  $user_state = mysqli_real_escape_string($con->mysqli,$_POST['user_state']);
  $user_country = mysqli_real_escape_string($con->mysqli,$_POST['user_country']);
  $user_email = mysqli_real_escape_string($con->mysqli,$_POST['user_email']);
  $user_username = mysqli_real_escape_string($con->mysqli,$_POST['user_username']);
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

}

?>
<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple App Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
                        <img src="assets/img/logo.png" />

                    </a>
                    
                </div>
              
                <span class="logout-spn" >
                  <a href="#" style="color:#fff;">LOGOUT</a>  

                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                 


                    <li class="active-link">
                        <a href="index.php" ><i class="fa fa-desktop "></i>Dashboard</a>
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
                 <button class="btn-primary btn-lg"><img src="assets/img/add_new_user.png" alt=""></button>
                  <hr />
                  <table class="table-condensed table-hover table-bordered table-striped ">
                    <th>CheckBox</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>DOB</th>
                    <th>Phone NO</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>User Type</th>
                    <th>Edit User </th>
                    <th>Delete User </th>
                  <?php 
                  while($rec = mysqli_fetch_assoc($display_user)){
                    echo "<tr>";

                    echo "<td>"; ?> <input type="checkbox" name="user_sel" class="checkbox" /><?php echo "</td>";
                    echo "<td>".$rec['user_firstname']."</td>";
                    echo "<td>".$rec['user_lastname']."</td>";
                    echo "<td>";
                    echo $rec['user_gender'] == 1 ? "Male" : "Female";
                    echo "</td>";

                    echo "<td>".$rec['user_age']."</td>";
                    echo "<td>".$rec['user_dob']."</td>";
                    echo "<td>".$rec['user_phone']."</td>";
                    echo "<td>".$rec['user_city']."</td>";
                    echo "<td>".$rec['user_state']."</td>";
                    echo "<td>".$rec['user_country']."</td>";
                    echo "<td>".$rec['user_email']."</td>";
                    echo "<td>".$rec['user_username']."</td>";
                    echo "<td>";
                    echo $rec['user_status'] == 1 ? "Active" : "InActive" ;
                    echo "</td>";
                    echo "<td>".$rec['user_type']."</td>";
                    echo "<td>";?>
                      <a href="#update_user_modal" data-toggle = "modal" data-id="<?php echo $rec['user_id']; ?>" id="update_user">
                      <button class="btn-warning btn-lg" id="btn-edit" value="<?php echo $rec['user_id'];?>">Edit</button></a><?php echo "</td>";
                    echo "<td>";?><button class="btn-danger btn-lg">Delete</button><?php echo "</td>";
                    echo "</tr>";
                  }
                  ?>
                  </table>
                 <!-- /. ROW  --> 
                    
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
              
                        <h2 class="h2" align="center">Update Profile</h2>
                        <h5>Firstname</h5>
                        <input type="text" name="user_firstname" id="user_firstname" placeholder="Firstname" required class="form-control input-lg">
                        <h5>Lastname</h5>
                        <input type="text" name="user_lastname" placeholder="LastName" required class="form-control input-lg">
                        <br>
                        
                        <h5>Gender</h5>
                      
         
                        <input type="radio" name="user_gender" value="1" id="gender_male"> Male
                        <input type="radio" name="user_gender" value="0" id="gender_female"> Female
                         
                        <h5>Age</h5>
                        <input type="number" name="user_age" placeholder="Age" required class="form-control input-lg">

                        <h5>Date Of Birth</h5>
                        <input type="date" name="user_dob" required class="form-control input-lg">

                        <h5>Phone Number</h5>
                        <input type="text" name="user_phone" required class="form-control input-lg" placeholder="Phone Number">

                        <h5>City</h5>
                        <input type="text" name="user_city" required class="form-control input-lg" placeholder="City">

                        <h5>State</h5>
                        <input type="text" name="user_state" required class="form-control input-lg" placeholder="State">

                        <h5>Country</h5>
                        <input type="text" name="user_country" required class="form-control input-lg" placeholder="Country">

                        <h5>Email</h5>
                        <input type="email" name="user_email" placeholder="Email" required class="form-control input-lg"/>

                        <h5>UserName</h5>
                        <input type="text" name="user_username" required class="form-control input-lg" placeholder="UserName">

                        <button type="submit" name="update_profile" class="btn btn-lg btn-primary btn-block" value="update_profile" id="btn-update">Update Profile</button>
                    </form>
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
                <div class="col-lg-12" >
                    &copy;  2017 rushik.com | Design by: <a href="#" style="color:#fff;">rushik</a>
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
