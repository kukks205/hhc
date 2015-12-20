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
<div role="main" class="ui-content"  >
    <div data-role="header" data-theme="<?=$theme?>">
        <h1>E-Family Folder บ้านเลขที่ :<?=$_REQUEST['hid']?></h1>
    </div>
    <div data-role="tabs" id="tabs" data-theme="a">
        <div data-role="header" data-theme="a">
            <div data-role="navbar">
                <ul>
                    <li><a href="#on" data-ajax="false">สัญญาณชีพ</a></li>
                    <li><a href="#one" data-ajax="false">ซักประวัติ</a></li>
                    <li><a href="#two" data-ajax="false">การวินิจฉัย</a></li>
                    <li><a href="#three" data-ajax="false">การรักษา</a></li>
                </ul>
            </div>
        </div>
        <div id="on">


            <table data-role="table" id="temp-table" data-mode="reflow" class="ui-responsive table-stroke">
                <thead>
                    <tr>
                        <th data-priority="1">น้ำหนัก</th>
                        <th data-priority="2">ส่วนสูง</th>
                        <th data-priority="3">ความดันโลหิต</th>
                        <th data-priority="4">อุณหภูมิ</th>
                        <th data-priority="5">Puls</th>
                        <th data-priority="6">RR.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><font color="green">60 กก.</font></td>
                        <td><font color="green">160 cms.</font></td>
                        <td><font color="green">120/80 mmHg.</font></td>
                        <td><font color="green">37.00</font></td>
                        <td><font color="green">80/min.</font></td>
                        <td><font color="green">14/min.</font></td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div id="one">

            <table data-role="table" id="temp-table" data-mode="reflow" class="ui-responsive table-stroke">
                <thead>
                    <tr>
                        <th data-priority="1">อาการสำคัญ :</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td valign="top" bgcolor="#E6E6E6">                                        
                            <font color="#084B8A">
                            มีน้ำมูก ไข้ ไอ เจ็บคอ  เป็นมา 3 วัน
                            </font>
                        </td>
                    </tr>
                </tbody>
            </table>


            <table data-role="table" id="temp-table" data-mode="reflow" class="ui-responsive table-stroke">
                <thead>
                    <tr>
                        <th data-priority="1">การตรวจร่างกาย :</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td valign="top" bgcolor="#E6E6E6">                                        
                            <font color="#084B8A">
                            Pharynx injected, tonsils not enlarged, not injected
                            <br>Normal breath sound,no adventitious sounds( Crepitation,Rhonchi, Wheezing)
                            </font>
                        </td>
                    </tr>
                </tbody>
            </table>
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
