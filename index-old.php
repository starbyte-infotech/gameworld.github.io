<?php 
session_start();
include("config.php");
$loign_user_id = '';
if(isset($_SESSION['email'])){
    $login_user_email = $_SESSION['email'];
    $sel_user = "SELECT * FROM `tbl_user` WHERE email = '$login_user_email'";
    $res_user = mysqli_query($conn, $sel_user);
    $fetch_user = mysqli_fetch_assoc($res_user);
    $loign_user_id = $fetch_user['id']; 
}

// if(isset($_GET['search'])){
//     $search=$_GET['search']; 
// }

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

// $login_user_email = $_SESSION['email'];
// $sel_user = "SELECT * FROM `tbl_user` WHERE email = '$login_user_email'";
// $res_user = mysqli_query($conn, $sel_user);
// $fetch_user = mysqli_fetch_assoc($res_user);
// $loign_user_id = $fetch_user['id']; 

$sel_category = "SELECT * FROM `tbl_category`";
$res_category = mysqli_query($conn, $sel_category);
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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/custom_style.css">
    <title>Game World</title>
    <style>
       
        .text-center {
            text-align: center;
        }

        .font-size-24 {
            font-size: 24px;
            color: #fff;
        }

        .header {
            width: 100%;
            padding: 45px 15px;
            background: #ee6664;
            text-align: center;
        }

        .banner1 {
            width: 100%;
            padding: 45px 15px;
            text-align: center;
            background: #f86ca4;
        }

        .mainContent {
            width: 100%;
            position: relative;
        }

        .sidebar {

            height: auto;
            padding: 45px 0;
        }

        .sidebar.fixed {
            position: sticky;
            top: 0;
        }

        .content {

            height: auto;
            padding: 45px 0;
        }

        .footer {
            clear: both;
        }

        * {
            box-sizing: border-box;
        }


        .search-icon {

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-icon input[type=text] {
            position: relative;
            padding: 10px 40px 10px 20px;
            width: 20px;
            color: #525252;
            text-transform: uppercase;
            font-size: 16px;
            font-weight: 100;
            letter-spacing: 2px;
            border: none;
            border-radius: 5px;
            background: linear-gradient(to right, #FFFFFF 0%, #464747 #F9F9F9 100%);
            transition: width 0.4s ease;
            outline: none;
        }

        .search-icon input[type=text]:focus {
            width: 250px;
        }

        .search-icon i {
            position: relative;
            left: -37px;
            color: #557a95;
        }
        .search-icon span i {
            left: 0;
            color: #557a95;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-custom navbar-mainbg fixed-top">
        <a class="navbar-brand navbar-logo d-promax" href="#"><img src="assets/image/000.png" alt=""></a>
        <a class="navbar-brand navbar-logo d-problock mx-auto" href="#"><img style="height: 35px;"
                src="assets/image/000.png" alt=""></a>
        <button class="navbar-toggler d-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="side_menu d-problock">
            <div class="burger_box">
                <div class="menu-icon-container">
                    <a href="#" class="menu-icon js-menu_toggle closed">
                        <span class="menu-icon_box">
                            <span class="menu-icon_line menu-icon_line--1"></span>
                            <span class="menu-icon_line menu-icon_line--2"></span>
                            <span class="menu-icon_line menu-icon_line--3"></span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="container">
                <ul class="list_load">
                    <li class="list_item"> <a class="nav-link" href="#"><i class="fas fa-gamepad"></i>Home</a></li>
                    <?php 
                            $sel_cat = "SELECT * FROM `tbl_category`";
                            $res_cat = mysqli_query($conn, $sel_cat);
                            while($cat_info = mysqli_fetch_array($res_cat)){ 
                                
                        ?>
                     <li class="list_item"><a class="nav-link" href="#<?php echo $cat_info['name'] ?>"><i class="<?php echo $cat_info['png'] ?>"></i><?php echo $cat_info['name'] ?></a>
                    </li>
                    <?php
                            }
                    ?>
                    <li class="list_item"> <a class="nav-link" href="#;"><input class="search-input text-white pl-0"
                                style="padding-left: 0;" type="text" placeholder="Search"></a></li>

                    <div class="b-bo p-0"></div>
                    <li class="list_item"><a class="nav-link" href="favourite.html"><i class="fas fa-heart"></i>My
                            Favourites</a></li>
                 
                  
                    <div class="b-bo"></div>
                      <li class="list_item"><a class="nav-link" href="favourite.html" data-toggle="modal" data-target="#myModal0" data-whatever="@mdo"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                      <li class="list_item"><a class="nav-link" href="favourite.html"><i class="fas fa-sign-in-alt"></i> Logout</a></li>
                </ul>
                <div class="spacer_box">
                    <p>This is a spacer box.</p>
                </div>
            </div>
        </div>
        
     
        
        
        <div class="search-icon ms-auto d-promax">
            <input placeholder='Search...' class='js-search' type="text" name="search_box" id="search_box">
            <i class="fas fa-search"></i>
            <a type="button" class="button-login" data-toggle="modal" data-target="#myModal0" data-whatever="@mdo">Login</a>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span> <i class="fas fa-user"></i></span>    username
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Logout</a>
              </div>
            </div>
        </div>  
        
        
        

      
    </nav>
    <!-- search result block -->
    <div class="search-outer-block">
        
    </div>
    <!-- ------------------ -->
    <div class="container mt-65">
        <div class="row">
            <div class="col-12">
                <div class="action-sec fix-padding-y pb-0">
                        <div class="row m-0">
                            <div class="col-12 text-left">
                                <span class="category-text"><i class="fas fa-fire"></i>Trending Games <span
                                        class="sub-lable">12 games</span></span>
                            </div>

                            <div class="owl-carousel owl-theme">
                                <?php 
                                $trending_games = "SELECT * FROM `tbl_games` ORDER BY RAND() LIMIT 12";
                                $res_trending = mysqli_query($conn, $trending_games);
                                while($fetch_trend = mysqli_fetch_array($res_trending)){ 
                                    $fav_game_active = 'no-active';
                                    $trend_id = $fetch_trend['id']; 
                                    if($loign_user_id){
                                        $sql_fav_trend = "SELECT * FROM `tbl_favourites` WHERE `game_id` = '$trend_id' AND `user_id` = '$loign_user_id'";
                                        $res_fav_trend = mysqli_query($conn, $sql_fav_trend);
                                        $row1 = mysqli_num_rows($res_fav_trend);
                                        if($row1 == 1){ $fav_game_active = 'fav_active'; }
                                    }
                                ?>
                                <div class="item game-<?php echo $trend_id ?>">
                                    <a href="<?php echo $dir.'/games/'.$fetch_trend['game_code'] ?>" target="_blank">
                                        <div class="col-12 p-3">
                                            <div class="game-img">
                                                <img class="pic" src="<?php echo $dir.'/images/'.$fetch_trend['image'] ?>" alt="" height="160" >
                                            <?php if($loign_user_id != ''){ ?>
                                                <a onclick="add_to_favourites(<?php echo $fetch_trend['id'] ?>,<?php echo $loign_user_id ?>)"><div class="fav-icon <?php echo $fav_game_active ?>"><span class="fav"><i style="margin-right: 0;" class="fas fa-heart"></i></span></div></a>
                                            <?php }else{ ?>
                                                <a href="#" data-toggle="modal" data-target="#myModal"><div class="fav-icon <?php echo $fav_game_active ?>"><span class="fav"><i style="margin-right: 0;" class="fas fa-heart"></i></span></div></a>
                                            <?php } ?>
                                                <div class="overlay"></div>
                                                <div class="game-description  bg-green" style="background: <?php echo $fetch_trend['bottom_color'] ?> !important">
                                                    <div class="game-name"><?php echo $fetch_trend['name'] ?></div>
                                                    <div class="game-plays"> <?php echo $fetch_trend['plays'] ?> Plays</div>
                                                </div>
                                            </div>

                                        </div>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
        

            <!------------------------------ game of the week section --------------------------------->

            <div class="col-12 my-4">
                <div class="new-game-sec row m-0">
                    <div class="col-lg-4 col-md-6">
                        <div class="newly-text">
                            newly added
                        </div>
                        <div class="b-b mt-3"></div>
                        <div class="game-area box-shadow my-3">
                            <?php 
                            $get_game_desc = "SELECT * FROM tbl_games ORDER BY id DESC LIMIT 4";
                            $res_game_desc = mysqli_query($conn, $get_game_desc);
                            $i=1;
                            while($fetch_desc_game = mysqli_fetch_array($res_game_desc))
                            {
                                if($i==1)
                                {
                                ?>
                            <div class="row m-0">
                                <div class="col-3">
                                    <div class="game-img">
                                        <img class="br-6" src="<?php echo $dir.'/images/'.$fetch_desc_game['image']?>" alt="">
                                    </div>
                                </div>
                                <div class="col-5 p-0">
                                    <div class="text-1"><?php echo $fetch_desc_game['name']?></div>
                                    <div class="text-2">Rating</div>
                                    <div class="text-2"><?php echo $fetch_desc_game['plays']?> plays</div>
                                </div>
                                <div class="col-4 text-end mt-2">
                                <a target="_blank" href="<?php echo $dir.'/games/'.$fetch_desc_game['game_code']?>"><button class="play-btn">play</button></a>
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="row m-0 mt-4">
                                <div class="col-3">
                                    <div class="game-img">
                                        <img class="br-6" src="<?php echo $dir.'/images/'.$fetch_desc_game['image']?>" alt="">
                                    </div>
                                </div>
                                <div class="col-5 p-0">
                                    <div class="text-1"><?php echo $fetch_desc_game['name']?></div>
                                    <div class="text-2">Rating</div>
                                    <div class="text-2"><?php echo $fetch_desc_game['plays']?> plays</div>
                                </div>
                                <div class="col-4 text-end mt-2">
                                    <button class="play-btn">play</button>
                                </div>
                            </div>
                            <?php  }
                                $i++;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="newly-text">game of the week</div>
                        <div class="b-b mt-3"></div>
                        <div class="game-area my-3 box-shadow">
                            <div class="row m-0">
                                <div class="col-12">
                                    <div class="game-img">
                                        <img class="br-6" src="assets/image/bg-1.png" alt="">
                                    </div>
                                </div>

                                <div class="col-4 ">
                                    <div class="game-img">
                                        <img class="br-6 game-og-week-img" src="assets/image/i-2.png" alt="">
                                    </div>
                                </div>
                                <div class="col-1 p-0"></div>
                                <div class="col-6 p-0 mt-2">
                                    <div class="text-1">dead end</div>
                                    <div class="text-2">Rating</div>
                                    <div class="text-2">70M plays</div>
                                </div>
                                <div class="col-12  mt-4 mb-3">
                                    <button class="game-of-week-play-btn">play</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="newly-text">
                            most played
                        </div>
                        <div class="b-b mt-3"></div>
                        <div class="game-area box-shadow my-3">
                        <?php 
                            $qry_most_play = "SELECT * FROM `tbl_games` ORDER BY RAND() LIMIT 4";
                            $res_most_play = mysqli_query($conn, $qry_most_play);
                            $i=1;
                            while($fetch_most_play = mysqli_fetch_array($res_most_play)){ 
                                if($i==1){ ?>
                            <div class="row m-0">
                                <div class="col-3">
                                    <div class="game-img">
                                        <img class="br-6" height="50px" src="<?php echo $dir.'/images/'.$fetch_most_play['image'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-5 p-0">
                                    <div class="text-1"><?php echo $fetch_most_play['name'] ?></div>
                                    <div class="text-2">Rating</div>
                                    <div class="text-2"><?php echo $fetch_most_play['plays'] ?> plays</div>
                                </div>
                                <div class="col-4 text-end mt-2">
                                <a target="_blank" href="<?php echo $dir.'/games/'.$fetch_most_play['game_code'] ?>"><button class="play-btn">play</button></a>
                                </div>
                            </div>
                            <?php  }else{ ?>
                            <div class="row m-0 mt-4">
                                <div class="col-3">
                                    <div class="game-img">
                                        <img class="br-6" height="50px" src="<?php echo $dir.'/images/'.$fetch_most_play['image'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-5 p-0">
                                    <div class="text-1"><?php echo $fetch_most_play['name'] ?></div>
                                    <div class="text-2">Rating</div>
                                    <div class="text-2"><?php echo $fetch_most_play['plays'] ?> plays</div>
                                </div>
                                <div class="col-4 text-end mt-2">
                                    <button class="play-btn">play</button>
                                </div>
                            </div>
                            <?php  }
                                $i++;
                            } ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="newly-text"> newly added</div>
                        <div class="b-b mt-3"></div>
                        <div class="game-area box-shadow my-3">
                            <?php 
                            $get_game_desc = "SELECT * FROM tbl_games ORDER BY id DESC LIMIT 4,4";
                            $res_game_desc = mysqli_query($conn, $get_game_desc);
                            $i=1;
                            while($fetch_desc_game = mysqli_fetch_array($res_game_desc)){
                                if($i==1){ ?>
                            <div class="row m-0">
                                <div class="col-3">
                                    <div class="game-img">
                                        <img class="br-6" src="<?php echo $dir.'/images/'.$fetch_desc_game['image']?>" alt="">
                                    </div>
                                </div>
                                <div class="col-5 p-0">
                                    <div class="text-1"><?php echo $fetch_desc_game['name']?></div>
                                    <div class="text-2">Rating</div>
                                    <div class="text-2"><?php echo $fetch_desc_game['plays']?> plays</div>
                                </div>
                                <div class="col-4 text-end mt-2">
                                <a target="_blank" href="<?php echo $dir.'/games/'.$fetch_desc_game['game_code']?>"><button class="play-btn">play</button></a>
                                </div>
                            </div>
                            <?php  } else{ ?>
                            <div class="row m-0 mt-4">
                                <div class="col-3">
                                    <div class="game-img">
                                        <img class="br-6" src="<?php echo $dir.'/images/'.$fetch_desc_game['image']?>" alt="">
                                    </div>
                                </div>
                                <div class="col-5 p-0">
                                    <div class="text-1"><?php echo $fetch_desc_game['name']?></div>
                                    <div class="text-2">Rating</div>
                                    <div class="text-2"><?php echo $fetch_desc_game['plays']?> plays</div>
                                </div>
                                <div class="col-4 text-end mt-2">
                                    <button class="play-btn">play</button>
                                </div>
                            </div>
                            <?php } $i++; } ?>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                            <div class="newly-text">game of the Month</div>
                            <div class="b-b mt-3"></div>
                            <div class="game-area my-3 box-shadow">
                                <div class="row m-0">
                                    <div class="col-12">
                                        <div class="game-img">
                                            <img class="br-6" src="assets/image/15852.jpg" alt="">
                                        </div>
                                    </div>

                                    <div class="col-4 ">
                                        <div class="game-img">
                                            <img class="br-6 game-og-week-img" src="assets/image/100.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-1 p-0"></div>
                                    <div class="col-6 p-0 mt-2">
                                        <div class="text-11">Street Car Racing </div>
                                        <div class="text-22">Rating</div>
                                        <div class="text-22">70M plays</div>
                                    </div>
                                    <div class="col-12  mt-4 mb-3">
                                        <button class="game-of-week-play-btn">play</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
            <div class="col-3 d-none d-md-block">
                <div class="sidebar">
                    <div class="card box-shadow p-4">
                        <div class="cat-text">Categories</div>
                        <?php 
                            $sel_cat = "SELECT * FROM `tbl_category`";
                            $res_cat = mysqli_query($conn, $sel_cat);
                            $i=1;
                            while($cat_info = mysqli_fetch_array($res_cat)){ 
                                if($i==1){ ?>
                        <div class="mt-3 mb-2"> <button class="cat-btn" onclick="location.href='#<?php echo $cat_info['name'] ?>';">
                            <i class="<?php echo $cat_info['png'] ?>"></i><?php echo $cat_info['name'] ?></button>
                        </div>
                        <?php }else{  ?>
                        <div class="my-2"><button class="cat-btn" onclick="location.href='#<?php echo $cat_info['name'] ?>';">
                            <i class="<?php echo $cat_info['png'] ?>"></i><?php echo $cat_info['name'] ?></button>
                        </div>
                        <?php
                                }
                                $i++;
                            }
                        ?>
                        <div class="my-2"><button class="cat-btn" onclick="location.href='#favourite';"><i class="fas fa-heart"></i>My favourite</button></div> 
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="content">
                    <?php 
                    $sel_cat = "SELECT * FROM `tbl_category` ORDER BY id LIMIT 2";
                    $res_cat = mysqli_query($conn, $sel_cat);
                    while($cat_info = mysqli_fetch_array($res_cat)){
                        $category_id = $cat_info['id'];
                        $sel_game = "SELECT * FROM `tbl_games` WHERE `category` ='$category_id' ";
                        $res_game = mysqli_query($conn, $sel_game);
                        $num = mysqli_num_rows($res_game);
                    ?>
                        <div class="games-sec" id="<?php echo $cat_info['name'] ?>">
                            <div class="card box-shadow p-4">
                                <div class="row m-0">
                                    <div class="col-md-7 col-12">
                                        <span class="category-text"><i class="<?php echo $cat_info['png'] ?>"></i><?php echo $cat_info['name'] ?> <span
                                                class="sub-lable"><?php echo $num; ?>  games</span></span>
                                    </div>

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <div class="row">   
                                            <?php                                       
                                                while($game_info = mysqli_fetch_array($res_game)){  
                                                    $fav_game_active = 'no-active';
                                                    $gm_id = $game_info['id'];

                                                    if($loign_user_id){
                                                        $sql_fav = "SELECT * FROM `tbl_favourites` WHERE `game_id` = '$gm_id' AND `user_id` = '$loign_user_id'";
                                                        $res_fav = mysqli_query($conn, $sql_fav);
                                                        $row2 = mysqli_num_rows($res_fav);
                                                        if($row2 == 1){ $fav_game_active = 'fav_active'; }
                                                    }
                                                ?>
                                                <div class="col-lg-3 col-md-4 col-6 p-3 game-<?php echo $gm_id ?>">
                                                    <a href="">
                                                        <div class="game-img">
                                                            <img src="<?php echo $dir.'/images/'.$game_info['image'] ?>" alt="" height="160">
                                                        <?php if($loign_user_id != ''){ ?>
                                                            <a onclick="add_to_favourites(<?php echo $game_info['id'] ?>,<?php echo $loign_user_id ?>)"><div class="fav-icon <?php echo $fav_game_active ?>"><span class="fav"><i style="margin-right: 0;" class="fas fa-heart"></i></span></div></a>
                                                        <?php }else{ ?>
                                                            <a href="#" data-toggle="modal" data-target="#myModal"><div class="fav-icon <?php echo $fav_game_active ?>"><span class="fav"><i style="margin-right: 0;" class="fas fa-heart"></i></span></div></a>
                                                        <?php } ?>
                                                            <div class="overlay"></div>
                                                            <div class="game-description  bg-green" style="background: <?php echo $game_info['bottom_color'] ?>!important; ">
                                                                <div class="game-name"><?php echo $game_info['name'] ?></div>
                                                                <div class="game-plays"><?php echo $game_info['plays'] ?> Plays</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="col-12 d-block d-md-none w-auto mx-auto mt-3">
                                        <ul class="nav col nav-tabs ms-auto w-fit" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                                    aria-selected="true">1</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                    data-bs-target="#profile" type="button" role="tab"
                                                    aria-controls="profile" aria-selected="false">2</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                                    data-bs-target="#contact" type="button" role="tab"
                                                    aria-controls="contact" aria-selected="false">3</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    
                    <!------------------------- Favourite category section ----------------------->

                    <div class="games-sec" id="favourite">
                    <?php
                        $fav_limit = 4;
                        $query_fav="SELECT COUNT(id) FROM `tbl_favourites` WHERE `user_id` = '$loign_user_id'";
                        $rs_result = mysqli_query($conn, $query_fav);  
                        $row = mysqli_fetch_row($rs_result);  
                        $total_records = $row[0];  
                        $total_pages = ceil($total_records / $fav_limit);

                        $query_fav="SELECT * FROM `tbl_favourites` WHERE `user_id` = '$loign_user_id' ORDER BY id DESC";    
                        $result_fav = mysqli_query($conn, $query_fav);
                        $rows_fav = mysqli_num_rows($result_fav); 
                    ?>
                        <div class="card box-shadow p-4">
                            <div class="row m-0">
                                <div class="col-md-7 col-12">
                                    <span class="category-text"><i class="fas fa-heart"></i>My Favourites <span class="sub-lable"><?php echo $rows_fav ?> games</span></span>
                                </div>                                
                                <?php 
                                    if($rows_fav == 0){ ?>

                                        <div class="tab-content nofav_msg_block text-center mt-5" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home111" role="tabpanel"
                                                aria-labelledby="home-tab111">
                                                <div class="row">
                                                    <h3 class="category-text fav_msg">You haven't favorited any games yet. Favorite the games you love and find them here easily anytime!</h3>
                                                </div>
                                            </div>
                                        </div>
                                        
                                <?php }else{ ?>
                                <div class="col-5 ms-auto d-none d-md-block clearfix">
                                    <ul class="pagination nav col nav-tabs ms-auto w-fit" id="myTab" role="tablist">
                                    <?php 
                                    if(!empty($total_pages)){
                                        for($i=1; $i<=$total_pages; $i++){
                                            if($i == 1){ ?>
                                            <li class="pageitem nav-item active" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" data-id="<?php echo $i;?>" class="page-link nav-link" ><?php echo $i;?></a></li>
                                                                        
                                            <?php  }
                                            else{ ?>
                                            <li class="pageitem nav-item" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" class="page-link nav-link" data-id="<?php echo $i;?>"><?php echo $i;?></a></li>
                                        <?php }
                                        }
                                    }   ?>
                                    </ul>
                                </div>
                                <div id="target-content">loading...</div>
                                <!-- <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home111" role="tabpanel"
                                        aria-labelledby="home-tab111">
                                        <div class="row">
                                        <?php while($fetch_fav = mysqli_fetch_array($result_fav)) { 
                                            $game_ID = $fetch_fav['game_id'];
                                            $fav_games = "SELECT * FROM `tbl_games` WHERE `id` = '$game_ID'";
                                            $fav_res = mysqli_query($conn, $fav_games);
                                            $get_fav = mysqli_fetch_assoc($fav_res);
                                        ?>
                                            <div class="col-lg-3 col-md-4 col-6 p-3">
                                                <a href="tower_game-master/index.html">
                                                    <div class="game-img">
                                                        <img src="<?php echo $dir.'/images/'.$get_fav['image'] ?>" alt="">
                                                        <div class="overlay"></div>
                                                        <div class="game-description bg-blue" style="background: <?php echo $get_fav['bottom_color'] ?>!important; ">
                                                            <div class="game-name"> <?php echo $get_fav['name'] ?></div>
                                                            <div class="game-plays"> <?php echo $get_fav['plays'] ?> Plays</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div> -->
                                <?php } ?>
                                <div class="col-12 d-block d-md-none w-auto mx-auto mt-3">
                                    <ul class="nav col nav-tabs ms-auto w-fit" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab111" data-bs-toggle="tab"
                                                data-bs-target="#home111" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">1</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab111" data-bs-toggle="tab"
                                                data-bs-target="#profile111" type="button" role="tab"
                                                aria-controls="profile" aria-selected="false">2</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="contact-tab111" data-bs-toggle="tab"
                                                data-bs-target="#contact111" type="button" role="tab"
                                                aria-controls="contact" aria-selected="false">3</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!----------------------------- Arcade category section ---------------------------->
                    <?php 
                    $sql_cat_med = "SELECT * FROM tbl_category LIMIT 2 OFFSET 2";
                    $res_cat_med = mysqli_query($conn, $sql_cat_med);
                    while($get_med_cat = mysqli_fetch_array($res_cat_med)){ 
                        $category_id = $get_med_cat['id'];
                        $cat_med_games = "SELECT * FROM tbl_games WHERE category = '$category_id'";
                        $res_med_games = mysqli_query($conn, $cat_med_games); 
                        $med_count = mysqli_num_rows($res_med_games);
                    ?>
                    <div class="games-sec fix-padding-y" id="<?php echo $get_med_cat['name'] ?>">
                        <div class="card box-shadow p-4">
                            <div class="row m-0">
                                <div class="col-md-7 col-12">
                                    <span class="category-text"><i class="fas fa-ghost"></i><?php echo $get_med_cat['name'] ?> <span class="sub-lable"><?php echo $med_count ?>  games</span></span>
                                </div>
                                <div class="col-5 ms-auto d-none d-md-block">
                                    <ul class="nav col nav-tabs ms-auto w-fit" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab2" data-bs-toggle="tab"
                                                data-bs-target="#home2" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">1</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab2" data-bs-toggle="tab"
                                                data-bs-target="#profile2" type="button" role="tab"
                                                aria-controls="profile" aria-selected="false">2</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="contact-tab2" data-bs-toggle="tab"
                                                data-bs-target="#contact2" type="button" role="tab"
                                                aria-controls="contact" aria-selected="false">3</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                        aria-labelledby="home-tab2">
                                        <div class="row"> 
                                        <?php while($fetch_med_game = mysqli_fetch_array($res_med_games)){ 
                                            $fav_game_active = 'no-active';
                                            $gm_id = $fetch_med_game['id'];
                                            $gm_cat = $fetch_med_game['category']; 
                                            if($loign_user_id){
                                                $sql_fav1 = "SELECT * FROM `tbl_favourites` WHERE `game_id` = '$gm_id' AND `user_id` = '$loign_user_id'";
                                                $res_fav1 = mysqli_query($conn, $sql_fav1);
                                                $row3 = mysqli_num_rows($res_fav1);
                                                if($row3 == 1){ $fav_game_active = 'fav_active'; }
                                            }                                            
                                        ?>
                                            <div class="col-lg-3 col-md-4 col-6 p-3 game-<?php echo $gm_id ?>">
                                                <a href="<?php echo $dir.'/games/'.$fetch_med_game['game_code'] ?>">
                                                    <div class="game-img">
                                                        <img src="<?php echo $dir.'/images/'.$fetch_med_game['image'] ?>" alt="" height="160">
                                                    <?php if($loign_user_id != ''){ ?>   
                                                        <a onclick="add_to_favourites(<?php echo $fetch_med_game['id'] ?>,<?php echo $loign_user_id ?>)">
                                                        <div class="fav-icon <?php echo $fav_game_active; ?>"><span class="fav"><i style="margin-right: 0;" class="fas fa-heart"></i></span></div></a>
                                                    <?php }else{ ?>
                                                        <a href="#" data-toggle="modal" data-target="#myModal">
                                                        <div class="fav-icon <?php echo $fav_game_active; ?>"><span class="fav"><i style="margin-right: 0;" class="fas fa-heart"></i></span></div></a>
                                                    <?php } ?>
                                                        <div class="overlay"></div>
                                                        <div class="game-description bg-blue" style="background: <?php echo $fetch_med_game['bottom_color'] ?>!important; ">
                                                            <div class="game-name"> <?php echo $fetch_med_game['name'] ?></div>
                                                            <div class="game-plays"> <?php echo $fetch_med_game['plays'] ?> Plays</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php } ?>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="col-12 mx-auto w-auto d-md-none d-block">
                                    <ul class="nav col nav-tabs ms-auto w-fit" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab2" data-bs-toggle="tab"
                                                data-bs-target="#home2" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">1</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab2" data-bs-toggle="tab"
                                                data-bs-target="#profile2" type="button" role="tab"
                                                aria-controls="profile" aria-selected="false">2</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="contact-tab2" data-bs-toggle="tab"
                                                data-bs-target="#contact2" type="button" role="tab"
                                                aria-controls="contact" aria-selected="false">3</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <!----------------------------- Sports category section ---------------------------->
                    <?php 
                    $sql_cat_last = "SELECT * FROM tbl_category LIMIT 2 OFFSET 4";
                    $res_cat_last = mysqli_query($conn, $sql_cat_last);
                    while($get_last_cat = mysqli_fetch_array($res_cat_last)){ 
                        $category_id = $get_last_cat['id'];
                        $cat_last_games = "SELECT * FROM tbl_games WHERE category = '$category_id'";
                        $res_last_games = mysqli_query($conn, $cat_last_games); 
                        $last_count = mysqli_num_rows($res_last_games);
                    ?>
                    <div class="games-sec fix-padding-y" id="<?php echo $get_last_cat['name'] ?>">
                        <div class="card box-shadow p-4">
                            <div class="row m-0">
                                <div class="col-md-7 col-12">
                                    <span class="category-text"><i class="fas fa-ghost"></i><?php echo $get_last_cat['name'] ?> <span class="sub-lable"><?php echo $last_count ?>  games</span></span>
                                </div>
                                <div class="col-5 ms-auto d-none d-md-block">
                                    <ul class="nav col nav-tabs ms-auto w-fit" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab2" data-bs-toggle="tab"
                                                data-bs-target="#home2" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">1</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab2" data-bs-toggle="tab"
                                                data-bs-target="#profile2" type="button" role="tab"
                                                aria-controls="profile" aria-selected="false">2</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="contact-tab2" data-bs-toggle="tab"
                                                data-bs-target="#contact2" type="button" role="tab"
                                                aria-controls="contact" aria-selected="false">3</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                        aria-labelledby="home-tab2">
                                        <div class="row"> 
                                        <?php while($fetch_last_game = mysqli_fetch_array($res_last_games)){    $fav_game_active = 'no-active';
                                                $gm_id = $fetch_last_game['id'];
                                                $gm_cat = $fetch_last_game['category']; 
                                                if($loign_user_id){
                                                    $sql_fav1 = "SELECT * FROM `tbl_favourites` WHERE `game_id` = '$gm_id' AND `user_id` = '$loign_user_id'";
                                                    $res_fav1 = mysqli_query($conn, $sql_fav1);
                                                    $row3 = mysqli_num_rows($res_fav1);
                                                    if($row3 == 1){ $fav_game_active = 'fav_active'; } 
                                                }                                                
                                            ?>
                                            <div class="col-lg-3 col-md-4 col-6 p-3 game-<?php echo $gm_id ?>">
                                                <a href="<?php echo $dir.'/games/'.$fetch_last_game['game_code'] ?>">
                                                    <div class="game-img">
                                                        <img src="<?php echo $dir.'/images/'.$fetch_last_game['image'] ?>" alt="" height="160">
                                                    <?php if($loign_user_id != ''){ ?>    
                                                        <a onclick="add_to_favourites(<?php echo $fetch_last_game['id'] ?>,<?php echo $loign_user_id ?>)">
                                                        <div class="fav-icon <?php echo $fav_game_active; ?>"><span class="fav"><i style="margin-right: 0;" class="fas fa-heart"></i></span></div></a>
                                                    <?php }else{ ?>
                                                        <a href="#" data-toggle="modal" data-target="#myModal">
                                                        <div class="fav-icon <?php echo $fav_game_active; ?>"><span class="fav"><i style="margin-right: 0;" class="fas fa-heart"></i></span></div></a>
                                                    <?php } ?>
                                                        <div class="overlay"></div>
                                                        <div class="game-description bg-blue" style="background: <?php echo $fetch_last_game['bottom_color'] ?>!important; ">
                                                            <div class="game-name"> <?php echo $fetch_last_game['name'] ?></div>
                                                            <div class="game-plays"> <?php echo $fetch_last_game['plays'] ?> Plays</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php } ?>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="col-12 mx-auto w-auto d-md-none d-block">
                                    <ul class="nav col nav-tabs ms-auto w-fit" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab2" data-bs-toggle="tab"
                                                data-bs-target="#home2" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">1</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab2" data-bs-toggle="tab"
                                                data-bs-target="#profile2" type="button" role="tab"
                                                aria-controls="profile" aria-selected="false">2</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="contact-tab2" data-bs-toggle="tab"
                                                data-bs-target="#contact2" type="button" role="tab"
                                                aria-controls="contact" aria-selected="false">3</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Login</h4>
              <a type="button" style="font-size:18px;" class="btn close" data-dismiss="modal"><i class="fas fa-times" style="margin-right:0;" ></i></a>
            </div>
            <div class="modal-body">
              <h5>For add to favourite, You must have to login first</h5>
            </div>
            <div class="modal-footer">
              <a class="button" data-toggle="modal" data-target="#myModal0" data-whatever="@mdo">Login</a>
              <a type="button" class="button" data-dismiss="modal">Close</a>
            </div>
          </div>
          
        </div>
    </div>
    
    <!-- Login Modal -->
   <div class="modal fade" id="myModal0" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login here</h5>
                <a type="button" style="font-size:18px;" class="btn close" data-dismiss="modal"><i class="fas fa-times" style="margin-right:0;" ></i></a>
              </div>
              <div class="modal-body">
                <form method="post">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                  </div>
                  <div class="mb-3">
                     <button type="submit" class="button border-0" name="login">Login</button>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                 <a type="button" class="button" data-toggle="modal" data-target="#myModal00" data-whatever="@mdo">Register</a>
                 <a type="button" class="button" data-dismiss="modal">Close</a>
              </div>
            </div>
          </div>
    </div>
    
    <!-- Register Modal -->
   <div class="modal fade" id="myModal00" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register here</h5>
                <a type="button" style="font-size:18px;" class="btn close" data-dismiss="modal"><i class="fas fa-times" style="margin-right:0;" ></i></a>
              </div>
              <div class="modal-body">
                <form>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="fname">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="lname">
                  </div>
                   <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                  </div>
                  <div class="mb-3">
                     <button type="submit" class="button border-0" name="submit">Register</button>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                   <!--<a class="button" data-toggle="modal" data-target="#myModal0" data-whatever="@mdo">Login</a>-->
                 <a type="button" class="button" data-dismiss="modal">Close</a>
              </div>
            </div>
          </div>
    </div>
    
<?php include('footer.php'); ?>