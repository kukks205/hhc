<?php

include '../includes/DBConn.php';
$hid = $_REQUEST['hid'];

$obj = $db->query("select p.person_id,p.cid,if(pi.person_id is null,(if(p.sex=1,1,2)),3) as img,
concat(p.pname,' ',p.fname,' ',p.lname) as person_name,
p.sex,p.age_y 
from person as p 
left join person_image pi on p.person_id=pi.person_id
where p.death<>'y' and p.person_discharge_id='9'  and p.house_id='$hid' order by p.age_y desc", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print('{"records":' . $txt . '}');
?>
