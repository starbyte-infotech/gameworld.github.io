
<?php 
session_start();
include("config.php");

if(isset($_POST['login'])){
   $email = $_POST['email'];
   $password = $_POST['password'];

    // $error = 0;

    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '1234117891111121';
    $encryption_key = "Nothing";
    $encrypt_pass = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

    $chk_user = "SELECT * FROM `tbl_user` WHERE `email` = '$email' AND `password` = '$encrypt_pass'";  
    $res_chk_user = mysqli_query($conn, $chk_user);
    $row_count = mysqli_num_rows($res_chk_user);
    if($row_count == 1){
        
        $_SESSION['email']=$email;
        header("Location: index.php");

    }else{
        echo "<script>alert('You are not Registred with us !!')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/image/favicon2.png" type="image/gif" sizes="16x16">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <title>Login</title>
</head>

<body>

    <!------------------------------- Section Start ----------------------->
    <div class="container mt-65 bg-white">
        <div class="row p-xl-5 p-3">
           
            <div class="col-12 text-center contact-text">Login</div>
            <div class="col-lg-12 col-xxl-6 mx-auto">
                <div class="card box-shadow border-radius">
                    
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group mb-4">
                                <label class="mb-2" for="exampleFormControlSelect1">Enter Email</label>
                                <input class="form-control" type="text" name="email" />
                            </div>
                            <div class="form-group mb-4">
                                <label class="mb-2" for="exampleFormControlSelect1">Enter Password</label>
                                <input class="form-control" type="password" name="password" />
                            </div>
                            <div class="form-group my-5 text-center">                               
                                    <button type="submit" class="submit-btn" name="login">Submit</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <center><a href="register.php"><b><p>Registration</p></b></a></center>
        </div>      
    </div>


    <!-------------------- Footer End -------------------------->
    <script src="assets/js/nav.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
    <!-- <script src="assets/js/bootstrap.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js
"></script>
</body>


</html>