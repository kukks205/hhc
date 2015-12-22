<?php
$sql = "select h.house_id,h.village_id,h.address,h.road,h.latitude,h.longitude,v.village_moo,v.village_name,hi.house_image_id 
from house as h
join village as v on v.village_id=h.village_id
left join house_image as hi on hi.house_id=h.house_id
where h.latitude and h.longitude is not null and h.village_id='" . $_REQUEST['villcode'] . "'";
$lat = $getData->GetStringData("select latitude as cc from village where village_id='" . $_REQUEST['villcode'] . "'");
$lon = $getData->GetStringData("select longitude as cc from village where village_id='" . $_REQUEST['villcode'] . "'");
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
            var house_image_id = [];
            // Adding a LatLng object for each city
<?php
while ($row = $result->fetch()) {
    ?>
                places.push(new google.maps.LatLng("<?= $row['latitude'] ?>", "<?= $row['longitude'] ?>"));
                address.push("<?= $row['address'] ?>");
                village_moo.push("<?= $row['village_moo'] ?>");
                village_name.push("<?= $row['village_name'] ?>");
                house_id.push("<?= $row['house_id'] ?>");
                house_image_id.push("<?= $row['house_image_id'] ?>");

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

                        if (house_image_id[i]) {
                            var strImg = '<img src="includes/house_image.php?hid='+house_id[i]+'" height="120" align="center" />';
                        } else {
                            var strImg = '<img src="img/no_image.png" height="120" align="center" />';
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
        margin-top: 0px;
        height: 100%;
        width: 100%;
        position : absolute !important; 
        top : 0px !important;  
        right : 0;
        bottom : 0px !important;  
        left : 0 !important;        
    }
</style>  

<div role="main" class="ui-content" id="map">
    <center>
        <h4>กดปุ่มแสดงแผนที่หากภาพแผนที่ไม่ปรากฏครับ</h4>
        <input type="button" value="แสดงแผนที่" data-inset="false" data-theme="b" data-inline="true" data-mini="true" data-icon="grid" onClick="reloadURL();"/>
    </center>
</div>

<div data-role="footer" data-position="fixed" data-theme="d">
    <div data-role="navbar">
        <ul>
            <li>
                <a href="#map_menu" data-inline="true" data-icon="bullets" data-mini="true" >
                    ตัวเลือกแผนที่
                </a>
            </li> 
        </ul>
    </div>
</div>


    
        <div data-role="panel" id="map_menu" data-position="right" data-display="push">
        <ul data-role="listview" data-inset="false" data-theme="a">
            <li data-role="list-divider" data-theme="<?=$theme;?>">
                <h4 align="center">:: เลือกแผนที่ ::</h4>
            </li>
            <li  data-icon="false">
                <a href="index.php">
                <i class="ion-home" style="font-size: 27px;"></i>  หลังคาเรือนทั้งหมด    
                </a>
                
            </li>
            <li   data-icon="false">
                <a href="index.php">
                <i class="ion-heart" style="font-size: 27px;"></i>  ผู้ป่วยDM/HT
                </a>
            </li>
            <li   data-icon="false">
                <a href="index.php">
                <i class="ion-android-social" style="font-size: 27px;"></i>  บ้าน อสม.
                </a>
            </li>
            <li   data-icon="false">
                <a href="index.php">
                <i class="ion-bug" style="font-size: 27px;"></i>  เฝ้าระวังโรคติดต่อ
                </a>
            </li>             

        </ul>
        <!-- panel content goes here -->
    </div>