<meta charset="UTF-8">
<?php
//include '../includes/DBConn.php';
$hiid = $_POST['hiid'];
$hid = $_POST['hid'];
$img_number = $_POST['image_number'];
$image_description=$_POST['image_description'];

$sql="update house_image set image_description='$image_description',image_number='$img_number',image_taken_date=DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i:%s') where house_image_id='$hiid' ";
$db->exec($sql);
//echo  $sql;

   echo "<script> ";
    echo"alert('บันทึกเสร็จเรียบร้อยครับ')";
    echo "</script> ";

    echo "<script>";
    echo "window.location='index.php?url=views/familyfolder/familyfolder.php&hid=$hid';";
    echo "</script>";

?>
