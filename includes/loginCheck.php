<?php

class loginCheck {

    var $conn;

    //ใช้ connect DB เพื่อใช้ใน Class
    public function __construct() {

        include 'conf.ini.php';
        try {
            //connect ฐานข้อมูล 
            $this->conn = new PDO("mysql:host=$hostname;port=$port;dbname=$dbname;", $username, $password, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset",));
        } catch (Exception $e) {
            echo "<script> alert('ไม่สามารถเชื่อมต่อฐานข้อมูลได้กรุณาตรวจสอบการตั้งค่าการเชื่อมต่อหรือติดต่อผู้ดูแลระบบครับผม');</script>";
            echo "<script>";
            echo "window.location='index.php';";
            echo "</script>";
        }
    }

    //put your code here
    public function checkLogin($username, $password,$theme) {

        if ($username == null):
            echo "<script> alert('กรุณาระบุ Username ด้วยครับ');</script>";
            echo "<script>";
            echo "window.location='index.php';";
            echo "</script>";
        else:
            if ($password == null):
                echo "<script> alert('กรุณาระบุ Password ด้วยครับ');</script>";
                echo "<script>";
                echo "window.location='index.php';";
                echo "</script>";
            else:
                $sql = "select * from opduser where loginname='$username' and passweb=md5('$password')";
                $result = $this->conn->prepare($sql);
                $result->execute();
                $check = $result->rowCount();

                if ($result !== false):

                    if ($result->rowCount() > 0):
                        while ($row = $result->fetch()) {
                            $_SESSION['loginname'] = $row['loginname'];
                            $_SESSION['name'] = $row['name'];
                            $_SESSION['theme']=$theme;
                            header("location:index.php");
                        }
                    else:
                        echo "<script> alert('Username หรือ Password ไม่ถูกต้องกรุณาลองอีกครั้ง');</script>";
                        echo "<script>";
                        echo "window.location='index.php';";
                        echo "</script>";
                    endif;

                else:
                    echo "<script> alert('เชื่อมต่อฐานข้อมูลไม่สำเร็จกรุณาตรวจสอบการตั้งค่าเชื่อมต่อ');</script>";
                    echo "<script>";
                    echo "window.location='index.php';";
                    echo "</script>";

                endif;

            endif;

        endif;
    }

    public function logOut() {
        session_start();
        session_unset();
        session_destroy();
        echo "<script>";
        echo "window.location='index.php';";
        echo "</script>";
    }

}
