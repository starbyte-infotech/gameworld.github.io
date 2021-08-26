<?php include('config.php'); ?>
<?php include('header.php'); 
if(!isset($_SESSION['userlogin'])){
    header("location:login.php");
}

$get_category = "SELECT * FROM `tbl_category`";
$res_category = mysqli_query($conn, $get_category);
if(isset($_POST['remove_category'])){

    $category_id = $_POST['category']; 
    $sql_cat = "SELECT * FROM `tbl_category` WHERE id = '$category_id'";
    $sql_res = mysqli_query($conn, $sql_cat);
    $fetch_category = mysqli_fetch_array($sql_res);
    $cat_icon = $fetch_category['icon']; 
    $file = 'images/'.$cat_icon; 
    unlink($file);

    $del_category = "DELETE FROM tbl_category WHERE `id` = '$category_id'"; 
    $res_del = mysqli_query($conn, $del_category);
    if($res_del){
        echo '<script>alert("Category Deleted.")</script>';
        $sql_gm = "SELECT * FROM `tbl_games` WHERE category = '$category_id'";
        $sql_gm = mysqli_query($conn, $sql_gm);
        $fetch_gm = mysqli_fetch_array($sql_gm);
        $gm_img = $fetch_gm['image'];
        $game_img = 'images/'.$gm_img; 
        unlink($file);
        $del_games = "DELETE FROM tbl_games WHERE `category` = '$category_id'"; 
        $res_del_game = mysqli_query($conn, $del_games);
        if($res_del){
            header("Location:remove-category.php");
        }
    }else{
        echo '<script>alert("Failed to Delete Category !!")</script>';
    }

}
?>
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Remove Category</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Select Game Category</label>
                                    <select class="form-control" aria-label="Default select example" name="category">
                                        <option selected>Open this select cateory</option>
                                    <?php while($fetch_cat = mysqli_fetch_array($res_category)){?>
                                        <option value="<?php echo $fetch_cat['id'] ?>"><?php echo $fetch_cat['name'] ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>                                 

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="remove_category" class="btn w-auto btn-primary btn-block" >Delete Category</button>                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include('footer.php'); ?>
            