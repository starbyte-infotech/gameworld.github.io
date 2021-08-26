<?php 
include('config.php');
if(isset($_POST['submit'])){

	$file_name = $_FILES["img"]["tmp_name"];
        $img_name = $_FILES["img"]["name"];
    $image_size = getimagesize($_FILES['img']['tmp_name']);    
    // echo '<pre>';print_r($image_size); die();                    
    $width = $image_size[0];    
    $height = $image_size[1];
                 
    $ratio = $width / $height;                        
    if ($ratio > 1)            
    {
        $new_width = 200;
        $new_height = 300;            
    }            
    else                        
    {
        $new_height = 200;                    
        $new_width = 300;            
    }
                             
    $src = imagecreatefromstring(file_get_contents($file_name));                        
    $destination = imagecreatetruecolor($new_width, $new_height);
     
    imagecopyresampled($destination, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);                        
    imagepng($destination, $file_name);
             
    imagedestroy($src);                        
    imagedestroy($destination);
              
    $game_temp1 = $_FILES["img"]["tmp_name"];   
    $new_img_name1 = rand().'_'.$img_name;
    $folder1 = "images/".$new_img_name1;   
    if(move_uploaded_file($game_temp1, $folder1)){
    	echo '<script>alert("success !!")</script>';
        // $sql = "INSERT INTO `tbl_games`(`id`, `name`, `category`, `plays`, `bottom_color`, `image`, `game_code` ,created_at) VALUES (NULL, '$name','$category', '$plays', '$color', '$new_img_name1', '$zipfile_name', current_timestamp())";
        // $res = mysqli_query($conn, $sql);  
        // if($res){
        //     // $msg = 1;
        //     echo '<script>alert("Game Inserted Successfully")</script>';
        // }else{
        //     // $msg = 0;
        //     echo '<script>alert("Failed to add Game !!")</script>';
        // }
    }else{
         echo '<script>alert("error !!")</script>';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form  action="" method="post" enctype="multipart/form-data">
	<input type="file" name="img">
	<input type="submit" name="submit">
</form>
</body>
</html>
