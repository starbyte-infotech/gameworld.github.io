<?php
session_start();
include('../config.php'); 

// ------------------------------ Favourite game pagination -------------------------------
$limit = 4;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;

$login_user_email = $_SESSION['email'];
$sel_user = "SELECT * FROM `tbl_user` WHERE email = '$login_user_email'";
$res_user = mysqli_query($conn, $sel_user);
$fetch_user = mysqli_fetch_assoc($res_user);
$loign_user_id = $fetch_user['id']; 

$query_fav="SELECT * FROM `tbl_favourites` WHERE `user_id` = '$loign_user_id' ORDER BY game ASC LIMIT $start_from, $limit";    
$result_fav = mysqli_query($conn, $query_fav);
$rows_fav = mysqli_num_rows($result_fav); ?>

<div class="tab-content fav" id="myTabContent">
    <div class="tab-pane fade show active" id="home111" role="tabpanel" aria-labelledby="home-tab111">
        <div class="row">
            
            <?php while($fetch_fav = mysqli_fetch_array($result_fav)) { 
                $g_name = $fetch_fav['game'];
                $g_id = $fetch_fav['game_id'];
                $query_game="SELECT * FROM `tbl_games` WHERE `name` = '$g_name' ";    
                $row_game = mysqli_query($conn, $query_game);
                $fav_game = mysqli_fetch_assoc($row_game);
                ?>
                <div class="col-lg-3 col-6 p-3">
                    <a href="<?php echo $dir.'/games/'.$fav_game['game_code']?>" target="_blank" onclick="increaseValue(<?php echo $g_id ?>)"> 
                        <div class="game-img">
                            <img src="<?php echo $dir.'/images/'.$fav_game['image']?>" alt="" height="160">
                            <div class="overlay"></div>
                            <div class="game-description bg-blue" style="background: <?php echo $fav_game['bottom_color']?> !important;">
                                <div class="game-name"> <?php echo $fav_game['name']?></div>
                                <div class="game-plays"> <?php echo $fav_game['plays']?> Plays</div>
                            </div>
                        </div>
                    </a>
                </div>                     
            <?php } ?>
        </div>
    </div>
</div>



<!-- ----------------------------- Action & Adventure game pagination ------------------------------- -->
<?php 
/*
$act_limit = 4;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$act_start_from = ($page-1) * $act_limit;

// $category_id = $get_cat['id'];
$sql_cat = "SELECT * FROM tbl_category ORDER BY id ASC LIMIT 2";
$res_cat = mysqli_query($conn, $sql_cat); 

while($get_cat = mysqli_fetch_array($res_cat)){
	$cat_id = $get_cat['id'];
	$get_games = "SELECT * FROM `tbl_games` WHERE category = '$cat_id' ORDER BY name ASC LIMIT $act_start_from, $act_limit";
	$res_games = mysqli_query($conn, $get_games); ?>

	<div class="tab-content act" id="myTabContent">
	    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
	        <div class="row">
	        <?php while($get_data = mysqli_fetch_array($res_games)){
	            $fav_game_active = 'no-active';
	            $gm_id = $get_data['id']; 
	            $sql_fav = "SELECT * FROM `tbl_favourites` WHERE `game_id` = '$gm_id' AND `user_id` = '$loign_user_id'";
	            $res_fav = mysqli_query($conn, $sql_fav);
	            $row2 = mysqli_num_rows($res_fav);
	            if($row2 == 1){ $fav_game_active = 'fav_active'; }
	        ?>
	            <div class="col-lg-3 col-md-4 col-6 p-3">
	                <a href="<?php echo $dir.'/games/'.$get_data['game_code'] ?>" target="_blank">
	                    <div class="game-img">
	                        <img src="<?php echo $dir.'/images/'.$get_data['image'] ?>" alt="">
	                        <a onclick="add_to_favourites(<?php echo $get_data['id'] ?>,<?php echo $loign_user_id ?>)"><div class="fav-icon <?php echo $fav_game_active ?>"><span class="fav"><i style="margin-right: 0;" class="fas fa-heart"></i></span></div></a>
	                        <div class="overlay"></div>
	                        <div class="game-description bg-blue" style="background: <?php echo $get_data['bottom_color'] ?>!important; ">
	                            <div class="game-name"><?php echo $get_data['name'] ?></div>
	                            <div class="game-plays"><?php echo $get_data['plays'] ?> Plays</div>
	                        </div>
	                    </div>
	                </a>
	            </div>
	        <?php } ?>                                                
	        </div>
	    </div>
	</div> 
<?php }
*/
