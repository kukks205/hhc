<div data-role="content" ng-app="personList" ng-controller="personCtrl" >
    <ul data-role="listview" data-inset="true" data-theme="a" data-filter='true'>
        <li data-role="list-divider" data-theme="<?= $theme; ?>">
            <h1><?php echo $getData->GetStringData("select village_name as cc from village where village_id='" . $_REQUEST['villcode'] . "'"); ?>  <?php echo $getData->GetStringData("select concat('ม.',v.village_moo,'  ',t.full_name) as cc from thaiaddress as t join village as v on t.addressid = v.address_id where v.village_id=" . $_REQUEST['villcode']); ?></h1>
            <h4>จำนวนหลังคาเรือนทั้งหมด {{person.length}} หหลังคาเรือน</h4>
        </li>
        <li ng-hide="dataload.loaded == true"><div align='center'><i class="icon ion-loading-c" style="font-size: 32px;"></i> กำลังประมวลผล...</div></li>
        <li ng-repeat="p in person">
            <a href="index.php?url=views/familyfolder/familyfolder.php&hid={{p.house_id}}" data-ajax="false">
                <img src="includes/house_image_id.php?hid={{p.house_id}}" width="150" align="center"  ng-if="p.img == true"/> 
                <img src="img/no_image.gif" alt="" width="150" align="center" ng-if="p.img == false"/>

                <h4>บ้านเลขที่ :{{p.address}}</h4>
                <p>เจ้าบ้าน :{{p.name}}</p>
            </a>
        </li>
        <li data-theme="d">
            <p>Copyright © 2014-2015 kukks205. All rights reserved. </p>
        </li>
    </ul>



</div>


<div data-role="footer" data-position="fixed" data-theme="<?= $theme; ?>">
    <div data-role="navbar">
        <ul>
            <li>
                <a href="#" data-inline="true" data-icon="back" data-mini="true" data-rel='back' >
                    Back
                </a>
            </li> 
            <li>
                <a href="#" data-inline="true" data-icon="plus" data-mini="true" data-rel='back' >
                    เพิ่มหลังคาเรือน
                </a>
            </li>
        </ul>
    </div>
</div>


<script>

    var myApp = angular.module('myApp', []);
    myApp.controller('personCtrl', function ($scope, $http) {
        $scope.dataload = {};
        var dataloaded = $scope.dataload;
        //กำหนดตัวแปรที่จะแสดงสถานะการ load ว่ายังไม่เสร็จ
        dataloaded.loaded = false;
        $http.get("models/m_house_list.php?village_id=<?= $_REQUEST['villcode'] ?>")
                .success(function (response) {
                    $scope.person = response.records;
                    //กำหนดตัวแปรที่จะแสดงสถานะการ load ว่าเสร็จแล้ว
                    dataloaded.loaded = true;
                });
    });
</script>



