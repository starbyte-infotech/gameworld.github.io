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

$password = $fetch_user['password'];
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '1234117891111121';
$encryption_key = "Nothing";

$decrypt_pass = openssl_decrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

if(isset($_POST['update'])){

  $password = $_POST['pass'];
  $confirm_pass = $_POST['confirm_pass'];
  $old_pass = $_POST['old_pass'];
  if($old_pass == $decrypt_pass){
      if($password == $confirm_pass){

        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '1234117891111121';
        $encryption_key = "Nothing";
        $encrypt_pass = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

        $sql_edit = "UPDATE tbl_admin SET `password` = '$encrypt_pass' WHERE `id` = '$user_id'";
        $res_edit = mysqli_query($conn, $sql_edit);
        if($res_edit){
          echo "<script>alert('Your Password has been Changed.');</script>";
        }else{
          echo "<script>alert('Something Went Wrong !!');</script>";
        }

      }else{
        echo "<script>alert('Confirm Password not Matched !');</script>";
      }
  }else{
      echo "<script>alert('You have Enter Wrong Old Password !');</script>";
  }
    
}


?>
  <div class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Change Password</h5>
          </div>
          <div class="card-body">
            <form method="POST">
              <div class="row">
                <div class="col-md-8 pr-1">
                  <div class="form-group">
                    <label>Old Password</label>
                    <input type="password" class="form-control" placeholder="Old Password" name="old_pass">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 pr-1">
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="pass">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 pr-1">
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_pass">
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12 text-center">
                      <button type="submit" name="update" class="btn w-auto btn-primary btn-block" >Change Password</button>
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