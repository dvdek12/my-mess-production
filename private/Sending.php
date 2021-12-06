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

        if(!empty($_FILES["file"]["name"]) || !empty($_FILES["pic"]["name"])){
            if(!empty($_FILES["file"]["name"]) && !empty($_FILES["pic"]["name"])){
                echo "oba";
                $sql = "INSERT INTO messages(id_receiver, id_sender, text) VALUES ('".$_SESSION["who"]."', '".$_SESSION["userId"]."' ,'Nie mozna wyslac 2 rodzajow plikow jednoczesnie !')";
            }
            else if(!empty($_FILES["file"]["name"])){
                echo "doc";
                $file = $_FILES["file"];
                $tmp_name = $file["tmp_name"];
                $rand = genRand(5);
                while(file_exists("../public/files/" . $rand . $file["name"]))
                    $rand = genRand(5);
                $codeName = $rand . $file["name"];
                move_uploaded_file($tmp_name, "../public/files/".$codeName);
                $text = strip_tags($_POST["text"]) . '<a href="files/'.$codeName.'" download> ['.$file["name"].']</a>'; // ####    wyswietlenie pliku   #####
                $sql = "INSERT INTO messages(id_receiver, id_sender, text) VALUES ('".$_SESSION["who"]."', '".$_SESSION["userId"]."' ,'".$text."')";
                }
            else if(!empty($_FILES["pic"]["name"])){
                echo "pic";
                $file = $_FILES["pic"];
                $tmp_name = $file["tmp_name"];
                $rand = genRand(5);
                while(file_exists("../public/files/" . $rand . $file["name"]))
                    $rand = genRand(5);
                $codeName = $rand . $file["name"];
                move_uploaded_file($tmp_name, "../public/files/".$codeName);
                $text = strip_tags($_POST["text"]) . '<img src="files/'.$codeName.'">'; // ####    wyswietlenie zdjecia   #####
                $sql = "INSERT INTO messages(id_receiver, id_sender, text) VALUES ('".$_SESSION["who"]."', '".$_SESSION["userId"]."' ,'".$text."')";
                echo $sql;
            }

        }
        else{
            $sql = "INSERT INTO messages(id_receiver, id_sender, text) VALUES ('".$_SESSION["who"]."', '".$_SESSION["userId"]."' ,'".strip_tags($_POST["text"])."')";
        }



    $conn1 -> query($sql);

    updateIfRead(0,$_SESSION["who"],$_SESSION["userId"],$conn1);

    $conn1 -> close();

    header("location: ../public/mymess.php");
    }

?>