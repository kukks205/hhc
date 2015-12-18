<?php
ob_start();
include 'ImgClass.php';
$hid=$_REQUEST['hid'];
$blobObj = new ImageDB();
$a = $blobObj->HouseImage($hid);
header("Content-Type: image/jpeg");
echo $a['pic'];
?>
