<?php 
session_start();
include("../config.php");
//txt_search
$loign_user_id = '';
if(isset($_SESSION['email'])){
    $login_user_email = $_SESSION['email'];
    $sel_user = "SELECT * FROM `tbl_user` WHERE email = '$login_user_email'";
    $res_user = mysqli_query($conn, $sel_user);
    $fetch_user = mysqli_fetch_assoc($res_user);
    $loign_user_id = $fetch_user['id']; 
}
if(isset($_POST['action']) && !empty($_POST['action']) == 'search_results') {

    $search_txt = $_POST['search_txt'];

    $sel_game = "SELECT * FROM tbl_games WHERE name LIKE '%$search_txt%'";
    $res_game = mysqli_query($conn, $sel_game); ?>
    <div class="search-inner px-2 overflowx-hidden">
        <?php
        while($fetch_game = mysqli_fetch_array($res_game)){ 
            $game_code = $fetch_game['game_code'];
            $cat_id = $fetch_game['category'];
            $sel_cat = "SELECT * FROM tbl_category WHERE id = '$cat_id'";
            $res_cat = mysqli_query($conn, $sel_cat);
            $fetch_cat = mysqli_fetch_array($res_cat);
            $cat_name = $fetch_cat['name']; 


            $fav_game_active = 'no-active';
            $game_id = $fetch_game['id']; 
            if($loign_user_id){
                $sql_fav = "SELECT * FROM `tbl_favourites` WHERE `game_id` = '$game_id' AND `user_id` = '$loign_user_id'";
                $res_fav = mysqli_query($conn, $sql_fav);
                $row1 = mysqli_num_rows($res_fav);
                if($row1 == 1){ $fav_game_active = 'fav_active'; }
            }
            ?>
            <a href="<?php echo $dir.'/games/'.$game_code; ?>" target="_blank">
                <div class="search-item row my-2" >
                    <div class="search-img col-3">
                        <img src="<?php echo $dir.'/images/'. $fetch_game['image'] ?>" alt="game-icon" class="s_img">
                    </div>
                    <div class="search_game col-7 px-3">
                        <p class="mb-1"><?php echo $fetch_game['name'] ?></p>
                        <small><?php echo $cat_name ?></small>
                    </div>
                    <div class="fav_button col-2">
                        <!-- <img class="fav_icon_img " src="https://static.gamezop.com/peach/assets/img/gamezop-play-heart.svg" alt="heart-icon"> -->
                        <?php if($loign_user_id != ''){ ?>
                        <a onclick="add_to_favourites(<?php echo $game_id ?>,<?php echo $loign_user_id ?>)"><div class="fav-icon <?php echo $fav_game_active ?>">
                        <span class="fav"><i style="margin-right: 0;" class="fas fa-heart"></i></span>
                        </div></a>
                        <?php }else{ ?>
                        <a href="#" data-toggle="modal" data-target="#myModal"><div class="fav-icon <?php echo $fav_game_active ?>"><span class="fav"><i style="margin-right: 0;" class="fas fa-heart"></i></span></div></a>
                        <?php } ?>
                    </div>
                </div>
            </a>
        <?php } ?> 
    </div>
    <?php
}

?>