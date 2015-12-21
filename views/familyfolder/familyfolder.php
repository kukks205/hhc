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
<div role="main" class="ui-content"  ng-app="myApp" >
    <div data-role="header" data-theme="<?= $theme ?>">
        <h1>E-Family Folder บ้านเลขที่ : <?php echo $getData->GetStringData("select concat(h.address,' ม.',v.village_moo) cc  from house h join village v on (v.village_id=h.village_id) where house_id='" . $_REQUEST['hid'] . "'"); ?></h1>
    </div>



    <div data-role="tabs" id="tabs" data-theme="a">
        <div data-role="header" data-theme="a">
            <div data-role="navbar">
                <ul>
                    <li><a href="#house" data-ajax="false">ทะเบียนบ้าน</a></li>
                    <li><a href="#one" data-ajax="false">ชื่อสมาชิก</a></li>
                    <li><a href="#two" data-ajax="false">ข้อมูลสำรวจ</a></li>
                    <li><a href="#three" data-ajax="false">แผนที่</a></li>
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


        <div id="one" ng-controller="personCtrl">
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



        <div id="two">
                <h1>การวินิจฉัย</h1>
        </div>
        <div id="three">
            <table data-role="table" id="temp-table" data-mode="reflow" class="ui-responsive table-stroke">
                <thead>
                    <tr><th data-priority="1">ลำดับ</th>
                        <th data-priority="persist">ชื่อยา</th>
                        <th data-priority="2">วิธีใช้ยา</th>
                        <th data-priority="3">จำนวน</th>
                        <th data-priority="4">หน่วย</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <td><strong>PARACETAMOL 500 mg.</strong></td>
                        <td>1-2 เม็ด ทุก 6 ชั่วโมงเวลาปวดหรือมีไข้</td>
                        <td>10</td>
                        <td>tab.</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td><strong>CHLOPHENIRAMINE 4 mg.</strong></td>
                        <td>1 เม็ด 3 ครั้ง หลังอาหาร เช้า กลางวัน เย็น</td>
                        <td>10</td>
                        <td>tab.</td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td><strong>แก้ไอมะขามป้อม</strong></td>
                        <td>จิบเวลาไอ</td>
                        <td>1</td>
                        <td>ขวด</td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <td><strong>AMOXYCILLIN 500 mg.</strong></td>
                        <td>2 แคปซูล 2 ครั้ง ก่อนอาหาร เช้า - เย็น</td>
                        <td>96%</td>
                        <td>87</td>
                    </tr>
                    <tr>
                        <th>5</th>
                        <td><strong>SALBUTAMOL 2 mg.</strong></td>
                        <td>1 เม็ด 2 ครั้ง หลังอาหาร เช้า - เย็น</td>
                        <td>10</td>
                        <td>tab.</td>
                    </tr>
                </tbody>
            </table>
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
                <a href="index.php?url=pages/onestop/onestop_home.php&startdate=<?= $_REQUEST['sdate'] ?>&enddate=<?= $_REQUEST['edate'] ?>" data-ajax="false" data-inline="true" data-icon="back" data-mini="true" >
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
</script>