<?php 
include('../config.php');
if(isset($_POST['action']) && !empty($_POST['action']) == 'fetch_games') {

	$cat_id = $_POST['cat_id'];
	$sel_games = "SELECT * FROM `tbl_games` WHERE `category` = '$cat_id'";
	$res_games = mysqli_query($conn, $sel_games); ?>

	<select class="form-control" aria-label="Default select example" name="games_dropdown" id="games_dropdown" onchange="getGameDetail()">
        <option selected>Open this to select Game</option>
        <?php while($fetch_game = mysqli_fetch_array($res_games)){ ?>
            <option value="<?php echo $fetch_game['id'] ?>"><?php echo $fetch_game['name'] ?></option>
        <?php } ?>       
    </select>

<?php } ?>





