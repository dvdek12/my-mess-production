<?php
session_start();

    if(isset($_POST['run'])){
        if($_POST['run']=="user"){
            $who = $_SESSION["userId"];
        }
        else{
            
        }
    }

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

    // if($PictureName == $basic){
    //     echo '<form action="ChoosePhoto.php" method="POST" enctype="multipart/form-data">
    //     <input type="file" name="file" id="file">
    //     <input type="submit" name="run" id="run" value="ok">
    //     </form>';
    // }
    // else{
    //     unlink("../public/profPics/".$PictureName);
    //     $sql = 'UPDATE users SET prof_pic = "'.$basic.'" WHERE user_id = '.$_SESSION['userId'].'';
    //     $conn1 -> query($sql);
    //     $conn1 -> close();
    //     header("location: ../public/index.php");
    // }

    
    
    if($conn1->connect_errno!=0){
        echo "Error: ".$conn1->connect_errno;
        return false;
    }
    else
    {
        if(isset($_POST['run'])){
            $file = $_FILES["file"];
            $tmp_name = $file["tmp_name"];
            $name = $file["name"];
            move_uploaded_file($tmp_name, "../public/profPics/".$name);
            $newName=strval($_SESSION["userId"]).$name;
            rename("../public/profPics/".$name, "../public/profPics/".$newName);
            echo $newName;
            $sql = 'UPDATE users SET prof_pic = "'.$newName.'" WHERE id='.$_SESSION["userId"].'';
            $conn1 -> query($sql);
            $conn1 -> close();
            header("location: ../public/index.php");
        }
    }
    // $sql = "INSERT INTO messages(id_receiver, id_sender, text) VALUES ('".$_SESSION["who"]."',1 ,'".$_POST["text"]."')";

    // $conn1 -> query($sql);

    // $conn1 -> close();

    //header("location: ../public/index.php");
    

?>
<script>
// const body = document.querySelector('#file');

// body.addEventListener('click', e => {
//   console.log('clicked body');
// });

// console.log('Using click()');
// body.click();

// console.log('Using dispatchEvent');
// body.dispatchEvent(new Event('click'));

</script>