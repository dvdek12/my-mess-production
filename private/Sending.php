<?php
session_start();

    require_once "connect.php";
    require "MessScripts.php";

    $conn1 = @new mysqli($host, $db_user, $db_password, $db_name);
    $conn1->set_charset('utf8mb4');

    if($conn1->connect_errno!=0){
        echo "Error: ".$conn1->connect_errno;
        return false;
    }
    else
    {
    $sql = "INSERT INTO messages(id_receiver, id_sender, text) VALUES ('".$_SESSION["who"]."', '".$_SESSION["userId"]."' ,'".strip_tags($_POST["text"])."')";

    $conn1 -> query($sql);

    updateIfRead(0,$_SESSION["who"],$_SESSION["userId"],$conn1);

    $conn1 -> close();

    header("location: ../public/mymess.php");
    }

?>