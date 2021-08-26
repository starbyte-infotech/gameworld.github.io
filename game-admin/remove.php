<?php 
session_start();
include("header.php");
include("config.php");
if(!isset($_SESSION['userlogin'])){
    header("location:login.php");
}
$get_category = "SELECT * FROM `tbl_category`";
$res_category = mysqli_query($conn, $get_category);

$get_games = "SELECT * FROM `tbl_games`";
$res_games = mysqli_query($conn, $get_games);

if(isset($_POST['del_game'])){
    $game_id = $_POST['games_dropdown']; 
    $cat_id = $_POST['category']; 

    $sql_game = "SELECT * FROM `tbl_games` WHERE id = '$game_id'";
    $sql_res = mysqli_query($conn, $sql_game);
    $fetch_game = mysqli_fetch_array($sql_res);
    $game_image = $fetch_game['image'];
    $file = 'images/'.$game_image; 
    unlink($file);
    $game_code = $fetch_game['game_code'];
    $zipfile = 'games/'.$game_code; 
    unlink($zipfile);

    $del_game = "DELETE FROM tbl_games WHERE `id` = '$game_id' AND `category` = '$cat_id'"; 
    $res_del = mysqli_query($conn, $del_game);
    if($res_del){
        echo '<script>alert("Game Deleted.")</script>';
        $del_from_fav = "DELETE FROM tbl_favourites WHERE `game_id` = '$game_id'"; 
        $res_del_fav = mysqli_query($conn, $del_from_fav);
        header("Location:remove.php");
    }else{
        echo '<script>alert("Failed to Delete Game !!")</script>';
    }
}
?>
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Remove Game</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Select Game Category</label>
                                        <select class="form-control" aria-label="Default select example" name="category" id="category" onchange="getGames()">
                                            <option selected>Open this to select catgoey</option>
                                            <?php while($fetch_cat = mysqli_fetch_array($res_category)){ ?>
                                                <option value="<?php echo $fetch_cat['id'] ?>"><?php echo $fetch_cat['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Select Game</label>
                                        <select class="form-control" aria-label="Default select example" name="games_dropdown" id="games_dropdown">
                                            <option selected>Open this to select Game</option>
                                           <!--  <?php while($fetch_game = mysqli_fetch_array($res_games)){ ?>
                                                <option value="<?php echo $fetch_game['id'] ?>"><?php echo $fetch_game['name'] ?></option>
                                            <?php } ?>   -->
                                            <!-- <option selected>Open this select menu</option> -->
                                            <!-- <option value="1">Candy Crush</option>
                                            <option value="2">Cricket star</option>
                                            <option value="3">Fruit ninja</option>
                                            <option value="4">Templerun</option>
                                            <option value="5">PUBG</option>
                                            <option value="6">Subway Surfers</option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <button type="submit" name="del_game" class="btn w-auto btn-primary btn-block">Delete this Game</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php include("footer.php"); ?>