<?php
error_reporting(0);

function detect_mobile() {
    if (preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc
|iemobile
|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp
|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
        return true;
    else
        return false;
}

$mobile = detect_mobile();
if ($mobile === true) {
    $width = "100%";
} else
    $width = "450px";
?>

        <form  method="post" name="frmLogin" action="index.php?url=views/checklogin.php">
            <div align="center"><img src="img/hhc_logo.png" width=<?= $width ?> /></div>

            <input type="hidden" name="exec" value="true">
            <div class="ui-field-contain">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="" data-clear-btn="true" placeholder="Username">
            </div>
            <div class="ui-field-contain">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" value="" data-clear-btn="true" placeholder="Password">
            </div> 
            <div class="ui-field-contain">
                <label>Theme:</label>
                <select name="theme" id="theme" data-native-menu="false" data-mini="true" class="filterable-select">
                    <option value="d">Facebook</option>
                    <option value="a">Light</option>
                    <option value="b">Black</option>
                    <option value="c">Ocean</option>
                    <option value="d">Facebook</option>
                    <option value="e">Smoke</option>
                    <option value="f">Chocolate</option>
                    <option value="g">Pink Rose</option>
                    <option value="h">Blue Sky</option>
                    <option value="i">Peach</option>
                    <option value="j">Danger</option>
                    <option value="k">Creamy</option>
                    <option value="l">Orange</option>
                    <option value="m">Success</option>

                </select>    
            </div>
            <div data-role="fieldcontain" align="center">
                <a href="#" data-role="button" type="submit" name="submit" data-inline="false" data-theme="a" data-mini="true" onclick="fncSubmit()" >Login</a> 
            </div>
        </form>
<script language="javascript">
    function fncSubmit()
    {
        document.frmLogin.submit();
    }
</script>

