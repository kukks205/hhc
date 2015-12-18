        <ul data-role="listview" data-inset="true" data-theme="a">
            <li data-role="list-divider" data-theme="<?=$theme;?>">
                <h1>:: เมนูหลัก :: ยินดีต้อนรับคุณ <?= $_SESSION['name'] ?></h1>
                <p>หน่วยบริการ :<?php echo $getData->GetStringData("select hospitalname as cc from opdconfig"); ?></p>
            </li>
            <li>
                <a href="index.php?url=views/opd/opd_home.php" data-ajax="false">
                    <img src="img/doctor2.png" alt=""/>
                    <h1>ระบบงานบริการเชิงรับ</h1>
                    <p>ระบบงานบริการในหน่วยบริการเช่น OneStopService เป็นต้น</p>
                </a></li>
            <li>
                <a href="index.php?url=pages/mainmenu/menu_promo.php" data-ajax="false">
                    <img src="img/home3.png" alt=""/>
                    <h1>ระบบบริการเชิงรุก</h1>
                    <p>ระบบงานบริการส่งเสริม ป้องกัน ฟื้นฟูในกลุ่มเป้าหมายกลุ่มต่างๆ</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="img/person_search.png" alt=""/>
                    <h1>ค้นหาประชากร</h1>
                    <p>ค้นหาประชากรจาก CID,PID,ชื่อ-สกุลหรือที่อยู่</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="img/map/map2.png" alt=""/>
                    <h1>แผนที่</h1>
                    <p>แผนที่ด้านสุขภาพโดยแสดงผ่าน Google map</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="img/report-icon.gif" alt=""/>
                    <h1>ระบบรายงาน</h1>
                    <p>ระบบรายงาน Online</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="img/file-config.png" alt=""/>
                    <h1>เครื่องมือและการตั้งค่าระบบ</h1>
                    <p>เครื่องมือที่สำคัญของระบบและการตั้งค่าการใช้งานของระบบ</p>
                </a>
            </li>
            <li data-role="list-divider" data-theme="<?=$theme;?>">
                <p>Copyright © 2014-2015 kukks205. All rights reserved. </p>
            </li>
        </ul>