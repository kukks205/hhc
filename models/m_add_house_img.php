<?php
$hid = $_POST['hid'];
if (!empty($_POST['image_number'])):
    $img_number = $_POST['image_number'];
else:
    $img_number = '0';
endif;

if (!empty($_POST['image_description'])):
    $image_description = $_POST['image_description'];
else:
    $image_description = 'ไม่ระบุ';
endif;


 $img = new ImageDB();
 $img->houseImgUpload($hid, $_FILES["imgupload"], $image_description, $img_number);

  echo "<script> ";
  echo"alert('บันทึกเสร็จเรียบร้อยครับ')";
  echo "</script> ";

  echo "<script>";
  echo "window.location='index.php?url=views/familyfolder/familyfolder.php&hid=$hid';";
  echo "</script>"; 
?>
