<?php
$sql = "select h.hcode,h.villcode,h.hid,h.hno,h.xgis,h.ygis,v.villno,v.villname from house as h
join village as v on v.villcode = h.villcode where h.villcode='".$_GET['villcode']."'";


$lat = $data->GetStringData("select latitude as cc from village where villcode='" . $_GET['villcode']."'");
$lon = $data->GetStringData("select longitude as cc from village where villcode='" . $_GET['villcode']."'");
$result = $db->query($sql, PDO::FETCH_ASSOC);
?>
<script type="text/javascript" language="javascript">
    function reloadURL() {
        window.location.reload();
    }
</script> 



<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

<script>

    (function () {
        window.onload = function () {

            var options = {
                zoom: 18,
                scaleControl: true,
                center: new google.maps.LatLng(<?= $lat ?>, <?= $lon ?>),
                mapTypeId: google.maps.MapTypeId.HYBRID,
                mapTypeControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.TOP_RIGHT
                },
                panControl: false,
                streetViewControl: true,
                streetViewControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_BOTTOM
                },
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.LAGRE,
                    position: google.maps.ControlPosition.RIGHT_BOTTOM
                },
                disableDefaultUI: true
            };


            // Creating the map
            var map = new google.maps.Map(document.getElementById('map'), options);
            // Creating an array that will contain the coordinates



            var places = [];
            var house_id = [];
            var address = [];
            var village_moo = [];
            var village_name = [];
            //var house_image_id = [];
            // Adding a LatLng object for each city
<?php
while ($row = $result->fetch()) {
    ?>
                places.push(new google.maps.LatLng("<?= $row['ygis'] ?>", "<?= $row['xgis'] ?>"));
                address.push("<?= $row['hno'] ?>");
                village_moo.push("<?= $row['villno'] ?>");
                village_name.push("<?= $row['villname'] ?>");
                house_id.push("<?= $row['hcode'] ?>");

    <?php
}
?>

            // Looping through the places array 

            for (var i = 0; i < places.length; i++) {

                var icon = {
                    url: 'http://chart.apis.google.com/chart?chst=d_map_spin&chld=0.7|0|FF0001|11|b|' + address[i],
                    origin: new google.maps.Point(0, 0)
                };


                // Adding the marker as usual
                var marker = new google.maps.Marker({
                    position: places[i],
                    map: map,
                    title: 'บ้านเลขที่ ' + address[i],
                    icon: icon
                });

                // Wrapping the event listener inside an anonymous function
                (function (i, marker) {

                    // Creating the event listener. It now has access to the values
                    google.maps.event.addListener(marker, 'click', function () {

                        if (house_id[i]) {
                            var strImg = '<img src="images/no_image.gif" height="120" align="center" />';
                        }
                        else {
                            var strImg = '<img src="images/no_image.gif" height="120" align="center" />';
                        }
                        var strInfo = '<div align="center">' +
                                strImg +
                                '</div><hr>' +
                                '<div><b>บ้านเลขที่ </b> ' +
                                address[i] +
                                ' ม.' + village_moo[i] + ' [' + village_name[i] + '] </div>' +
                                "<br><input type=button onClick=\"location.href='index.php?m=familyfolder&a=family_folder&house_id=" + house_id[i] + "'\" value='รายละเอียด'></div></div>";

                        var infowindow = new google.maps.InfoWindow({
                            content: strInfo
                        });
                        infowindow.open(map, marker);
                    });
                })(i, marker);

            }

        }
    })();


</script> 

<style>
    #map {
        padding: 0px;
        height: 90%;
        width: 100%;
        position : absolute !important; 
        top : 40px !important;  
        right : 0; 
        bottom : 0px !important;  
        left : 0 !important;        
    }
</style>  



<div id="map">
    <center>
        <h4>กดปุ่มแสดงแผนที่หากภาพแผนที่ไม่ปรากฏครับ</h4>
        <input type="button" value="แสดงแผนที่" data-inset="false" data-theme="b" data-inline="true" data-mini="true" data-icon="grid" onClick="reloadURL();"/>
    </center>
</div>




<div data-role="footer" data-position="fixed" data-theme="f">
    <div data-role="navbar">
        <ul>
            <li>
                <a href="index.php?url=<?=$encode->encodeUrl('page/familyfolder/comunity.php')?>&village_id=<?=$_GET['villcode']?>" data-icon="home">
                    แฟ้มชุมชน</a>
            </li>
            <li>
                <a href="#menu" data-icon="grid" data-rel="dialog" data-inline="true" >เมนูแผนที่</a>
            </li>
            <li>
                <a href="#menu" data-icon="location" data-rel="dialog" data-inline="true" >แผนที่ตำบล</a>
            </li>
        </ul>
    </div>
</div>


<style>
    #menu {
        padding: 0px;
        width: 15em;
        position : absolute !important; 
        top : 42px !important;  
        right : 0; 
        bottom : 0px !important;  
        left : 0 !important;        
    }
</style>
<div data-role="panel" id="menu" data-display="overlay" data-position="left" data-theme="e" data-position-fixed="true">   
        <ul data-role="listview" data-inset="false" style="min-width:200px;" data-theme="a">
        <li data-role="list-divider" data-theme="g" data-rel="close">เลือกประเภทแผนที่</li>
        <li><a href="# ">แสดงหลังคาเรือน</a></li>
        <li><a href="index.php?url=<?=$encode->encodeUrl('page/map/map_dmht.php')?>&villcode=<?=$_GET['villcode']?>">ผู้ป่วย DM&HT</a></li>
        <li><a href="#">Home Ward</a></li>
    </ul>

</div>



<!--<div data-role="popup" id="popupMenu" data-theme="a">
    <ul data-role="listview" data-inset="true" style="min-width:200px;" data-theme="a">
        <li data-role="list-divider" data-theme="g">ประเภทแผนที่</li>
        <li><a href="# ">แสดงหลังคาเรือน</a></li>
        <li><a href="# ">ผู้ป่วย DM&HT</a></li>
        <li><a href="#">Home Ward</a></li>
    </ul>
</div>-->

