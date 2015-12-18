        <ul data-role="listview" data-inset="true" data-theme="a">
            <li data-role="list-divider" data-theme="<?=$theme;?>">
                <h1>ระบบงานบริการเชิงรับ</h1>
                <p>User :</p>
            </li>
            <li>
                <a href="index.php?url=views/opd/onestop_home.php" data-ajax='false'>
                    <img src="img/doctor5.png" alt=""/>
                    <h4>One Stop Service</h4>
                    <p>ให้บริการ One Stop Service</p>
                </a>
            </li>
            <li>
                <a href="#" data-ajax='false'>
                    <img src="img/emr.png" alt=""/>
                    <h4>EMR</h4>
                    <p>ข้อมูลการรับบริการทางการแพทย์รายบุคคล Electronic Medical Record</p>
                </a>
            </li>
            <li>
                <a href="#" data-ajax='false'>
                    <img src="img/calendar.png" alt=""/>
                    <h4>ทะเบียนนัดผู้ป่วย</h4>
                    <p>ทะเบียนนัดผู้ป่วยแยกตามคลินิก</p>
                </a>
            </li>
            <li>
                <a href="#" data-ajax='false'>
                    <img src="img/lab.png" alt=""/>
                    <h4>รายงานผล LAB</h4>
                    <p>ทะเบียนรายงานผลการตรวจทางห้องปฏิบัติการ</p>
                </a>
            </li> 
            <li>
                <a href="#" data-ajax='false'>
                    <img src="img/medical.png" alt=""/>
                    <h4>เบาหวาน/ความดันโลหิตสูง</h4>
                    <p>ทะเบียนคลินิกพิเศษเบาหวานและความดันโลหิตสูง</p>
                </a>
            </li>             
        </ul>

    <div data-role="footer" data-position="fixed" data-theme="<?=$theme;?>">
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