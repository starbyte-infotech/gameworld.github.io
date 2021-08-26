<?php
include('../config.php');
if(isset($_POST['action']) && !empty($_POST['action']) == 'fetch_details') {

    $game_id = $_POST['game_id'];
    $game_data = "SELECT * FROM `tbl_games` WHERE `id` = '$game_id'";
    $res_game = mysqli_query($conn, $game_data);
    $fetch_data = mysqli_fetch_assoc($res_game); ?>

    <div class="div_change" id="div_change">
        <div class="row">
            <div class="col-md-4 pr-1">
                <div class="form-group">
                    <label>Game Name</label>
                    <input type="text" class="form-control" placeholder="Game Name" name="name" value="<?php echo $fetch_data['name'] ?>">
                </div>
            </div>
            <div class="col-md-4 pl-1">
                <div class="form-group">
                    <label>Game plays</label>
                    <input type="text" class="form-control" placeholder="Game Plays" name="plays" value="<?php echo $fetch_data['plays'] ?>">
                </div>
            </div>
            <div class="col-md-4 pl-1">
                <div class="form-group">
                    <label>Game bottom color</label>
                    <input type="color" class="form-control color-type" placeholder="Bottom Color" name="color" value="<?php echo $fetch_data['bottom_color'] ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Update Game Photo</label>
                    <img src="<?php echo  $dir.'/images/'. $fetch_data['image'] ?>" width="80" height="80">
                    <!-- <input type="file" id="image" name="image" accept="image/*"> -->
                    <input type="file"  accept="image/*" name="crop_image" class="crop_image" id="upload_image">
                    <input type="text" class="form-control" placeholder="Game Image" value="SELECT PHOTO">
                </div>
            </div>  
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Update Game Code</label>                    
                    <input type="file" name="zipfile_code" id="zipfile_code" >
                    <input type="text" class="form-control" placeholder="Game Code" value="SELECT FILE/FOLDER">
                    <?php 
                    $game_code = $dir.'/games/'. $fetch_data['game_code'];
                    $pathFragments = explode('/', $game_code);
                    $end = end($pathFragments);
                    ?>
                    <p value="<?php echo $game_code; ?>"><?php echo $end; ?></p>
                </div>
            </div>
        </div>
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
<?php } ?>
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