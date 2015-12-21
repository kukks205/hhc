<?php

include '../includes/DBConn.php';
$hid = $_REQUEST['hid'];

$obj = $db->query("select h.house_id,h.village_id,h.address,house_subtype_name,census_id,road,location_area_name,
latitude,longitude,house_condo_name,doctor_code,head_person_id,house_type_name,concat(p.pname,p.fname,'  ',p.lname) as head_name
from house h left join house_subtype hs on (h.house_subtype_id=hs.house_subtype_id) 
left join house_type ht on (h.house_type_id=ht.house_type_id)
left join person p on (h.head_person_id=p.person_id)
left join house_location_area hl on(h.location_area_id=hl.location_area_id) where  h.house_id='$hid'", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print('{"records":' . $txt . '}');
?>
