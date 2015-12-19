    <div data-role="content" ng-app="villageList" ng-controller="villageCtrl" >
        <ul data-role="listview" data-inset="true" data-theme="a">
            <li data-role="list-divider" data-theme="<?= $theme; ?>">
                <h4>หมู่บ้านในเขตรับผิดชอบ</h4>
            </li>

            <li ng-repeat="v in village">
                <a href="index.php?url=views/communityfolder/seven_tools.php&villcode={{v.village_id}}" data-ajax='false'>
                    <h4>{{v.village_name}}</h4>
                    <p>{{'รหัสหมู่บ้าน : '+v.village_code}}</p>
                </a>
                <a href="index.php?url=views/communityfolder/village_edit.php&villcode={{v.village_code}}" data-ajax='false' data-position-to="window" data-transition="pop" data-icon='edit'>Purchase album</a>
            </li>
        </ul>
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
    
    
    
    

    

</div>

<script>
    
var myApp = angular.module('myApp', []);    
    //แสดงรายชื่อผู้รับบริการ
myApp.controller('villageCtrl', function ($scope, $http) {
    //กำหนดตัวแปรที่จะแสดงสถานะการ load
    $scope.dataload = {};
    var dataloaded = $scope.dataload;
    //กำหนดตัวแปรที่จะแสดงสถานะการ load ว่ายังไม่เสร็จ
    dataloaded.loaded = false;

    $http.get("models/m_village_list.php")
            .success(function (response) {
                $scope.village = response.records;
                //กำหนดตัวแปรที่จะแสดงสถานะการ load ว่าเสร็จแล้ว
                dataloaded.loaded = true;
            });

});   
    
    
/*    $(document).on("click", "#edit", function (event) {
        var vill = $(this);
        var vill_id=vill.attr('villcode');
        alert(vill_id);        
    });


    /* $("#personlist").on("pageshow", function () {
     alert('pageshow');
     var app = angular.module('personList', []);
     app.controller('personCtrl', function ($scope, $http) {
     $http.get("http://127.0.0.1/pdo/person_json.php?cid=34106")
     .success(function (response) {
     $scope.person = response.records;
     });
     });
     });*/
</script>



