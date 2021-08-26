<?php 
session_start();
include('header.php');
include("config.php");
if(isset($_GET['id'])){

  $g_id = $_GET['id'];
  $sql_game = "SELECT * FROM `tbl_games` WHERE id = '$g_id'";
  $sql_res = mysqli_query($conn, $sql_game);
  $fetch_game = mysqli_fetch_array($sql_res);
  $game_image = $fetch_game['image'];
  $game_code = $fetch_game['game_code'];
  $image_file = 'images/'.$game_image;
  $zipfile = 'games/'.$game_code; 
  unlink($image_file);
  unlink($zipfile);

  $del_game = "DELETE FROM tbl_games WHERE `id` = '$g_id'"; 
  $res_del = mysqli_query($conn, $del_game);
  if($res_del){
      echo '<script>alert("Game Deleted.")</script>';
      $del_from_fav = "DELETE FROM tbl_favourites WHERE `game_id` = '$game_id'"; 
      $res_del_fav = mysqli_query($conn, $del_from_fav); ?>
      <script type="text/javascript">
        location.href = "trending_games.php"
      </script>
  <?php
  }else{
      echo '<script>alert("Failed to Delete Game !!")</script>';
  }

}
?>