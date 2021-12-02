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
    if(isset($_SESSION["userId"])){
        $userId = $_SESSION["userId"];
    }
    else return false;

    require "MessScripts.php";
    showConversations($userId,$conn);

}

?>	