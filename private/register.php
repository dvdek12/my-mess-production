<?php
session_start();

require_once "connect.php";
require "MessScripts.php";

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    
    if($conn->connect_errno!=0){
        echo "Error: ".$conn->connect_errno;
        return false;
    }
    else
    {

        if($_POST["password"]==$_POST["rePassword"])
        {
            if(strlen($_POST["login"])>3 || strlen($_POST["password"]>3))
            {
                $sql = "SELECT id, login, name, code FROM users 
                WHERE login = '".$_POST["login"]."'";

                if($result = @$conn->query($sql))
                {
                    $howManyRows = $result->num_rows;
                    
                    if($howManyRows==0){
                        $sql2 = "INSERT INTO users (login, password, name, code) VALUES ('".$_POST["login"]."','".$_POST["password"]."','".$_POST["login"]."','".genRand(5)."' )";
                        $conn->query($sql2);
                    }
                    else{
                    $_SESSION["error"] = "login exists"; 
                    header("location: ../public/index.php");
                    }
                }
            
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
                    else
                    {
                        $_SESSION["error"] = "something goes wrong :c"; 
                        header("location: ../public/index.php");
                    }
                }
            }
            else
            $_SESSION["error"] = "login and password must have more than 3 characters"; 
            header("location: ../public/index.php");
        }
        else
        $_SESSION["error"] = "passwords are not the same"; 
        header("location: ../public/index.php");
    }
