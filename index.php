<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HHC Online 4.0</title>
        <link rel="stylesheet" href="lib/jqm1.4.5/themes/jquery.mobile.icons.min.css" />
        <link href="css/4.0/hhc4theme.css" rel="stylesheet" type="text/css"/>
        <link href="lib/jqm1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css"/>

        <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="lib/ionicons/css/ionicons.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-2.1.3.js"></script>
        <script src="lib/jqm1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script src="lib/angular-1.4.5/angular.min.js" type="text/javascript"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
        <script src="lib/angular-1.4.5/ng-map.min.js" type="text/javascript"></script>



        <script src="lib/mobiscroll/js/mobiscroll.core.js"></script>
        <script src="lib/mobiscroll/js/mobiscroll.widget.js"></script>
        <script src="lib/mobiscroll/js/mobiscroll.scroller.js"></script>
        <script src="lib/mobiscroll/js/mobiscroll.util.datetime.js"></script>
        <script src="lib/mobiscroll/js/mobiscroll.datetimebase.js"></script>
        <script src="lib/mobiscroll/js/mobiscroll.datetime.js"></script>
        <script src="lib/mobiscroll/js/mobiscroll.widget.android.js"></script>
        <script src="lib/mobiscroll/js/mobiscroll.widget.jqm.js"></script>

        <link href="lib/mobiscroll/css/mobiscroll.animation.css" rel="stylesheet" type="text/css" />
        <link href="lib/mobiscroll/css/mobiscroll.icons.css" rel="stylesheet" type="text/css" />
        <link href="lib/mobiscroll/css/mobiscroll.widget.css" rel="stylesheet" type="text/css" />
        <link href="lib/mobiscroll/css/mobiscroll.widget.android.css" rel="stylesheet" type="text/css" />
        <link href="lib/mobiscroll/css/mobiscroll.scroller.css" rel="stylesheet" type="text/css" />
        <link href="lib/mobiscroll/css/mobiscroll.scroller.android.css" rel="stylesheet" type="text/css" />
        <link href="lib/mobiscroll/css/mobiscroll.scroller.jqm.css" rel="stylesheet" type="text/css" />

        <link rel="shortcut icon" href="img/favicon.ico" />
        <script type="text/javascript" language="javascript">
            $.mobile.page.prototype.options.domCache = true;
        </script>
    </head>
    <body>
        <?php
        include 'includes/DBConn.php';
        include 'includes/dbClass.php';
        include 'includes/dateClass.php';
        $df = new dateClass();
        $getData = new dbClass();
        include 'views/content.php';
        ?> 
    </body>
</html>
