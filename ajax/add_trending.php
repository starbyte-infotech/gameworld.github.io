<?php 
session_start();
include("../config.php");
if(isset($_POST['action']) && !empty($_POST['action']) == 'add_trending') {

	$game_id = $_POST['game_id'];
	$qry_sel = "SELECT * FROM tbl_games WHERE id = '$game_id'";
	$res_sel = mysqli_query($conn, $qry_sel);
	$fetch_data = mysqli_fetch_assoc($res_sel);
	$trend_value = $fetch_data['trend_value']; 

	$new_trend_value = $trend_value + 1;
	//for plus the value in table for trending games
	$qry_increase = "UPDATE tbl_games SET `trend_value`='$new_trend_value' WHERE `id`= '$game_id'"; 
	$res_increase = mysqli_query($conn, $qry_increase);
	if($res_increase){
		echo $data = 1;
	}else{
		echo $data = 0;
	}
}


?>