<?php
if (empty($_SESSION['loginname'])) {
    $url = 'views/login.php';
    $theme = 'd';
} else {
    $url = 'views/menu/mainmenu.php';
    $theme = $_SESSION['theme'];
}
?>

<div data-role="page"  id="mainpage" data-quicklinks="true">


    <div data-role="header" data-position="fixed" data-fullscreen="true" data-theme="<?= $theme; ?>">
        <?php
        if (empty($_SESSION['loginname'])):
            ?>

            <a  data-iconpos="notext" href="#" data-role="button" data-icon="grid" title="เมนู"></a>
            
            <?php
        else:
            ?>
            <a  data-iconpos="notext" href="#quick_menu" data-role="button" data-icon="grid" title="เมนู"></a>
        <?php
        endif;
        ?>

        <h1>:: HHC 4.0 ::</h1>
        <a href="index.php?url=views/checkout.php"data-iconpos="notext" data-role="button" data-icon="power" title="Logout">Logout</a>
    </div>



    <div role="main" class="ui-content" style="margin-top: 25px;">
        <?php
        if (!empty($_REQUEST["url"])) {
            require $_REQUEST['url'];
        } else {
            require $url;
        }
        ?>

    </div>
    <?php include 'views/menu/quickmenu.html'; ?>     
</div>  