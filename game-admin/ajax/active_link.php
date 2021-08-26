<?php
session_start();
include('../config.php');
if(isset($_POST['action']) && !empty($_POST['action']) == 'active_link') {

	$link_id = $_POST['link_id'];
	$subadmin = $_POST['subadmin'];

	$qry_link="SELECT * FROM `tbl_generate_link` WHERE `id` = '$link_id' AND `sub_admin` = '$subadmin'";    
    $res_link = mysqli_query($conn, $qry_link);
    $rows = mysqli_num_rows($res_link); 
    $fetch_link = mysqli_fetch_assoc($res_link);
    if($rows > 0){

    	if($fetch_link['status'] == 1){
    		echo $data = 3;
    	}else{
    		$status = 1;
	    	$upd_link = "UPDATE tbl_generate_link SET `status`='$status' WHERE `id`= '$link_id' AND `sub_admin` = '$subadmin'";
	    	$upd_res = mysqli_query($conn, $upd_link);
	    	if($upd_res){
	    		echo $data = 1;
	    	}else{
	    		echo $data = 0;
	    	}
    	}	    	
    }else{
    	echo $data = 2;
    }

}