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

if(isset($_POST['crop_image'])){
    $data = $_POST['crop_image'];
    $image_array_1 = explode(";", $data);
    $image_array_2 = explode(",", $image_array_1[1]);
    $base64_decode = base64_decode($image_array_2[1]);
    $path_img = 'images/'.time().'.png';
    $imagename = ''.time().'.png';
    $_SESSION['path_img'] = $path_img;
    $_SESSION['base64_decode'] = $base64_decode;    
    $_SESSION['imagename'] = $imagename;
    $crop_success = 1;
}

if(isset($_POST['edit_game'])){

    $success = 0;
    $game_id = $_POST['games_dropdown'];
    $exist_game = "SELECT * FROM `tbl_games` WHERE id = '$game_id'";
    $res_exist = mysqli_query($conn, $exist_game);
    $fetch_exist = mysqli_fetch_assoc($res_exist);

    $name = $_POST['name'];
    $category = $_POST['category'];
    $game = $_POST['game'];    
    $plays = $_POST['plays'];
    $color = $_POST['color'];
    $changeCategory = $_POST['changeCategory'];

    // $image_file = $_FILES["image"]["name"];
    $image_file = $_FILES["crop_image"]["name"];
    $new_image_file = rand().'_'.$image_file;
    $type       = $_FILES["image"]["type"];  //file name "image"
    $size       = $_FILES["image"]["size"];
    $temp       = $_FILES["image"]["tmp_name"];
        
    $path="images/".$new_image_file; //set images folder path
    
    $directory="images/"; //set images folder path for update time previous file remove and new file upload for next use

    // $zip_file = $_FILES["zipfile_code"]["name"];
    // $zip_temp       = $_FILES["zipfile_code"]["tmp_name"];
    // $path="games/".$zip_file;

    $p_img = $_SESSION['path_img'];
    $base = $_SESSION['base64_decode'];
    $imagename = $_SESSION['imagename'];

    if($image_file){
         
        if(!file_exists($path)) //check file not exist in your upload folder path
        {
            
            unlink($directory.$fetch_exist['image']); //unlink function remove previous file
            // if(move_uploaded_file($temp, $path)){ //move upload file temperory directory to your upload folder    
            //     $success=1;

            // }else{
            //     echo '<script>alert("Somthing Went Wrong !!")</script>';
            // }  
            $crop_img = file_put_contents($p_img, $base);
            if($crop_img){
                $success=1;
            }else{
                echo '<script>alert("Somthing Went Wrong 1 !!")</script>';
            } 
        }
        else
        {   
            echo "<script>alert('File Already Exists...Check Upload Folder')</script>"; //error message file not exists your upload folder path
        }            
    }else{
        $image_file=$fetch_exist['image']; //if you not select new image than previous image sam it is it.
        $zip_file=$fetch_exist['game_code']; 
        if($changeCategory){
            $edit_game = "UPDATE tbl_games SET `name`='$name', `category`='$changeCategory',`plays`='$plays' ,`bottom_color`='$color',`image`='$image_file', `created_at` = current_timestamp() WHERE `id`= '$game_id'"; 
            $res_edit = mysqli_query($conn, $edit_game);
            if($res_edit){
                echo '<script>alert("Game Successfully Updated 2")</script>';
            }else{
                echo '<script>alert("Failed to Update Game 2 !!")</script>';
            }
        }else{
            $edit_game = "UPDATE tbl_games SET `name`='$name', `category`='$category',`plays`='$plays' ,`bottom_color`='$color',`image`='$image_file', `created_at` = current_timestamp() WHERE `id`= '$game_id'"; 
            $res_edit = mysqli_query($conn, $edit_game);
            if($res_edit){
                echo '<script>alert("Game Successfully Updated 2")</script>';
            }else{
                echo '<script>alert("Failed to Update Game 2 !!")</script>';
            }
        }
        
    }  
    if($success == 1){
        $imagename = $_SESSION['imagename'];

        if($changeCategory){
            $edit_game = "UPDATE tbl_games SET `name`='$name', `category`='$category',`plays`='$plays' ,`bottom_color`='$color',`image`='$imagename',  `created_at` = current_timestamp() WHERE `id`= '$game_id'"; 
            $res_edit = mysqli_query($conn, $edit_game);
            if($res_edit){
                echo '<script>alert("Game Successfully Updated 1")</script>';
            }else{
                echo '<script>alert("Failed to Update Game 1!!")</script>';
            }
        }else{
            $edit_game = "UPDATE tbl_games SET `name`='$name', `category`='$category',`plays`='$plays' ,`bottom_color`='$color',`image`='$imagename',  `created_at` = current_timestamp() WHERE `id`= '$game_id'"; 
            $res_edit = mysqli_query($conn, $edit_game);
            if($res_edit){
                echo '<script>alert("Game Successfully Updated 1")</script>';
            }else{
                echo '<script>alert("Failed to Update Game 1!!")</script>';
            }
        }        
    }
    // ------------------------------------------------------------------
      
}
?>
<style type="text/css">
    img#sample_image {
        display: block;
        max-width: 100%;
    }
    .preview {
        overflow: hidden;
        width: 160px; 
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }
    .modal-lg{
        max-width: 1000px !important;
    }
</style>
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
                                        <select class="form-control" aria-label="Default select example" name="category" id="category" onchange="getGames()">
                                            <option selected>Open this to select category</option>
                                            <?php while($fetch_cat = mysqli_fetch_array($res_category)){ ?>
                                            <option value="<?php echo $fetch_cat['id'] ?>"><?php echo $fetch_cat['name'] ?></option>
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
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Select Game</label>
                                        <select class="form-control" aria-label="Default select example" name="games_dropdown" id="games_dropdown" onchange="getGameDetail()">
                                            <option selected>Open this to select Game</option>                                           
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Select Category for Change</label>
                                        <select class="form-control" aria-label="Default select example" name="changeCategory" id="changeCategory">
                                            <option selected>Open this to Change Category</option>
                                        <?php
                                        $get_cat = "SELECT * FROM `tbl_category`";
                                        $res_cat = mysqli_query($conn, $get_cat);
                                        while($row_cat = mysqli_fetch_array($res_cat)){ ?>
                                            <option value="<?php echo $row_cat['id'] ?>"><?php echo $row_cat['name'] ?></option>
                                        <?php } ?>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="div_change" id="div_change">
                                <div class="row">
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label>Game Name</label>
                                            <input type="text" class="form-control" placeholder="Game Name" name="game">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-1">
                                        <div class="form-group">
                                            <label>Game plays</label>
                                            <input type="text" class="form-control" placeholder="Game Plays" name="plays">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-1">
                                        <div class="form-group">
                                            <label>Game bottom color</label>
                                            <input type="color" class="form-control color-type" placeholder="Bottom Color" name="color">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Update Game Photo</label>
                                            <!-- <input type="file" id="image" name="image" accept="image/*" onchange="loadFile(event)"> -->
                                            <input type="file"  accept="image/*" name="crop_image" class="crop_image" id="upload_image"  onchange="loadFile(event)">
                                            <input type="text" class="form-control" placeholder="Game Image"
                                                value="SELECT PHOTO">
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
                                            <label>Update Game Code</label>
                                            <input type="file" id="zipfile_code" name="zipfile_code" onchange='getFileData(this)' >
                                            <input type="text" class="form-control" placeholder="Game Code"
                                                value="SELECT FILE/FOLDER">
                                            <p id="file_name" value=""></p>
                                        </div>
                                        <script>
                                        function getFileData(object){
                                            var file = object.files[0];
                                            var name = file.name;//you can set the name to the paragraph id 
                                            document.getElementById("file_name").innerText += name;
                                        }
                                        </script> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" name="edit_game" class="btn w-auto btn-primary btn-block">Update</button>
                                </div>
                            </div>
                        </form>
                        <div class="modal fade" id="modal_crop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Crop Image Before Upload</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="img-container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <img src="" id="sample_image" />
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="preview"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="crop_and_upload" class="btn btn-primary">Crop</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php include("footer.php"); ?>
<script>
$(document).ready(function(){
    var $modal = $('#modal_crop');
    var crop_image = document.getElementById('sample_image');
    var cropper;
    $('#upload_image').change(function(event){
        var files = event.target.files;
        var done = function(url){
            crop_image.src = url;
            $modal.modal('show');
        };
        if(files && files.length > 0)
        {
            reader = new FileReader();
            reader.onload = function(event)
            {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });
    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(crop_image, {
            aspectRatio: 3/3,
            viewMode: 3,
            preview:'.preview'
        });
    }).on('hidden.bs.modal', function(){
        cropper.destroy();
        cropper = null;
    });
    $('#crop_and_upload').click(function(){
        canvas = cropper.getCroppedCanvas({
            width:400,
            height:400
        });
        canvas.toBlob(function(blob){
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function(){
                var base64data = reader.result; 
                $.ajax({
                    url:'edit-details.php',
                    method:'POST',
                    data:{crop_image:base64data},
                    success:function(data)
                    {
                        $modal.modal('hide'); 
                    }
                });
            };
        });
    });
});
</script>