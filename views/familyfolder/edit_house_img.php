<div data-role="content" ng-app="myApp" >
        <form method="post" action="upload_1.php" enctype="multipart/form-data">
            <div id="imagePreview"></div>
            
            <input id="imgupload" type="file" name="img" class="img" />
            
            <input type="submit" value="upload">
        
    <ul data-role="listview" data-inset="true" data-mini="true">
        <li data-role="list-divider">
            <h4>แก้ไขภาพถ่ายบ้าน</h4>   
        </li>
        <li>
            <div align='center'>
                <img src="includes/house_image_id.php?hid=<?= $_REQUEST['hiid'] ?>" width="250px" />  
            </div>
        </li>
        <li>
            <div class="ui-field-contain">
                <label for="house_subtype">คำอธิบาย :</label>
                <input type="text" data-mini="true" name="house_subtype" id="house_subtype" value="">
            </div>

        </li>
    </ul>
            
            </form>


</div>
