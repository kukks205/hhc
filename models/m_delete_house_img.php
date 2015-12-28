<?php
$hiid = $_REQUEST['hiid'];
$hid = $_REQUEST['hid'];
$sql="delete from house_image where house_image_id='$hiid'";
$db->exec($sql);

  echo "<script> ";
  echo"alert('ลบรูปเสร็จเรียบร้อยครับ')";
  echo "</script> ";

  echo "<script>";
  echo "window.location='index.php?url=views/familyfolder/familyfolder.php&hid=$hid';";
  echo "</script>"; 
?>