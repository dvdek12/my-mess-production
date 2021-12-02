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
    if(isset($_SESSION["who"])){
        $receiverId = $_SESSION["who"];
        $senderId = $_SESSION["userId"];
        $howMany = $_SESSION["howMany"];

        require "MessScripts.php";
        showMessages($senderId,$receiverId,$conn);
    }
    else {
        return false;
    }

}

?>	