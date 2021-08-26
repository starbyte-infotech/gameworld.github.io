<?php
session_start();
include("header.php"); 
include("config.php");
if(!isset($_SESSION['userlogin'])){
    header("location:login.php");
}

$get_category = "SELECT * FROM `tbl_category`";
$res_category = mysqli_query($conn, $get_category);

if(isset($_POST['add_game'])){

    $category = $_POST['category'];
    $name = $_POST['name'];
    $plays = $_POST['plays'];
    $color = $_POST['color'];
   
    // start upload zipfile to directory

    // $output = '';  
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
                        // $output .= '<div class="col-md-6"><div style="padding:16px; border:1px solid #CCC;"><img src="upload/'.$new_name.'" width="170" height="240" /></div></div>';  
                        copy($path.$zipfile_name.'/'.$file, $path . $new_name);  
                        unlink($path.$name.'/'.$file);  
                    }       
                }  
                unlink($location);  
                rmdir($path . $name);  
            }  
        }  
    }  

    // End upload zip file

    $game_img = $_FILES["img"]["name"]; 
    $game_temp = $_FILES["img"]["tmp_name"];   
    $new_img_name = rand().'_'.$game_img;
    $folder = "images/".$new_img_name;
    if (move_uploaded_file($game_temp, $folder))  {

        $sql = "INSERT INTO `tbl_games`(`id`, `name`, `category`, `plays`, `bottom_color`, `image`, `game_code` ,created_at) VALUES (NULL, '$name','$category', '$plays', '$color', '$new_img_name', '$zipfile_name', current_timestamp())";
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

    // -------------------------------------------------------------------

  
}
?>
<style type="text/css">
    .preview {
      overflow: hidden;
      width: 160px; 
      height: 200px;
      margin: 10px;
      border: 1px solid red;
    }
    .modal-lg{
      max-width: 1000px !important;
    }
    img {
  display: block;
  max-width: 100%;
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
                        <form  action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Select Game Category</label>
                                        <select class="form-control" aria-label="Default select example" name="category">
                                            <option selected>Open this select cateory</option>
                                        <?php while($fetch_cat = mysqli_fetch_array($res_category)){ ?>
                                            <option value="<?php echo $fetch_cat['id'] ?>"><?php echo $fetch_cat['name'] ?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label>Game Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Game Name"
                                            value="" name="name">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label>Game plays</label>
                                        <input type="text" class="form-control" placeholder="Enter Game Plays"
                                            value="" name="plays">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label>Game bottom color</label>
                                        <input type="color" class="form-control color-type" placeholder="Enter Botoom Color" value="" name="color">
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <input type="file" name="image" class="image" >
                            </div>
                            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">PHP Crop Image Before Upload using Cropper JS - NiceSnippets.com</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="img-container">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="preview"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload Game Photo</label>
                                        <input type="file" accept="image/*" id="img" class="img" name="img" onchange="loadFile(event)">
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
                            </div>   
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" name="add_game" class="btn w-auto btn-primary btn-block" >Add Game</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- modal crop -->
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">PHP Crop Image Before Upload using Cropper JS - NiceSnippets.com</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="img" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script>

var $modal = $('#modal');
var image = document.getElementById('image');
var cropper;
  
$("body").on("change", ".image", function(e){
    var files = e.target.files;
    var done = function (url) {
      image.src = url;
      $modal.modal('show');
      var output = document.getElementById('output');
      output.src = url;
    };
    var reader;
    var file;
    var url;

    if (files && files.length > 0) {
      file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
});

$modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
    aspectRatio: 1,
    viewMode: 3,
    preview: '.preview'
    });
}).on('hidden.bs.modal', function () {
   cropper.destroy();
   cropper = null;
});

$("#crop").click(function(){
    canvas = cropper.getCroppedCanvas({
      width: 160,
      height: 200,
    });

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
         reader.readAsDataURL(blob); 
         reader.onloadend = function() {
            var base64data = reader.result;  
            
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "upload.php",
                data: {image: base64data},
                success: function(data){
                    console.log(data);
                    $modal.modal('hide');
                    alert("success upload image");
                }
              });
         }
    });
})

</script>
<?php include("footer.php"); ?>
