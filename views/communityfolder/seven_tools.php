<div role="main" class="ui-content">
    <ul data-role="listview" data-inset="true" data-theme="a">
        <li data-role="list-divider" data-theme="<?= $theme; ?>">
            <h1>:: แฟ้มชุมชน :: หมู่บ้าน <?php echo $getData->GetStringData("select village_name as cc from village where village_id=".$_REQUEST['villcode']); ?> ::</h1>
            <h4><?php echo $getData->GetStringData("select concat('ม.',v.village_moo,'  ',t.full_name) as cc from thaiaddress as t join village as v on t.addressid = v.address_id where v.village_id=".$_REQUEST['villcode']); ?></h4>
        </li>
        <li>
        <a href="index.php?url=views/communityfolder/village_list.php" data-ajax='false'>
            <img src="img/map/map2.png" alt=""/>
            <h1>แผนที่ชุมชน</h1>
            <p>แผนที่ชุมชนบน Googlemap</p>
        </a>
        </li>
        <li>
        <a href="index.php?url=views/communityfolder/village_list.php" data-ajax='false'>
            <img src="img/hourglass.png" alt=""/>
            <h1>ประวัติศาสตร์ชุมชน</h1>
            <p>ประวัติศาสตร์ ความเป็นมาและเหตุการณ์สำคัญในชุมชน</p>
        </a>
        </li> 
        <li>
        <a href="index.php?url=views/communityfolder/village_list.php" data-ajax='false'>
            <img src="img/familyfolder.png" alt=""/>
            <h1>แฟ้มครอบครัว</h1>
            <p>Electronic Family Folder</p>
        </a>
        </li> 
        <li>
        <a href="index.php?url=views/communityfolder/village_list.php" data-ajax='false'>
            <img src="img/group.png" alt=""/>
            <h1>องค์กรชุมชน</h1>
            <p>กลุ่มคนและกลุ่มต่างๆในชุมชน</p>
        </a>
        </li> 
        <li>
        <a href="index.php?url=views/communityfolder/village_list.php" data-ajax='false'>
            <img src="img/report-4.png" alt=""/>
            <h1>ข้อมูลพื้นฐานของชุมชน</h1>
            <p>ข้อมูลพื้นฐานของชุมชน</p>
        </a>
        </li> 
    </ul>
</div>