<?php
session_start();

    require_once "connect.php";

    $basic = 'user (1).png';

    $conn1 = @new mysqli($host, $db_user, $db_password, $db_name);

    $sql = 'SELECT prof_pic FROM users WHERE id='.$_SESSION["userId"].'';

    if($result = @$conn1->query($sql)){

        $howManyRows = $result->num_rows;

        if($howManyRows>0){
            $row = $result->fetch_assoc();
            $PictureName = $row["prof_pic"];
        }
    }

    unlink("../public/profPics/".$PictureName);
    $sql = 'UPDATE users SET prof_pic = "'.$basic.'" WHERE id='.$_SESSION["userId"].'';
    $conn1 -> query($sql);
    $conn1 -> close();
    header("location: ../public/index.php");
?>