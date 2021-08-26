<?php

include('../config.php');
if(isset($_POST['action']) && !empty($_POST['action']) == 'add_to_favourites') {

	$game_id = $_POST['game_id'];
	$user_id = $_POST['user_id'];

    $qry_fav="SELECT * FROM `tbl_favourites` WHERE `game_id` = '$game_id' AND `user_id` = '$user_id'";    
    $res_fav1 = mysqli_query($conn, $qry_fav);
    $rows = mysqli_num_rows($res_fav1); 

    if($rows == 0){

    	$query_select="SELECT * FROM `tbl_games` WHERE `id` = '$game_id'"; 
//     	(SELECT name FROM tbl_games WHERE  (tbl_games.name LIKE '%Sports%'))
// UNION 
// (SELECT name FROM tbl_category WHERE  (tbl_category.name LIKE '%Sports%'))   
    	$result_select = mysqli_query($conn, $query_select);
    	$fetch_game = mysqli_fetch_assoc($result_select);
    	$game_name = $fetch_game['name'];
    	
	    $category_id = $fetch_game['category'];
	    $query_cat="SELECT * FROM `tbl_category` WHERE `id` = '$category_id'";    
	    $result_cat = mysqli_query($conn, $query_cat);
	    $fetch_cat = mysqli_fetch_assoc($result_cat);
	    $cat_name = $fetch_cat['name'];

	    $query="INSERT INTO `tbl_favourites` (`id`, `game`,`game_id`, `category`, `user_id`) VALUES (NULL, '$game_name','$game_id' ,'$cat_name', '$user_id')";
	    $result = mysqli_query($conn, $query);
	    if($result){
	        echo $data = 1;
	    }

    }else{ 
    	$query_del="DELETE FROM tbl_favourites WHERE `game_id` = '$game_id' AND `user_id` = '$user_id'";
	    $result_del = mysqli_query($conn, $query_del);
	    if($result_del){ 
	        echo $data = 0;
	    }
    }
    
}
?>
