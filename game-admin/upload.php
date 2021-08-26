<?php
$folderPath = 'images/';

$image_parts = explode(";base64,", $_POST['image']);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
$file = $folderPath . uniqid() . '.png';
$image_name = addslashes(file_put_contents($file, $image_base64));

$query = "INSERT INTO tbl_images(images) VALUES ('".$image_name."')";
echo json_encode(["image uploaded successfully."]);
?>