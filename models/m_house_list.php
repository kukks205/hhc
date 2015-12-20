<?php

include '../includes/DBConn.php';
$villcode = $_REQUEST['village_id'];

$obj = $db->query("select 
h.house_id,h.village_id,h.address,h.road,concat(p.pname,p.fname,'  ',p.lname) as name,hp.house_id,
if(hp.house_id is null,false,true) as img
from
house as h
join person as p on h.head_person_id = p.person_id
left join house_image hp on h.house_id=hp.house_id
where
h.village_id = '$villcode'
group by h.house_id
order by
h.address asc", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print('{"records":' . $txt . '}');
?>
