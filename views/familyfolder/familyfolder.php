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
<?php
$hid = $_REQUEST['hid']
?>

<div data-role="content"  ng-app="myApp" >
    
    <div data-role="header" data-theme="<?= $theme ?>">
        <h1>E-Family Folder บ้านเลขที่ : <?php echo $getData->GetStringData("select concat(h.address,' ม.',v.village_moo) cc  from house h join village v on (v.village_id=h.village_id) where house_id='" . $_REQUEST['hid'] . "'"); ?></h1>
    </div>

    <?php $villcode = $getData->GetStringData("select v.village_id cc  from house h join village v on (v.village_id=h.village_id) where house_id='" . $_REQUEST['hid'] . "'"); ?>

    <div data-role="tabs" id="tabs" data-theme="a">
        <div data-role="header" data-theme="a">
            <div data-role="navbar">
                <ul>

                    <li><a href="#house" data-ajax="false">ทะเบียนบ้าน</a></li>
                    <li><a href="#personList" data-ajax="false">ชื่อสมาชิก</a></li>
                    <li><a href="#survey" data-ajax="false">ข้อมูลสำรวจ</a></li>
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
                <li data-role="list-divider">
                    <div>
                        แผนที่บ้าน
                        <a href="index.php?m=familyfolder&a=house_directions&house_id=<?= $_REQUEST['house_id'] ?>" data-role="button" data-inline="true" data-icon="navigation" data-iconpos="notext" data-theme="c" data-mini="true">นำทาง</a>
                    </div>
                </li>
                <li>
                <ng-map  center="{{house[0].latitude}},{{house[0].longitude}}" zoom="16" map-type-id="HYBRID">
                    <marker position="{{house[0].latitude}},{{house[0].longitude}}" title="แผนที่บ้าน">
                    </marker>
                </ng-map>
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




        <div id="pic">

            <?php
            $sql = "select house_image_id,house_id,image_number,
image_description,image_taken_date 
from  house_image
where house_id = '$hid' order by house_image_id ";
            $row = 1;

            $result = $db->query($sql, PDO::FETCH_OBJ);
            ?>
            <ul data-role="listview" data-split-icon="edit" data-split-theme="a" data-inset="true">
                <li data-role="list-divider"  >
                    <h3>รูปบ้าน
                    <a href="#" data-role="button" data-inline="true" data-icon="plus" data-iconpos="notext" data-theme="a" data-mini="true" data-ajax="false">แก้ไข</a>
                    </h3>
                </li>
                <?php
                foreach ($result as $r) {
                    ?>

                    <li>
                        <a href="#popupPhoto<?= $r->house_image_id ?>" data-rel="popup" data-position-to="window" data-transition="pop">
                            <img src="includes/house_image_id.php?hid=<?= $r->house_image_id ?>" height="150" align="center" />
                            <h3>
                                รูปที่ <?= $row ?>
                            </h3>
                            <p>คำอธิบาย : <?= $r->image_description ?></p>
                            <p class="ui-li-aside">
                                <strong>
                                    วันที่ : <?= $r->image_taken_date ?>
                                </strong>
                            </p>
                        </a>
                        <a href="index.php?url=views/familyfolder/edit_house_img.php&hiid=<?=$r->house_image_id ?>&hid=<?=$r->house_id ?>" data-ajax="false">แก้ไขภาพ</a>
                    </li>

                    <div data-role="popup" id="popupPhoto<?= $r->house_image_id ?>" data-overlay-theme="b" data-theme="a" class="ui-corner-all" style="max-width:500px; height: 100%;">
                        <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
                            <img src="includes/house_image_id.php?hid=<?= $r->house_image_id ?>" style="width: 100%;" align="center" />
                    </div>


                    <?php
                    $row = $row + 1;
                }
                ?>

                    <li>
                        
                    </li>
            </ul>


        </div>


    </div>
</div>

    <div data-role="footer" data-position="fixed" data-theme='d'>
        <div data-role="navbar">
            <ul>
                <li>
                    <a href="#" data-inline="true" data-icon="back" data-mini="true" data-rel='back' >
                        Back
                    </a>
                </li>
                <li>
                    <a href="index.php" data-inline="true" data-icon="plus" data-mini="true" >
                        เพิ่มหมู่บ้าน
                    </a>
                </li> 
            </ul>
        </div>
    </div>

<script>
    var myApp = angular.module('myApp', ['ngMap']);
    //แสดงรายชื่อผู้รับบริการ
    myApp.controller('personCtrl', function ($scope, $http) {
        $scope.dataload = {};
        var dataloaded = $scope.dataload;
        dataloaded.loaded = false;

        $http.get("models/m_person_list.php?hid=<?= $hid ?>")
                .success(function (response) {
                    $scope.person = response.records;
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


    myApp.controller('ImgCtrl', function ($scope, $http) {
        $scope.dataload = {};
        var dataloaded = $scope.dataload;
        dataloaded.loaded = false;

        $http.get("models/m_house_image.php?hid=<?= $hid ?>")
                .success(function (response) {
                    $scope.img = response.records;
                    dataloaded.loaded = true;
                });
    });

    myApp.controller('surveyCtrl', function ($scope, $http) {
        $scope.dataload = {};
        var dataloaded = $scope.dataload;
        dataloaded.loaded = false;

        $http.get("models/m_house_survey.php?hid=<?= $_REQUEST['hid'] ?>")
                .success(function (response) {
                    $scope.survey = response.records;
                    dataloaded.loaded = true;
                });
    });

</script>

