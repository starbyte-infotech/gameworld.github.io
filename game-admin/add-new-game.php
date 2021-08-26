<?php
session_start();
include("header.php"); 
include("config.php");
if(!isset($_SESSION['userlogin'])){
    header("location:login.php");
}

$get_category = "SELECT * FROM `tbl_category`";
$res_category = mysqli_query($conn, $get_category);

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
    if(isset($_POST['add_game'])){ 

        $category = $_POST['category'];
        $name = $_POST['name'];
        $plays = $_POST['plays'];
        $color = $_POST['color'];

        // start upload zipfile to directory        
        $game_img = $_FILES["image"]["name"]; 
        $game_temp = $_FILES["image"]["tmp_name"];   
        $new_img_name = rand().'_'.$game_img;
        $folder = "images/".$new_img_name;

        $output = '';  
        if($_FILES['zipfile_code']['name'] != '') {  

            $file_name = $_FILES['zipfile_code']['name'];  
            $array = explode(".", $file_name);  
            $zipfile_name = $array[0];  
            $ext = $array[1];  
            if($ext == 'zip') {  
                $path = 'games/'; 
                $location = $path . $file_name;  
                if(move_uploaded_file($_FILES['zipfile_code']['tmp_name'], $location)) {  
                    $zip = new ZipArchive;  
                    if($zip->open($location)) {  
                        $zip->extractTo($path);  
                        $zip->close();  
                    }  
                    $files = scandir($path . $zipfile_name);  
                    //$zipfile_name is extract folder from zip file  
                    foreach($files as $file)  {  
                        $file_ext = end(explode(".", $file));  
                        $allowed_ext = array('jpg', 'png');  
                        if(in_array($file_ext, $allowed_ext)) {  
                            $new_name = md5(rand()).'.' . $file_ext;  
                            copy($path.$zipfile_name.'/'.$file, $path . $new_name);  
                            unlink($path.$name.'/'.$file);  
                        }       
                    }  
                    unlink($location);  
                    rmdir($path . $name);  
                }  
            }  
        } 

        $p_img = $_SESSION['path_img'];
        $base = $_SESSION['base64_decode'];
        $imagename = $_SESSION['imagename'];
        $crop_img = file_put_contents($p_img, $base);
        if($crop_img){

            $sql = "INSERT INTO `tbl_games`(`id`, `name`, `category`, `plays`, `bottom_color`, `image`, `game_code` ,`trend_value`,`created_at`) VALUES (NULL, '$name','$category', '$plays', '$color', '$imagename', '$zipfile_name','0', current_timestamp())"; 
            $res = mysqli_query($conn, $sql);  
            if($res){
                // $msg = 1;
                echo '<script>alert("Game Inserted Successfully")</script>';
            }else{
                // $msg = 0;
                echo '<script>alert("Failed to add Game !!")</script>';
            }
        }else{
            echo '<script>alert("Something Went Wrong !!")</script>';
        } 
        // $sql2 = "INSERT INTO upload(imagename) VALUES ('$imagename')"; 
        // $conn->query($sql2);

        
        // echo $zipfile_name; die();
        // if(empty($category) || empty($name) || empty($plays) || empty($color) || empty($new_img_name) || empty($file_name) ){
        //   echo '<script>alert("Please Enter values for all the Fields, Check and Try Again !!")</script>';
        // }else{
            // if (move_uploaded_file($game_temp, $folder))  {

            //     $sql = "INSERT INTO `tbl_games`(`id`, `name`, `category`, `plays`, `bottom_color`, `image`, `game_code` ,created_at) VALUES (NULL, '$name','$category', '$plays', '$color', '$new_img_name', '$zipfile_name', current_timestamp())"; 
            //     $res = mysqli_query($conn, $sql);  
            //     if($res){
            //         // $msg = 1;
            //         echo '<script>alert("Game Inserted Successfully")</script>';
            //     }else{
            //         // $msg = 0;
            //         echo '<script>alert("Failed to add Game !!")</script>';
            //     }
            // }else{
            //     echo '<script>alert("Something Went Wrong !!")</script>';
            // }
        // }
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
                        <h5 class="title">Add New Game</h5>
                    </div>                    
                    <div class="card-body">
                        <form  action="" method="post" enctype="multipart/form-data" name="add_game_form">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Select Game Category</label>
                                        <select class="form-control" aria-label="Default select example" name="category" id="category" >
                                            <option selected>Open this select cateory</option>
                                        <?php while($fetch_cat = mysqli_fetch_array($res_category)){ ?>
                                            <option value="<?php echo $fetch_cat['id'] ?>"><?php echo $fetch_cat['name'] ?></option>
                                        <?php } ?>
                                        </select>
                                         <span class="error"><p id="category_error"></p></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label>Game Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Game Name" id="name" name="name">
                                        <span class="error"><p id="name_error"></p></span>
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label>Game plays</label>
                                        <input type="text" class="form-control" placeholder="Enter Game Plays" id="plays" name="plays">
                                        <span class="error"><p id="name_error"></p></span>
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label>Game bottom color</label>
                                        <input type="color" class="form-control color-type" placeholder="Enter Botoom Color" id="color" name="color">
                                        <span class="error"><p id="color_error"></p></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload Game Photo</label>
                                        <!-- <input type="file" accept="image/*" id="img" class="img" name="img" onchange="loadFile(event)"> -->
                                        <!-- <input type="file"  accept="image/*" id="image" name="image" class="image" onchange="loadFile(event)"> -->
                                        <input type="file"  accept="image/*" name="crop_image" class="crop_image" id="upload_image"  onchange="loadFile(event)">
                                        <input type="text" class="form-control" placeholder="Image" value="SELECT PHOTO">
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
                                        <span class="error"><p id="image_error"></p></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Game Code</label>
                                    <input type="file" name="zipfile_code" id='file' onchange='getFileData(this)'>
                                    <input type="text" class="form-control" placeholder="Code Folder"
                                            value="SELECT FILE/FOLDER"> 
                                    <p id="file_name" value=""></p> 
                                  </div>
                                </div>
                                <script>
                                function getFileData(object){
                                    var file = object.files[0];

                                    var name = file.name;//you can set the name to the paragraph id 
                                    // alert("name : "+name);
                                    // document.getElementById('file_name').value=name;//set name using core javascript
                                    document.getElementById("file_name").innerText += name;

                                }
                                </script> 
                                <span class="error"><p id="file_error"></p></span> 
                            </div> 
                            <!-- <input type="file" name="crop_image" class="crop_image" id="upload_image" /> -->
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" name="add_game" class="btn w-auto btn-primary btn-block" >Add Game</button>
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
                    url:'add-new-game.php',
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
