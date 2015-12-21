<?php

include '../includes/DBConn.php';
$hid = $_REQUEST['hid'];

$obj = $db->query("select h.village_id,h.address,hs.house_survey_id,hs.survey_date,
        hsi.house_survey_item_name,hsd.house_item_value_text,
        concat(DATE_FORMAT(hs.survey_date,'%d/%m'),'/',YEAR(hs.survey_date)+543) as s_date
        from house h
        left join house_survey hs on h.house_id=hs.house_id
        join house_survey_detail hsd on hsd.house_survey_id=hs.house_survey_id
        join house_survey_item hsi on hsi.house_survey_item_id=hsd.house_survey_item_id
        where h.house_id='$hid' and hs.survey_date=(select max(survey_date) from house_survey where house_id='$hid'  ) 
        order by  hs.house_survey_id,hsd.house_survey_item_id", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print('{"records":' . $txt . '}');
?>
