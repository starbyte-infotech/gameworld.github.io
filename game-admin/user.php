<?php 
session_start();
include("header.php");
include("config.php");
if(!isset($_SESSION['userlogin'])){
    header("location:login.php");
}
$login_email = $_SESSION['userlogin'];
$sel_user = "SELECT * FROM `tbl_admin` WHERE `email` = '$login_email'";
$res_user = mysqli_query($conn, $sel_user);
$fetch_user = mysqli_fetch_assoc($res_user);
$user_id = $fetch_user['id'];
$user_profile = $fetch_user['profile'];

if(isset($_POST['update'])){

  $company = $_POST['company'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $country = $_POST['country'];
  $postal_code = $_POST['postal_code'];
  $about = $_POST['about'];

  $profile = $_FILES["img"]["name"];
  $profile_temp = $_FILES["img"]["tmp_name"];   
  $folder = "images/".$profile;

  
  $sql = "UPDATE tbl_admin SET `first_name`='$first_name', `last_name`='$last_name',`email`='$email' ,`address`='$address',`city`='$city',`country`='$country',`postal_code`='$postal_code', `about`='$about',`company`='$company',`profile` ='$profile', `created_at` = current_timestamp() WHERE `id`= '$user_id'"; 

  $res = mysqli_query($conn, $sql);  
  if($res){
      // $msg = 1;
      echo '<script>alert("Profile Updated")</script>';
      header("Location: user.php");
  }else{
      // $msg = 0;
      echo '<script>alert("Failed to Update Profile!!")</script>';
  }
  if(!empty($profile)){
    
      $file = 'images/'.$user_profile; 
      unlink($file);
    
    if (move_uploaded_file($profile_temp, $folder))  {
      echo "<script>alert('Image Updated');</script>";
    }else{
       echo "<script>alert('Failed to update image!');</script>";
    }
  }
}

?>
  <div class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Edit Profile</h5>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-5 pr-1">
                  <div class="form-group">
                    <label>Company</label>
                    <input type="text" class="form-control" placeholder="Company" name="company" value="<?php echo $fetch_user['company'] ?>">
                  </div>
                </div>
                <div class="col-md-3 px-1">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $fetch_user['username'] ?>" disabled>
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $fetch_user['email'] ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="First Name" name="first_name" value="<?php echo $fetch_user['first_name'] ?>">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo $fetch_user['last_name'] ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Home Address" name="address" value="<?php echo $fetch_user['address'] ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control" placeholder="City" name="city" value="<?php echo $fetch_user['city'] ?>">
                  </div>
                </div>
                <div class="col-md-4 px-1">
                  <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control" placeholder="Country" name="country" value="<?php echo $fetch_user['country'] ?>">
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label>Postal Code</label>
                    <input type="number" class="form-control" placeholder="ZIP Code" name="postal_code" value="<?php echo $fetch_user['postal_code'] ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>About Me</label>
                    <textarea rows="4" cols="80" class="form-control" name="about" placeholder="Here can be your description"
                      value="Mike"><?php echo $fetch_user['about'] ?></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="form-group">
                        <label>Upload User Profile</label>
                        <input type="file" id="img" name="img" >
                        <input type="text" class="form-control" placeholder="Profile"
                            value="SELECT PHOTO">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12 text-center">
                      <button type="submit" name="update" class="btn w-auto btn-primary btn-block" >Update</button>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-user">
          <div class="image">
            <img src="assets/img/bg5.jpg" alt="...">
          </div>
          <div class="card-body">
            <div class="author">
              <a href="#">
                <img class="avatar border-gray" src="<?php echo $dir.'/images/'.$fetch_user['profile'] ?>" alt="...">
                <h5 class="title"><?php echo $fetch_user['first_name'].' '.$fetch_user['last_name'] ?></h5>
              </a>
              <p class="description">
                <?php echo $fetch_user['username'] ?>
              </p>
            </div>
            <p class="description text-center">
              "<?php echo $fetch_user['about'] ?> "
            </p>
          </div>
          <hr>
          <div class="button-container">
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
              <i class="fab fa-facebook-f"></i>
            </button>
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
              <i class="fab fa-twitter"></i>
            </button>
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
              <i class="fab fa-google-plus-g"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include("footer.php"); ?>