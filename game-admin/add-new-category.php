<?php 
session_start();
include("header.php");
include("config.php");
if(!isset($_SESSION['userlogin'])){
    header("location:login.php");
}

if(isset($_POST['add_category'])){ 
    $name = $_POST['name'];
    echo $png = $_POST['png']; die();
    // $cat_img = $_FILES["img"]["name"];
    // $new_cat_img = rand().'_'.$cat_img;
    // $cat_temp = $_FILES["img"]["tmp_name"];   
    // $folder = "images/".$new_cat_img;
   echo $sql = "INSERT INTO `tbl_category`(`name`, `icon`, `png`) VALUES ('$name','null','$icon')"; die();
    $res = mysqli_query($conn, $sql);  
    if($res){
        echo "<script>alert('Category Successfuly Added');</script>";
    }else{
        echo "<script>alert('Failed to Add Category');</script>";
    }
    // if (move_uploaded_file($cat_temp, $folder))  {
    //     $msg = "Image uploaded successfully";
    // }else{
    //     $msg = "Failed to upload image";
    // }
}

?>
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Add New Category</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" class="form-control" value="" name="name" placeholder="Add Category">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload Category Icon</label>
                                        <input type="file" id="img" name="img" onchange="loadFile(event)">
                                        <input type="text" class="form-control" placeholder="Home Address"
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
                            </div> -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Add Value for Icon</label>
                                        <input type="text" name="png" class="form-control" placeholder="Font Awesome Value">                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" name="add_category" class="btn w-auto btn-primary btn-block" >Add Category</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include("footer.php"); ?>