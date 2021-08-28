<?php 

include('header.php');
include('config.php');
if(isset($_GET['sub_id'])){

    $subadmin_id = $_GET['sub_id'];
    $get_subadmin = "SELECT * FROM `tbl_subadmin` WHERE `id` = '$subadmin_id'";
    $res_subadmin = mysqli_query($conn, $get_subadmin);
    $fetch_subadmin = mysqli_fetch_assoc($res_subadmin);

    $get_links = "SELECT * FROM `tbl_generate_link` WHERE `sub_admin` = '$subadmin_id'";
    $res_links = mysqli_query($conn, $get_links);
    $num_rows = mysqli_num_rows($res_links); 
    
}
?>
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title"><?php echo $fetch_subadmin['first_name'].' '.$fetch_subadmin['last_name'] ?>'s all link status</h5>
                    </div>
                    <div class="card-body">
                    <?php while($fetch_link = mysqli_fetch_assoc($res_links)){ 

                        $created_at = $fetch_link['created_at'];
                        $date_format = date("F j, Y", strtotime($created_at))
                    ?>
                        <div class="row my-3">
                            <div class="col-9 pr-1">
                                <div class="form-group">
                                    <label>Link <?php echo $fetch_link['id'] ?></label> <span class="ml-3">Link Generated on <?php echo $date_format ?></span>
                                    <input type="text" class="form-control disabled link-input"
                                        placeholder="Company"
                                        value="<?php echo $fetch_link['link'] ?>">
                                </div>
                            </div>
                            <div class="col-auto my-3 d-flex" style=" align-self: center;">
                                <a class="details update-request" href="#" onclick="linkActive(<?php echo $fetch_link['id'] ?>,<?php echo $subadmin_id ?>);">Active </a> 
                                    || <a class="details bg-red" href="#" onclick="linkDeactive(<?php echo $fetch_link['id'] ?>,<?php echo $subadmin_id ?>);"> Deactivate</a>
                            </div>
                        </div>
                    <?php  } ?>
                        <!-- <div class="row my-3">
                            <div class="col-9 pr-1">
                                <div class="form-group">
                                    <label>Link 1</label> <span class="ml-3">Link Generated on 26/08/2021</span>
                                    <input type="text" class="form-control disabled link-input"
                                        placeholder="Company"
                                        value="https://adresults.com/tools/download-link-generator/">
                                </div>
                            </div>
                            <div class="col-auto my-3 text-center" style=" align-self: center;">
                                <a class="details update-request" href="bank-registration.html">Approve </a>
                                <a class="details bg-red" href="bank-registration.html">Decline</a>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-9 pr-1">
                                <div class="form-group">
                                    <label>Link 1</label> <span class="ml-3">Link Generated on 26/08/2021</span>
                                    <input type="text" class="form-control disabled link-input"
                                        placeholder="Company"
                                        value="https://adresults.com/tools/download-link-generator/">
                                </div>
                            </div>
                            <div class="col-auto my-3 text-center" style=" align-self: center;">
                                <a class="details update-request" href="bank-registration.html">Approve </a>
                                <a class="details bg-red" href="bank-registration.html">Decline</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php include('footer.php'); ?>
<script type="text/javascript"> 
    function linkActive(link_id,subadmin){
        var link_id = link_id;
        var subadmin = subadmin;
        // alert(link_id);
        jQuery.ajax({
            url: "ajax/active_link.php",
            type: "POST",
            data:{
                "action": "active_link",
                "link_id":link_id,
                "subadmin":subadmin,                 
            },
            success: function(data){
                if(data==1){
                    alert("Link Successfully Activate");
                }
                if(data==0){
                    alert("Failed to Activate Link !!");
                }
                if(data==2){
                    alert("Link Not Found !!");
                }
                if(data==3){
                    alert("Sorry, Link Already Activated.");
                }
            }
        });

    }

    function linkDeactive(link_id,subadmin){
        var link_id = link_id;
        var subadmin = subadmin;
        // alert(link_id);
        jQuery.ajax({
            url: "ajax/deactive_link.php",
            type: "POST",
            data:{
                "action": "deactive_link",
                "link_id":link_id,
                "subadmin":subadmin,                 
            },
            success: function(data){
                if(data==1){
                    alert("Link Successfully Deactivated");
                }
                if(data==0){
                    alert("Failed to Deactivate Link !!");
                }
                if(data==2){
                    alert("Link Not Found !!");
                }
                if(data==3){
                    alert("Sorry, Link Already Deactivated.");
                }
            }
        });        
    }
</script>