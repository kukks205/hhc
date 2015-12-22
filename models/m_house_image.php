<?php
include '../includes/DBConn.php';
$hid = $_REQUEST['hid'];
$sql="select house_image_id,house_id,image_number,
image_description,image_taken_date 
from  house_image
where house_id = '$hid' order by house_image_id ";

$obj = $db->query($sql, PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print('{"records":' . $txt . '}');
?>

