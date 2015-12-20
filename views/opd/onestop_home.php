<style>
    @media ( min-width: 40em ) {
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
    if (isset($_REQUEST['startdate']) & isset($_REQUEST['enddate'])):

        $e = explode("/", $_REQUEST['startdate']);
        $start = $e[2] . '-' . $e[1] . '-' . $e[0];

        $startdate = $_REQUEST['startdate'];

        $e2 = explode("/", $_REQUEST['enddate']);
        $end = $e2[2] . '-' . $e2[1] . '-' . $e2[0];
        $enddate = $_REQUEST['enddate'];
    else:
        $start = date('Y-m-d');
        $startdate = date('d/m/Y');
        $end = date('Y-m-d');
        $enddate = date('d/m/Y');
    endif;

    if (isset($_POST['spclty'])):

        if ($_POST['spclty'] == 'xx'):
            $spclty = " and o.spclty is not null";
            $clinic = "xx";
            $clinic_name = "ทุกแผนก";
        else:
            $spclty = " and o.spclty='" . $_POST['spclty'] . "'";
            $clinic = $_POST['spclty'];
            $clinic_name = $getData->GetStringData("select name as cc from spclty where spclty='" . $_POST['spclty'] . "'");
        endif;


    else:
        $spclty = " and o.spclty is not null";
        $clinic = "xx";
        $clinic_name = "ทุกแผนก";
    endif;
    ?>


<div ng-app="myApp"  ng-controller="visitListCtrl" >
        <ul data-role="listview" data-inset="true" data-theme="a" data-filter='true' data-filter-placeholder='ค้นหาผู้รับบริการ..'>
            <li data-role="list-divider" data-theme="<?= $theme; ?>">
                <h1>
                    One Stop Service วันที่ :<?= $startdate ?> ถึง : <?= $enddate ?>               
                </h1>
                <p>จำนวนผู้รับบริการ : {{visit.length}} คน</p>
                <span class="ui-li-count">                    
                    <a href="#popupSelect" data-rel="popup" data-position-to="window" data-transition="pop" title="ระบุเงื่อนไข">
                        <i class="ion-ios7-calendar-outline" style="font-size: 27px;"></i>    
                    </a>
                </span>
            </li>
            <li ng-hide="dataload.loaded == true"><div align='center'><i class="icon ion-loading-c" style="font-size: 32px;"></i> กำลังประมวลผล...</div></li>
            <li ng-repeat="v in visit">
                <a href="index.php?url=pages/onestop/service_detail.php&vn={{v.vn}}&sdate=<?= $startdate ?>&edate=<?= $enddate ?>" data-ajax='false'>
                    <img src="includes/person_image.php?pid={{v.person_id}}" width="150" align="center"  ng-if="v.img == 3"/> 
                    <img src="img/no-image-man.png" alt="" width="150" align="center" ng-if="v.img == 1"/>
                    <img src="img/no-pic-girl.png" alt="" width="150" align="center" ng-if="v.img == 2"/>
                    <h4>{{$index + 1}}. ชื่อ : {{v.ptname}}</h4>
                    <p>วันที่ : {{v.service_date}} เวลา : {{v.vsttime}} SEQ : {{v.seq_id}}
                        <br>ผู้ตรวจ :{{v.name}} แผนก :{{v.dep}}
                        <br>CC : {{v.cc}}
                        <br>PDX : {{v.diag}}
                    </p>
                </a>
            </li> 
            <li>

            </li>
        </ul>
</div>

        <div data-role="popup" id="popupSelect" data-theme="a" data-overlay-theme="b"  class="ui-corner-all" data-dismissible="true" style="max-width:400px; min-width: 350px;" >

            <div data-role="header" data-theme="b" class="ui-corner-top">
                <h4>ระบุเงื่อนไขแสดงผล</h4>
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
            </div>           
            <div data-role="content" data-theme="a" >
                <form name="select_date" id="select_date" method="post" action="#">

                    <div class="ui-field-contain">
                        <label>วันที่:</label>
                        <input type="text" data-mini="true" name="startdate" id="startdate" value="<?= $startdate ?>" data-inline="true">
                    </div>

                    <div class="ui-field-contain">
                        <label>ถึง:</label>
                        <input type="text" data-mini="true" name="enddate" id="enddate" value="<?= $enddate ?>" data-inline="true">
                    </div>                                

                    <div class="ui-field-contain">
                        <label>แผนก:</label>
                        <select name="spclty" id="spclty" data-native-menu="false" data-mini="true" class="filterable-select">
                            <option value="<?= $clinic ?>"><?= $clinic_name ?></option>
                            <option value="xx">ทุกแผนก</option> 
                            <?php
                            $sql = "select spclty,name from spclty order by  spclty";
                            $row = $db->query($sql, PDO::FETCH_OBJ);
                            foreach ($row as $r) {
                                ?>
                                <option value="<?= $r->spclty ?>"><?= $r->name ?></option>  
                                <?php
                            }
                            ?>

                        </select>    
                    </div>

                    <div class="ui-field-contain">
                        <label>แสดงต่อหน้า:</label>
                        <select name="pages" id="pages" data-native-menu="false" data-mini="true" class="filterable-select">
                            <option value="20">20</option>
                            <option value="40">40</option>
                            <option value="60">60</option>
                            <option value="80">80</option>
                            <option value="80">All</option>
                        </select> 
                    </div>

                    <button type="submit" class="ui-btn ui-mini ui-btn-d ui-btn-corner-all  ui-btn-inline " onclick="document.select_date.submit();" aria-disabled="false">ตกลง</button>

                </form>
            </div>
        </div>


    



    <div data-role="footer" data-position="fixed" data-theme="d">
        <div data-role="navbar">
            <ul>
                <li>
                    <a href="index.php" data-inline="true" data-icon="home" data-mini="true" >
                        Home
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
myApp.controller('visitListCtrl', function ($scope, $http) {
    //กำหนดตัวแปรที่จะแสดงสถานะการ load
    $scope.dataload = {};
    var dataloaded = $scope.dataload;
    //กำหนดตัวแปรที่จะแสดงสถานะการ load ว่ายังไม่เสร็จ
    dataloaded.loaded = false;

    $http.get("models/m_visit_list.php?startdate=<?= $start ?>&enddate=<?= $end ?>&spclty=<?= $spclty ?>")
            .success(function (response) {
                $scope.visit = response.records;
                //กำหนดตัวแปรที่จะแสดงสถานะการ load ว่าเสร็จแล้ว
                dataloaded.loaded = true;
            });

});

    $('#startdate').mobiscroll().date({
        //invalid: { daysOfWeek: [0, 6], daysOfMonth: ['5/1', '12/24', '12/25'] },
        theme: 'android',
        display: 'modal',
        showLabel: true,
        mode: 'scroller',
        dateOrder: 'dd M yy',
        dateFormat: "dd/mm/yy"

    });

    $('#enddate').mobiscroll().date({
        //invalid: { daysOfWeek: [0, 6], daysOfMonth: ['5/1', '12/24', '12/25'] },
        theme: 'android',
        display: 'modal',
        showLabel: true,
        mode: 'scroller',
        dateOrder: 'dd M yy',
        dateFormat: "dd/mm/yy"

    });

</script>