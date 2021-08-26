<?php 
session_start();
include('header.php'); 
include('config.php');

if(isset($_GET['subadmin'])){

    $subadmin_id = $_GET['subadmin'];
    $get_subadmin = "SELECT * FROM `tbl_generate_link` WHERE `sub_admin` = '$subadmin_id'";
    $res_subadmin = mysqli_query($conn, $get_subadmin);
    $num_rows = mysqli_num_rows($res_subadmin);
    // $fetch_subadmin = mysqli_fetch_array($res_subadmin);
    // echo '';print_r($fetch_subadmin); 
}
?>
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">All link status</h5>
                    </div>
                    <div class="card-body"> 
                    <?php 
                    while($fetch_subadmin = mysqli_fetch_array($res_subadmin)){ 
                        $created_at = $fetch_subadmin['created_at'];
                        $date_format = date("F j, Y", strtotime($created_at))
                    ?>
                        <div class="row my-3">
                            <div class="col-9 pr-1">
                                <div class="form-group">
                                    <label>Link <?php echo $fetch_subadmin['id']?></label> <span class="ml-3">Link Generated on <?php echo $date_format ?></span>
                                    <input type="text" class="form-control disabled link-input"
                                        placeholder="Company" value="<?php echo $fetch_subadmin['link'] ?>">
                                </div>
                            </div>
                            <div class="col-auto my-3 d-flex" style=" align-self: center;">
                                <a class="details update-request" href="#" onclick="linkActive(<?php echo $fetch_subadmin['id'] ?>,<?php echo $subadmin_id ?>);">Active </a> 
                                || <a class="details bg-red" href="#" onclick="linkDeactive(<?php echo $fetch_subadmin['id'] ?>,<?php echo $subadmin_id ?>);"> Deactivate</a>
                            </div>
                        </div>
                    <?php } ?>
                    
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ad Mob Report </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Domain
                                        </th>
                                        <th>
                                            Page Views
                                        </th>
                                        <th>
                                            Impressions
                                        </th>
                                        <th>
                                            Clicks
                                        </th>
                                        <th>
                                            Page RPM
                                        </th>
                                        <th>
                                            Impressions RPM
                                        </th>
                                        <th>
                                            Total Earnigs
                                        </th>
                                        <th class="text-right">
                                            Your Earning
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Dakota Rice
                                        </td>
                                        <td>
                                            Niger
                                        </td>
                                        <td>
                                            Oud-Turnhout
                                        </td>
                                        <td>
                                            Dakota Rice
                                        </td>
                                        <td>
                                            Niger
                                        </td>
                                        <td>
                                            Oud-Turnhout
                                        </td>
                                        <td>
                                            Dakota Rice
                                        </td>

                                        <td class="text-right">
                                            $36,738
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Bank Account Details </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="row">
                                    <div class="col-6 text-left ask-text">
                                        Name On Bank Account :
                                    </div>
                                    <div class="col-6 text-left details-text">
                                        Ram Krishna Adwani
                                    </div>
                                    <div class="col-6 text-left ask-text">
                                        Bank Name :
                                    </div>
                                    <div class="col-6 text-left details-text">
                                        State Bank Of India
                                    </div>
                                    <div class="col-6 text-left ask-text">
                                        Account Number :
                                    </div>
                                    <div class="col-6 text-left details-text">
                                        59114455667788
                                    </div>
                                    <div class="col-6 text-left ask-text">
                                        IFSC :
                                    </div>
                                    <div class="col-6 text-left details-text">
                                        SBI0123456
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="row ml-1 text-center">
                                    <a class="details " href="bank-registration.html">Edit Details</a>
                                    <a class="details update-request" href="bank-registration.html">Updated</a>
                                    <!-- <a class="details pending-request" href="bank-registration.html">Pending</a>
                                    <a class="details process-request"
                                        href="bank-registration.html">Processing</a> -->


                                    <!-- <button class="btn w-auto btn-primary btn-block mr-auto" data-toggle="modal" data-target="#exampleModal">Click to copy Link</button> -->
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <blockquote>
                                    <p class="blockquote blockquote-primary">
                                        "You can not edit any details while it is under process."
                                    </p>

                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Transactions Detail </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Domain
                                        </th>
                                        <th>
                                            Page Views
                                        </th>
                                        <th>
                                            Impressions
                                        </th>
                                        <th>
                                            Clicks
                                        </th>
                                        <th>
                                            Page RPM
                                        </th>
                                        <th>
                                            Impressions RPM
                                        </th>
                                        <th>
                                            Total Earnigs
                                        </th>
                                        <th>
                                            Your Earning
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Dakota Rice
                                        </td>
                                        <td>
                                            Niger
                                        </td>
                                        <td>
                                            Oud-Turnhout
                                        </td>
                                        <td>
                                            Dakota Rice
                                        </td>
                                        <td>
                                            Niger
                                        </td>
                                        <td>
                                            Oud-Turnhout
                                        </td>
                                        <td>
                                            Dakota Rice
                                        </td>

                                        <td>
                                            $36,738
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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