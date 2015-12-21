<style>
    @media ( min-width: 50em ) {
        /* Show the table header rows and set all cells to display: table-cell */
        .my-custom-breakpoint td,
        .my-custom-breakpoint th,
        .my-custom-breakpoint tbody th,
        .my-custom-breakpoint tbody td,
        .my-custom-breakpoint thead td,
        .my-custom-breakpoint thead th {
            display: table-cell;
            margin: 0;
        }
        /* Hide the labels in each cell */
        .my-custom-breakpoint td .ui-table-cell-label,
        .my-custom-breakpoint th .ui-table-cell-label {
            display: none;
        }
    }
</style>

<style type="text/css">
/* css กำหนดความกว้าง ความสูงของแผนที่ */
#map_canvas { 
	width:100%;
	height:500px;
	padding:0px;
	margin:0px;
}
</style>
<script type="text/javascript" language="javascript">
    function reloadURL() {
        window.location.reload();
    }
</script> 
<?php
$lat = $getData->GetStringData('select latitude as cc from house where house_id=' . $_REQUEST['hid']);
$lon = $getData->GetStringData('select longitude as cc from house where house_id=' . $_REQUEST['hid']);
$address = $getData->GetStringData('select address as cc from house where house_id=' . $_REQUEST['hid']);
?>
 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script type="text/javascript">
    
    $(document).on("pageinit",function(){
  initialize();
 
});

  
    var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
    var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
    var geocoder; // กำหนดตัวแปร สำหรับใช้งานข้อมูลสถานที่จาก Google Map

    
    function initialize() { // ฟังก์ชันแสดงแผนที่
	GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
       
        // กำหนดจุดเริ่มต้นของแผนที่
	var my_Latlng  = new GGM.LatLng(<?=$lat ?>,<?=$lon ?>);
	
	// เรียกใช้งานข้อมูล Geocoder ของ Google Map
	geocoder = new GGM.Geocoder();
        
        
	// กำหนดรูปแบบแผนที่ที่แสดงgoogle.maps.MapTypeId.SATELLITE
	var my_mapTypeId=GGM.MapTypeId.HYBRID; 
	
        // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
	var my_DivObj=$("#map_canvas")[0]; 
	
    
        // กำหนด Option ของแผนที่
	var myOptions = {
		zoom: 16, // กำหนดขนาดการ zoom
		center: my_Latlng , // กำหนดจุดกึ่งกลาง
		mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่
	};
        
        
        
        // สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map
	map = new GGM.Map(my_DivObj,myOptions);
        
        
	// สร้างตัว marker
	var my_Marker = new GGM.Marker({
		position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
		map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
		draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้
		title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
	});
        
        
        
	
	// กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
	GGM.event.addListener(my_Marker, 'dragend', function() {
		var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
        map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker		
		
        // เรียกขอข้อมูลสถานที่จาก Google Map
        geocoder.geocode({'latLng': my_Point}, function(results, status) {
		  if (status == GGM.GeocoderStatus.OK) {
			if (results[1]) {
				// แสดงข้อมูลสถานที่ใน textarea ที่มี id เท่ากับ place_value
			  $("#place_value").val(results[1].formatted_address); // 
			}
		  } else {
			  // กรณีไม่มีข้อมูล
			alert("Geocoder failed due to: " + status);
		  }
		});		
	});		

	// กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
	GGM.event.addListener(map, 'zoom_changed', function() {
		$("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value 	
	});

}
  
$(function(){

	$("<script/>", {
	  "type": "text/javascript",
	  src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&callback=initialize"
	}).appendTo("body");	
});
</script>  
<div role="main" class="ui-content"  ng-app="myApp" >
    <div data-role="header" data-theme="<?= $theme ?>">
        <h1>E-Family Folder บ้านเลขที่ : <?php echo $getData->GetStringData("select concat(h.address,' ม.',v.village_moo) cc  from house h join village v on (v.village_id=h.village_id) where house_id='" . $_REQUEST['hid'] . "'"); ?></h1>
    </div>

<?php $villcode=$getData->GetStringData("select v.village_id cc  from house h join village v on (v.village_id=h.village_id) where house_id='" . $_REQUEST['hid'] . "'"); ?>

    <div data-role="tabs" id="tabs" data-theme="a">
        <div data-role="header" data-theme="a">
            <div data-role="navbar">
                <ul>
                    <li><a href="#house" data-ajax="false">ทะเบียนบ้าน</a></li>
                    <li><a href="#personList" data-ajax="false">ชื่อสมาชิก</a></li>
                    <li><a href="#survey" data-ajax="false">ข้อมูลสำรวจ</a></li>
                    <li><a href="#map" data-ajax="false">แผนที่บ้าน</a></li>
                    <li><a href="#pic" data-ajax="false">รูปบ้าน</a></li>
                </ul>
            </div>
        </div>

        <div id="house" ng-controller="houseCtrl">
            <ul data-role="listview"  data-theme="a" data-divider-theme="a" data-inset="true" >
                <li data-role="list-divider" >
                    <h4>ข้อมูลทะเบียนบ้าน
                        <a href="#" data-role="button" data-inline="true" data-icon="edit" data-iconpos="notext" data-theme="a" data-mini="true" data-ajax="false">แก้ไข</a>
                    </h4>
                </li>
                <li>     
                    <div class="ui-grid-a">
                        <div class="ui-block-a">
                            <div class="ui-bar" style="height:100%">
                                <div class="ui-field-contain"> 
                                    <label for="census_id">เลขทะเบียนบ้าน:{{house.length}}</label>
                                    <input type="text" data-mini="true" readonly="true" name="census_id" id="census_id" value="{{house[0].census_id}}">
                                </div> 
                                <div class="ui-field-contain">
                                    <label for="address">บ้านเลขที่:</label>
                                    <input type="text" data-mini="true" readonly="true"  name="address" id="address" value="{{house[0].address}}">
                                </div>
                                <div class="ui-field-contain">
                                    <label for="road">ถนน:</label>
                                    <input type="text" data-mini="true" readonly="true"  name="road" id="road" value="{{house[0].road}}">
                                </div>
                                <div class="ui-field-contain">
                                    <label for="head_person">เจ้าบ้าน:</label>
                                    <input type="text" data-mini="true" readonly="true"  name="head_person" id="head_person" value="{{house[0].head_name}}">
                                </div>
                                <div class="ui-field-contain">
                                    <label for="latitude">Latitude:</label>
                                    <input type="text" data-mini="true" readonly="true" name="latitude" id="latitude" value="{{house[0].latitude}}">
                                </div>                
                            </div>
                        </div>
                        <div class="ui-block-b">
                            <div class="ui-bar" style="height:100%">
                                <div class="ui-field-contain">
                                    <label for="house_type">ชนิดของที่อยู่อาศัย:</label>
                                    <input type="text" data-mini="true" readonly="true" name=house_type" id="house_type" value="{{house[0].house_type_name}}">
                                </div> 
                                <div class="ui-field-contain">
                                    <label for="location">Location:</label>
                                    <input type="text" data-mini="true" readonly="true"  name="location" id="location" value="{{house[0].location_area_name}}">
                                </div>
                                <div class="ui-field-contain">
                                    <label for="house_subtype">ลักษณะของที่อยู่:</label>
                                    <input type="text" data-mini="true" readonly="true" name="house_subtype" id="house_subtype" value="{{house[0].house_subtype_name}}">
                                </div>
                                <div class="ui-field-contain">
                                    <label for="house_name">ชื่อหมู่บ้านจัดสรร:</label>
                                    <input type="text" data-mini="true" readonly="true" name="house_condo_name" id="house_condo_name" value="{{house[0].house_condo_name}}">
                                </div>
                                <div class="ui-field-contain">
                                    <label for="longitude">Longitude:</label>
                                    <input type="text" data-mini="true" readonly="true" name="longitude" id="longitude" value="{{house[0].longitude}}">
                                </div>                 
                            </div>
                        </div>
                    </div>


                </li>
            </ul>
        </div>


        <div id="personList" ng-controller="personCtrl">
            <div ng-hide="dataload.loaded == true">
                <div align='center'><i class="icon ion-loading-c" style="font-size: 32px;"></i> กำลังประมวลผล...</div>
            </div>
            <ul data-role="listview" data-inset="true">
                <li data-role="list-divider" >
                    <h4>รายชื่อสมาชิกในครัวเรือน</h4>
                </li>
                <li ng-repeat="p in person" data-icon="false">
                    <a href="#" data-ajax='false'>
                        <img src="includes/person_image.php?pid={{p.person_id}}" width="100" align="center" ng-if="p.img == 3"/> 
                        <img src="img/no-image-man.png" alt="" width="100" align="center" ng-if="p.img == 1"/>
                        <img src="img/no-pic-girl.png" alt="" width="100" align="center" ng-if="p.img == 2"/>
                        <h4>{{$index + 1}}. ชื่อ : {{p.person_name}}</h4>
                        <p>CID: {{p.cid}}  </p>
                        <span class="ui-li-count">{{p.age_y}} ปี</span>
                    </a>
                </li> 
                <li>จำนวนสามาชิก:{{person.length}}</li>
            </ul>
        </div>



        <div id="survey" ng-controller="surveyCtrl">
            <ul data-role="listview" data-inset="true" data-mini="true">
                <li data-role="list-divider">
                    <div>ข้อมูลการสำรวจครัวเรือน
                        <a href="#" data-role="button" data-inline="true" data-icon="edit" data-iconpos="notext" data-theme="a" data-mini="true" data-ajax="false">แก้ไข</a>
                        <a href="#" data-role="button" data-inline="true" data-icon="plus" data-iconpos="notext" data-theme="a" data-mini="true" data-ajax="false">เพิ่ม</a>
                    </div>
                </li>
                <li>
                    <div ng-hide="dataload.loaded == true">
                        <div align='center'><i class="icon ion-loading-c" style="font-size: 32px;"></i> กำลังประมวลผล...</div>
                    </div>
                       <table data-role="table" id="temp-table" data-mode="reflow" class="ui-responsive table-stroke" data-filter="true">   
                        <thead>
                            <tr>
                            </tr>
                            <tr>
                                <th data-priority="1" >ลำดับ</th>
                                <th data-priority="2" >ข้อมูลการสำรวจ</th>
                                <th data-priority="3" >ผลการสำรวจ</th>
                                <th data-priority="4" >วันที่ปรับปรุงข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr ng-repeat="s in survey">
                                <th>{{$index + 1}}</th>
                                <td>{{s.house_survey_item_name}}</td>
                                <td>{{s.house_item_value_text}}</td>
                                <td>{{s.s_date}}
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </li>
            </ul>
        </div>

<div id="map">
<ul data-role="listview"  data-theme="a" data-filter="false" data-inset="true" >
    <li data-role="list-divider">
        <div>แผนที่บ้าน
            <a href="index.php?m=familyfolder&a=house_directions&house_id=<?=$_REQUEST['house_id']?>" data-role="button" data-inline="true" data-icon="navigation" data-iconpos="notext" data-theme="c" data-mini="true">นำทาง</a>
            <a href="#" onclick="reloadURL()" data-role="button" data-inline="true" data-icon="refresh" data-iconpos="notext" data-theme="c" data-mini="true">reload</a>
        </div>

    </li>
    <li>
        <div id="map_canvas" onLoad="initialize()"></div>
    </li>
</ul>  
</div>




        <div id="pic">
            PIC 
        </div>
    </div>



</div>

<div data-role="footer" data-position="fixed" data-theme="<?= $theme; ?>">
    <div data-role="navbar">
        <ul>
            <li>
                <a href="#" data-ajax="false" data-inline="true" data-icon="back" data-mini="true" >
                    back
                </a>
            </li> 
            <li>
                <a href="about/about.php" data-icon="user" data-rel="dialog" data-inline="true" >About</a>
            </li>
        </ul>
    </div>
</div>
<script>
    var myApp = angular.module('myApp', []);
    //แสดงรายชื่อผู้รับบริการ
    myApp.controller('personCtrl', function ($scope, $http) {
        //กำหนดตัวแปรที่จะแสดงสถานะการ load
        $scope.dataload = {};
        var dataloaded = $scope.dataload;
        //กำหนดตัวแปรที่จะแสดงสถานะการ load ว่ายังไม่เสร็จ
        dataloaded.loaded = false;

        $http.get("models/m_person_list.php?hid=<?= $_REQUEST['hid'] ?>")
                .success(function (response) {
                    $scope.person = response.records;
                    //กำหนดตัวแปรที่จะแสดงสถานะการ load ว่าเสร็จแล้ว
                    dataloaded.loaded = true;
                });
    });
    myApp.controller('houseCtrl', function ($scope, $http) {
        //กำหนดตัวแปรที่จะแสดงสถานะการ load
        $scope.dataload = {};
        var dataloaded = $scope.dataload;
        //กำหนดตัวแปรที่จะแสดงสถานะการ load ว่ายังไม่เสร็จ
        dataloaded.loaded = false;

        $http.get("models/m_house_detail.php?hid=<?= $_REQUEST['hid'] ?>")
                .success(function (response) {
                    $scope.house = response.records;
                    //กำหนดตัวแปรที่จะแสดงสถานะการ load ว่าเสร็จแล้ว
                    dataloaded.loaded = true;
                });

    });
    myApp.controller('surveyCtrl', function ($scope, $http) {
        //กำหนดตัวแปรที่จะแสดงสถานะการ load
        $scope.dataload = {};
        var dataloaded = $scope.dataload;
        //กำหนดตัวแปรที่จะแสดงสถานะการ load ว่ายังไม่เสร็จ
        dataloaded.loaded = false;

        $http.get("models/m_house_survey.php?hid=<?= $_REQUEST['hid'] ?>")
                .success(function (response) {
                    $scope.survey = response.records;
                    //กำหนดตัวแปรที่จะแสดงสถานะการ load ว่าเสร็จแล้ว
                    dataloaded.loaded = true;
                });

    });
   
</script>

