<?php
session_start();

require_once "connect.php";

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    
    if($conn->connect_errno!=0){
        echo "Error: ".$conn->connect_errno;
        return false;
    }
    else
    {
        $sql = "SELECT id, login, name, code FROM users 
                WHERE login = '".$_POST["login"]."' AND password = '".$_POST["password"]."'";

        if($result = @$conn->query($sql)){

            $howManyRows = $result->num_rows;

            if($howManyRows==1){
                while($row = $result->fetch_assoc()) {
                    $_SESSION["userId"] = $row["id"];
                    $_SESSION["userName"] = $row["name"];
                    $_SESSION["userCode"] = $row["code"];
                    $_SESSION["userLogin"] = $row["login"];
                }
                header("location: ../public/mymess.php");
            }
            else{
                header("location: ../public/index.php");
            }
        }

    }