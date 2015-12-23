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
    
    
            #imagePreview {
            min-width: 250px;
            min-height: 250px;
            height: 250px;
            width: 250px;
            background-position: center center;
            background-size: cover;
            -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
            display: inline-block;
        }
</style>
    <script type="text/javascript">
        $(function () {
            $("#imgupload").on("change", function ()
            {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
                    return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        $("#imagePreview").css("background-image", "url(" + this.result + ")");
                    }
                }
            });
        });
    </script>

<?php 
$hid=$_REQUEST['hid'];
//$getData->GetStringData("select image_description as cc from house_image where house_image_id=$hiid");

?>
<div data-role="content">
    <form name="img" id="img" method="POST" action="index.php?url=models/m_add_house_img.php" data-ajax="false" enctype="multipart/form-data">  
        <input type="hidden" name="hid" id="hid" value="<?=$hid?>">
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
                            <td><div id="imagePreview" ></div>
                            <input type="file" name="imgupload" id="imgupload"  class="img" /></td>
                            <td>
                                <div class="ui-field-contain">
                                    <label for="image_description">คำอธิบาย :</label>
                                    <textarea name="image_description" id="image_description" placeholder="กรุณาใส่คำอธิบาย..."></textarea>
                                </div>
                                <div class="ui-field-contain">
                                    <label for="image_number">ลำดับภาพ:</label>
                                    <input type="number" data-mini="true" name="image_number" id="image_number" value="<?=$getData->GetStringData("select max(image_number)+1 as cc from house_image where house_id=$hid"); ?>">
                                </div>
                                <div class="ui-field-contain">
                                    <label for="take_date">วันที่ถ่าย/แก้ไข:</label>
                                    <input type="text" data-mini="true" name="take_date" id="take_date" readonly="true" value="<?=$df->FormatThaiDate(date('Y-m-d'))?>">
                                </div>
                                <div class="ui-field-contain">
                                    <label for="submit"></label>
                                    <button type="submit" name="submit" data-inline="false" data-theme="i" data-mini="true">บันทึก</button>
                                </div>
                                <div class="ui-field-contain">
                                    <label for="house_subtype"></label>
                                    <a href="#" data-role="button" data-rel="back"  name="back" data-inline="false" data-theme="j" data-mini="true" >ยกเลิก</a>
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
