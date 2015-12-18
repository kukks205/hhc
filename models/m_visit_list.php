<?php

include '../includes/DBConn.php';
$startdate = $_REQUEST['startdate'];
$enddate = $_REQUEST['enddate'];
$spclty=$_REQUEST['spclty'];

$obj = $db->query("select concat(p.pname,p.fname,' ',p.lname) as ptname,o.vn ,
concat(DATE_FORMAT(o.vstdate,'%d/%m'),'/',YEAR(o.vstdate)+543) as service_date,o.vstdate,o.vsttime,p.sex,ov.cc,d.name,se.seq_id,v.age_y,p2.person_id,i.name as diag,
o.spclty,spclty.name as dep,if(pi.person_id is null,(if(p.sex=1,1,2)),3) as img
from ovst o 
join patient p on (p.hn=o.hn) 
join person p2 on (p2.cid=p.cid) 
join vn_stat v on (v.vn=o.vn) 
join icd101 i on (v.pdx=i.code) 
left join doctor d on (d.code=v.dx_doctor) 
join spclty on (spclty.spclty=o.spclty)
join opdscreen ov on (ov.vn=o.vn) 
join ovst_seq se on (se.vn=o.vn) 
left join person_image pi on p2.person_id=pi.person_id
where o.vstdate between '$startdate' and '$enddate'
order by o.vstdate,o.vsttime", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print('{"records":' . $txt . '}');
?>
