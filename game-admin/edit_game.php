<?php
session_start();
include("header.php"); 
include("config.php");
if(!isset($_SESSION['userlogin'])){
    header("location:login.php");
}

if(isset($_GET['id'])){

    $game_id = $_GET['id'];
    $get_game = "SELECT * FROM `tbl_games` WHERE id = '$game_id'";
    $res_game = mysqli_query($conn, $get_game);
    $fetch_game = mysqli_fetch_assoc($res_game);
    $exist_image = $fetch_game['image'];

    if(isset($_POST['update'])){

        $success = 0;
        $exist_game = "SELECT * FROM `tbl_games` WHERE id = '$game_id'";
        $res_exist = mysqli_query($conn, $exist_game);
        $fetch_exist = mysqli_fetch_assoc($res_exist);

        $category = $_POST['category'];
        $name = $_POST['name'];
        $plays = $_POST['plays'];
        $color = $_POST['color']; 

        $image_file = $_FILES["image"]["name"];
        $new_image_file = rand().'_'.$image_file;
        $type = $_FILES["image"]["type"];  //file name "image"
        $size = $_FILES["image"]["size"];
        $temp = $_FILES["image"]["tmp_name"];

        $path="images/".$new_image_file; //set images folder path
    
        $directory="images/"; //set images folder path for update time previous file remove and new file upload for next use

        // start upload zipfile to fam_monitor_directory(fam, dirname)
        // $output = '';  
        // if(!empty($_FILES['zipfile_code']['tmp_name']) && ($_POST['zipfile_code']) || !empty($_FILES['zipfile_code']['tmp_name']) && (empty($_POST['zipfile_code']))){

        //     // if($_FILES['zipfile_code']['name'] != '') {  
        //         $file_name = $_FILES['zipfile_code']['name'];  
        //         $array = explode(".", $file_name);  
        //         $zipfile_name = $array[0];  
        //         $ext = $array[1];  
        //         if($ext == 'zip') {  
        //             $path = 'games/';  
        //             $location = $path . $file_name;  
        //             if(move_uploaded_file($_FILES['zipfile_code']['tmp_name'], $location)) {  
        //                 $zip = new ZipArchive;  
        //                 if($zip->open($location)) {  
        //                     $zip->extractTo($path);  
        //                     $zip->close();  
        //                 }  
        //                 $files = scandir($path . $zipfile_name);  
        //                 //$zipfile_name is extract folder from zip file  
        //                 foreach($files as $file)  {  
        //                     $file_ext = end(explode(".", $file));  
        //                     $allowed_ext = array('jpg', 'png');  
        //                     if(in_array($file_ext, $allowed_ext)) {  
        //                         $new_name = md5(rand()).'.' . $file_ext;   
        //                         copy($path.$zipfile_name.'/'.$file, $path . $new_name);  
        //                         unlink($path.$name.'/'.$file);  
        //                     }       
        //                 }  
        //                 unlink($location);  
        //                 rmdir($path . $name);  
        //             }  
        //         }  
        //     // }  

        // }                         

        // End upload zip file          
        
        if($image_file){
         
        if(!file_exists($path)) //check file not exist in your upload folder path
        {
            
            unlink($directory.$fetch_exist['image']); //unlink function remove previous file
            if(move_uploaded_file($temp, $path)){ //move upload file temperory directory to your upload folder    
                $success=1;

            }else{
                echo '<script>alert("Somthing Went Wrong !!")</script>';
            }                                
        }
        else
        {   
            echo "<script>alert('File Already Exists...Check Upload Folder')</script>"; //error message file not exists your upload folder path
        }            
        }else{
            $image_file=$fetch_exist['image']; //if you not select new image than previous image sam it is it.
            $zip_file=$fetch_exist['game_code']; 
            $edit_game = "UPDATE tbl_games SET `name`='$name', `category`='$category',`plays`='$plays' ,`bottom_color`='$color',`image`='$image_file', `created_at` = current_timestamp() WHERE `id`= '$game_id'"; 
            $res_edit = mysqli_query($conn, $edit_game);
            if($res_edit){
                echo '<script>alert("Game Successfully Updated 2")</script>';
            }else{
                echo '<script>alert("Failed to Update Game 2 !!")</script>';
            }
        }  
        if($success == 1){

            $edit_game = "UPDATE tbl_games SET `name`='$name', `category`='$category',`plays`='$plays' ,`bottom_color`='$color',`image`='$new_image_file',  `created_at` = current_timestamp() WHERE `id`= '$game_id'"; 
            $res_edit = mysqli_query($conn, $edit_game);
            if($res_edit){
                echo '<script>alert("Game Successfully Updated 1")</script>';
            }else{
                echo '<script>alert("Failed to Update Game 1!!")</script>';
            }
        }        
    }
}

$get_category = "SELECT * FROM `tbl_category`";
$res_category = mysqli_query($conn, $get_category);


?>
    <div class="content">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Edit Game</h5>
                    </div>                    
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Select Game Category</label>
                                        <select class="form-control" aria-label="Default select example" name="category">
                                            <option selected>Open this select cateory</option>
                                        <?php while($fetch_cat = mysqli_fetch_array($res_category)){ ?>
                                            <option value="<?php echo $fetch_cat['id'] ?>" <?php if($fetch_game['category']==$fetch_cat['id']) echo 'selected="selected"'; ?>  ><?php echo $fetch_cat['name'] ?></option>
                                        <?php } ?>
                                            <!-- <option value="1">Action</option>
                                            <option value="2">Adventure</option>
                                            <option value="3">Arcade</option>
                                            <option value="4">Puzzle & Logic </option>
                                            <option value="5">Sports & Racing</option>
                                            <option value="6">Stratergy</option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label>Game Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Game Name"
                                            value="<?php echo $fetch_game['name'] ?>" name="name">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label>Game plays</label>
                                        <input type="text" class="form-control" placeholder="Enter Game Plays"
                                            value="<?php echo $fetch_game['plays'] ?>" name="plays">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label>Game bottom color</label>
                                        <input type="color" class="form-control color-type" placeholder="Enter Botoom Color"
                                            value="<?php echo $fetch_game['bottom_color'] ?>" name="color">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload Game Photo</label>        
                                        <input type="file" id="image" name="image" accept="image/*" onchange="loadFile(event)">
                                        <input type="text" class="form-control" placeholder="Image"
                                            value="SELECT PHOTO">
                                        <label>Existing Game Image</label>                               
                                        <img src="<?php echo $dir.'/images/'.$fetch_game['image'] ?>" width="100" height="100"> 
                                        <label>New Selected Game Image</label>
                                        <img src="<?php echo $dir ?>/images/placeholder_img.jfif" id="output" width="100" height="100" />
                                            <script>
                                              var loadFile = function(event) {
                                                var output = document.getElementById('output');
                                                output.src = URL.createObjectURL(event.target.files[0]);
                                                output.onload = function() {
                                                  URL.revokeObjectURL(output.src) // free memory
                                                }
                                              };
                                            </script>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Game Code</label>
                                    <input type="file" id="zipfile_code" name="zipfile_code">
                                    <input type="text" class="form-control" placeholder="Code Folder"
                                            value="SELECT FILE/FOLDER">
                                    <!-- <textarea rows="10" cols="1000" class="form-control" placeholder="Enter Game Code Here" name="code" value="Mike"></textarea> -->
                                  </div>
                                </div>
                              </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" name="update" class="btn w-auto btn-primary btn-block" >Add Game</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php include("footer.php"); ?>