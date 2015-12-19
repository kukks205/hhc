<?php

include '../includes/DBConn.php';

$obj = $db->query("select village_id,village_moo,village_name,village_code,latitude,longitude,doctor_code from village where village_moo>0 order by village_code ", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print('{"records":' . $txt . '}');
?>
