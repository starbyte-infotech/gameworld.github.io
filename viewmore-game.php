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

if(isset($_GET['search'])){
    $search=$_GET['search']; 
}

$category_id = $_GET['cat_id'];
$sel_category = "SELECT * FROM `tbl_category`";
$res_category = mysqli_query($conn, $sel_category);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
     <link rel="stylesheet" href="assets/css/custom_style.css">
    <title>Document</title>
</head>

<body>
    <!-------------------------- navbar Start ------------------------>

    <nav class="navbar navbar-expand-custom navbar-mainbg fixed-top">
        <a class="navbar-brand navbar-logo d-promax" href="index.php"><img src="assets/image/000.png" alt=""></a>
        <a class="navbar-brand navbar-logo d-problock mx-auto" href="index.php"><img style="height: 35px;"
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
                    <li class="list_item"><a class="nav-link" href="favourite.html"><i class="fas fa-heart"></i>My Favourites</a></li>
                 
                  
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
            <?php
            if(isset($fetch_user) && !empty($fetch_user))
            {
            ?>
              <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span> <i class="fas fa-user"></i></span>    <?php echo $fetch_user['fname'] ?>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </div>
            <?php
            }else{
            ?>
                <a type="button" class="button-login" data-toggle="modal" data-target="#myModal0" data-whatever="@mdo">Login</a>
                <?php
            }
                ?>
          
        </div>   
      
    </nav>
    <!-- search result block -->
    <div class="search-outer-block">
        
    </div>
    <!------------------------------------------- navbar End --------------------------------------->

    <!---------------------------------------- Section Start --------------------------------------->

    <div class="container-fluid mt-65">
        <!-- <div class="row"> -->
            <div class="action-sec fix-padding-y" >
                <?php
                    $cat_games = "SELECT * FROM tbl_games WHERE category = '$category_id'";
                    $res_games = mysqli_query($conn, $cat_games); 
                    $count = mysqli_num_rows($res_games);

                    $sel_category1 = "SELECT * FROM `tbl_category` WHERE id = '$category_id'"; 
                    $res_category1 = mysqli_query($conn, $sel_category1);
                    $fetch_cat = mysqli_fetch_array($res_category1);
                ?>
                <div class="row m-0" >
                    <div class="col-md-7 col-12">
                        <span class="category-text"><img src="<?php echo $dir.'/images/'.$fetch_cat['icon'] ?>" width="25" height="25" alt=""><?php echo $fetch_cat['name'] ?> <span class="sub-lable"><?php echo $count ?> games</span></span>
                    </div>
                    <!-- <div class="col-5 ms-auto d-none d-md-block">
                        <ul class="nav col nav-tabs ms-auto w-fit" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab2" data-bs-toggle="tab"
                                    data-bs-target="#home2" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">1</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab2" data-bs-toggle="tab"
                                    data-bs-target="#profile2" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">2</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab2" data-bs-toggle="tab"
                                    data-bs-target="#contact2" type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">3</button>
                            </li>
                        </ul>
                    </div> -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home2" role="tabpanel"
                            aria-labelledby="home-tab2">
                            <div class="row">
                            <?php while($get_game = mysqli_fetch_array($res_games)){
                                $fav_game_active = 'no-active';
                                $gm_id = $get_game['id'];
                                $gm_cat = $get_game['category'];
                                if($loign_user_id){ 
                                    $sql_fav1 = "SELECT * FROM `tbl_favourites` WHERE `game_id` = '$gm_id' AND `user_id` = '$loign_user_id'";
                                    $res_fav1 = mysqli_query($conn, $sql_fav1);
                                    $row3 = mysqli_num_rows($res_fav1);
                                    if($row3 == 1){ $fav_game_active = 'fav_active'; }
                                }
                            ?>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-6 p-3 queDiv-<?php echo $gm_cat?>">
                                    <a target="_blank" href="<?php echo $dir.'/games/'.$get_game['game_code'] ?>">
                                        <div class="game-img">
                                            <img height="180" src="<?php echo $dir.'/images/'.$get_game['image'] ?>" alt="">
                                        <?php if($loign_user_id != ''){ ?>
                                            <a onclick="add_to_favourites(<?php echo $get_game['id'] ?>,<?php echo $loign_user_id ?>)">
                                            <div class="fav-icon <?php echo $fav_game_active; ?>"><span class="fav"><i style="margin-right: 0;" class="fas fa-heart"></i></span></div></a>
                                        <?php }else{ ?>
                                            <a href="#" data-toggle="modal" data-target="#myModal">
                                            <div class="fav-icon <?php echo $fav_game_active; ?>"><span class="fav"><i style="margin-right: 0;" class="fas fa-heart"></i></span></div></a>
                                        <?php }?>
                                            <div class="overlay"></div>
                                            <div class="game-description bg-blue" style="background: <?php echo $get_game['bottom_color'] ?> !important;">
                                                <div class="game-name"> <?php echo $get_game['name'] ?></div>
                                                <div class="game-plays"> <?php echo $get_game['plays'] ?> Plays</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>                                
                            
                            </div>

                        </div>

                    </div>
                    <!-- <div class="col-12 mx-auto w-auto d-md-none d-block">
                        <ul class="nav col nav-tabs ms-auto w-fit" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab2" data-bs-toggle="tab"
                                    data-bs-target="#home2" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">1</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab2" data-bs-toggle="tab"
                                    data-bs-target="#profile2" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">2</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab2" data-bs-toggle="tab"
                                    data-bs-target="#contact2" type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">3</button>
                            </li>
                        </ul>
                    </div> -->
                </div>
               
            </div>
        <!-- </div> -->
        <div class="row">
         <div class="col-2 d-lg-block d-md-none"></div>
            <div class="col-xl-8 col-md-12  bg-white">

                <!-- <iframe class="mt-65" src="/default.asp" width="100%" height="300">
                </iframe> -->
                <div class="action-sec fix-padding-y pb-0">
                    <div class="row m-0">
                        <div class="col-12 text-left">
                            <span class="category-text"><i class="fas fa-star"></i>you may also like <span>
                        </div>
                        <div class="border-bottom mt-3"></div>
                        <?php 
                        $like_game = "SELECT * FROM `tbl_games` ORDER BY RAND() LIMIT 12";
                        $like_res = mysqli_query($conn, $like_game);
                        while($fetch_like = mysqli_fetch_array($like_res)){  ?>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 my-4">
                            <a href="<?php echo $dir.'/games/'.$fetch_like['game_code'] ?>" target="_blank">
                                <div class="game-img">
                                    <img src="<?php echo $dir.'/images/'.$fetch_like['image'] ?>" alt="" height="130">
                                    <div class="overlay"></div>
                                    <div class="game-description bg-blue" style="background: <?php echo $fetch_like['bottom_color'] ?> !important;">
                                        <div class="game-name"><?php echo $fetch_like['name'] ?></div>
                                        <div class="game-plays"> <?php echo $fetch_like['plays'] ?> Plays</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                
            </div>
         <div class="col-2 d-lg-block d-md-none"></div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body">
              <p>Add to Favourite Game You need to Login First.</p>
              <a href="./login.php" class="button btn-success">Login</a>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                <form method="post">
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
    <!------------------------------------ Footer Start ----------------------------------------->
    <footer class="bd-footer py-5 mt-5 bg-light">
        <div class="container py-5">
            <div class="row m-0">
                <div class="col-lg-3 mb-3">
                    <a class="d-inline-flex align-items-center mb-2 link-dark text-decoration-none" href="/"
                        aria-label="Bootstrap">

                        <span class="fs-5">Company Logo</span>
                    </a>
                    <ul class="list-unstyled small text-muted">
                        <li class="mb-2">Designed and built with all the love in the world by the <a
                                href="/docs/5.0/about/team/">Bootstrap team</a> with the help of <a
                                href="https://github.com/twbs/bootstrap/graphs/contributors">our contributors</a>.
                        </li>
                        <li class="mb-2">Code licensed <a href="https://github.com/twbs/bootstrap/blob/main/LICENSE"
                                target="_blank" rel="license noopener">MIT</a>, docs <a
                                href="https://creativecommons.org/licenses/by/3.0/" target="_blank"
                                rel="license noopener">CC BY 3.0</a>.</li>
                        <li class="mb-2">Currently v5.0.1.</li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2 offset-lg-1 mb-3">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="">Company</a></li>
                        <li class="mb-2"><a href="">Privacy policy</a></li>
                        <li class="mb-2"><a href="">Cookie policy</a></li>
                        <li class="mb-2"><a href="">Terms Of Use</a></li>

                    </ul>
                </div>
                <div class="col-6 col-lg-2 mb-3">
                    <h5>Guides</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="">Support</a></li>
                        <li class="mb-2"><a href="">Use Our Game</a></li>
                        <li class="mb-2"><a href="">Cookie policy</a></li>
                        <li class="mb-2"><a href="">Terms Of Use</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2 mb-3">
                    <h5>Social Media</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="">Facebook</a></li>
                        <li class="mb-2"><a href="">Instagram</a></li>
                        <li class="mb-2"><a href="">Twitter</a></li>

                    </ul>
                    </ul>
                </div>

            </div>
        </div>
    </footer>
    <!------------------------------- Footer End -------------------------------->
    <script src="assets/js/nav.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js
        "></script>
    <script src="assets/js/custom_script.js"></script>
    <script>
        $(document).on('click', '.js-menu_toggle.closed', function (e) {
            e.preventDefault(); $('.list_load, .list_item').stop();
            $(this).removeClass('closed').addClass('opened');

            $('.side_menu').css({ 'left': '0px' });

            var count = $('.list_item').length;
            $('.list_load').slideDown((count * .6) * 100);
            $('.list_item').each(function (i) {
                var thisLI = $(this);
                timeOut = 100 * i;
                setTimeout(function () {
                    thisLI.css({
                        'opacity': '1',
                        'margin-left': '0'
                    });
                }, 100 * i);
            });
        });

        $(document).on('click', '.js-menu_toggle.opened', function (e) {
            e.preventDefault(); $('.list_load, .list_item').stop();
            $(this).removeClass('opened').addClass('closed');

            $('.side_menu').css({ 'left': '-250px' });

            var count = $('.list_item').length;
            $('.list_item').css({
                'opacity': '0',
                'margin-left': '-20px'
            });
            $('.list_load').slideUp(300);
        });
    </script>
    <script type="text/javascript">
    $("#search_box").keyup(function(){
        var input_val = jQuery('#search_box').val();
        var search_txt = document.getElementById('search_box').value;
        if(search_txt == ''){
            jQuery(".search-outer-block").css('opacity','0');
        }else{

            jQuery.ajax({
                url: "ajax/getSearch.php",
                type: "POST",
                data:{
                    "action": "search_results",
                    "search_txt": search_txt               
                },
                success: function(data){
                    console.log(data);
                    jQuery(".search-outer-block").html(data);
                    jQuery(".search-outer-block").css('opacity','1');
                }
            });
        }
    });
</script>
</body>


</html>