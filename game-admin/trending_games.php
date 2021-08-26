<?php 
session_start();
include('header.php');
include("config.php");
?>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Trending Games</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th style="font-weight: 500;">Image</th>
                <th style="font-weight: 500;">Name</th>
                <th style="font-weight: 500;">Category</th>
                <th style="font-weight: 500;">Plays</th>
                <th style="font-weight: 500;">Action</th>
              </thead>
              <tbody>
              <?php
                $trending_games = "SELECT * FROM tbl_games ORDER BY trend_value DESC LIMIT 12";
                $res_trending = mysqli_query($conn, $trending_games);
                while($fetch_trend = mysqli_fetch_array($res_trending)){ 
                  $game_id = $fetch_trend['id'];
                  $category_id = $fetch_trend['category'];
                  $games_category = "SELECT * FROM tbl_category WHERE id = '$category_id'";
                  $res_category = mysqli_query($conn, $games_category);
                  $fetch_cat = mysqli_fetch_assoc($res_category);
                ?>
                  <tr>
                  <td>
                    <img src="<?php echo $dir.'/images/'.$fetch_trend['image'] ?>" height="80" width="80" style="border-radius:5px;">
                  </td>
                  <td><?php echo $fetch_trend['name'] ?></td>
                  <td style="text-transform: capitalize;"><?php echo $fetch_cat['name'] ?></td>
                  <td><?php echo $fetch_trend['plays'] ?></td>
                  <td><a href="edit_game.php?id=<?php echo $game_id; ?>"><span style="color:#379618;font-weight: bold;">Edit</span></a> || <a href="remove_game.php?id=<?php echo $game_id; ?>"><span style="color: #e50b0b;font-weight: bold;">Delete</span></a></td>
                </tr>  
                <?php } ?>                              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('footer.php'); ?>