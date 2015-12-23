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
<?php $hiid=$_REQUEST['hiid']; ?>
<div data-role="content">
    <form name="img" id="img" method="POST" action="index.php?url=models/m_edit_house_img.php">  
        <input type="hidden" name="hiid" id="hiid" value="<?=$_REQUEST['hiid']?>">
        <input type="hidden" name="hid" id="hid" value="<?=$_REQUEST['hid']?>">
        <ul data-role="listview" data-inset="true" data-mini="true">
            <li data-role="list-divider">
                <h4>แก้ไขภาพถ่ายบ้าน</h4>   
            </li>
            <li>
                <table data-role="table" id="temp-table" data-mode="reflow" class="ui-responsive table-stroke" data-filter="false">   
                    <thead>
                        <tr>
                            <th data-priority="1" width="30%" ></th>
                            <th data-priority="2" ></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr ng-repeat="s in survey">
                            <td><img src="includes/house_image_id.php?hid=<?= $_REQUEST['hiid'] ?>" width="100%" /></td>
                            <td>
                                <div class="ui-field-contain">
                                    <label for="image_description">คำอธิบาย :</label>
                                    <textarea name="image_description" id="image_description"><?=$getData->GetStringData("select image_description as cc from house_image where house_image_id=$hiid"); ?></textarea>
                                </div>
                                <div class="ui-field-contain">
                                    <label for="image_number">ลำดับภาพ:</label>
                                    <input type="number" data-mini="true" name="image_number" id="image_number" value="<?=$getData->GetStringData("select image_number as cc from house_image where house_image_id=$hiid"); ?>">
                                </div>
                                <div class="ui-field-contain">
                                    <label for="take_date">วันที่ถ่าย/แก้ไข:</label>
                                    <input type="text" data-mini="true" name="take_date" id="take_date" readonly="true" value="<?=$df->FormatThaiDate($getData->GetStringData("select image_taken_date as cc from house_image where house_image_id=$hiid"))?>">
                                </div>
                                <div class="ui-field-contain">
                                    <label for="submit"></label>
                                    <button type="submit" name="submit" data-inline="false" data-theme="i" data-mini="true">บันทึก</button>
                                </div>
                                <div class="ui-field-contain">
                                    <label for="house_subtype"></label>
                                    <a href="#" data-role="button" type="submit" name="submit" data-inline="false" data-theme="j" data-mini="true" onclick="fncSubmit()" >ลบรูป</a>
                                </div>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </li>
            <li>

            </li>
        </ul>

    </form>
</div>
