<?php 
session_start();
include('header.php'); 
include('config.php');

$get_subadmin = 'SELECT * FROM `tbl_subadmin`';
$res_subadmin = mysqli_query($conn, $get_subadmin);
?>

    <div class="content">
        <div class="row">
        <?php while($fetch_admin = mysqli_fetch_array($res_subadmin)){ 
            $id = $fetch_admin['id'];
        ?>

            <div class="col-lg-4">
                <a href="vendor-details.php?subadmin=<?php echo $id ?>">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">6 Links</h5>
                            <h4 class="card-title" style="color: #2c2c2c;"><?php echo $fetch_admin['first_name'].' '.$fetch_admin['last_name']?></h4>
                        </div>
                        <div class=" card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        <?php } ?>
            
        </div>
    </div>
<?php include('footer.php'); ?>