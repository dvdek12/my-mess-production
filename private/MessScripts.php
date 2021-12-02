<?php

function showConversations($userId,$conn){

        $sql = "SELECT id_sender, ifRead FROM conversations 
                WHERE id_user = '".$userId."'";

        if($result = @$conn->query($sql)){

            $howManyConv = $result->num_rows;

            if($howManyConv>0){
                while($row = $result->fetch_assoc()) {
                    $id = $row["id_sender"];
                    $sql = "SELECT name FROM users 
                    WHERE id = '".$id."'";
    
                    if($result1 = @$conn->query($sql)){
    
                        $howManyConv2 = $result1->num_rows;
        
                        if($howManyConv2>0){
                            $name = $result1->fetch_assoc()["name"];

                            echo '
                        <div class="flex flex-row space-x-4 items-center">
                                <img src="profPics/'.profPicPath($id,$conn).'" alt="" class="w-8 h-8">
                                <div style=" 
                                background: rgb(91,88,138);
                                background: linear-gradient(90deg, rgba(91,88,138,1) 4%, rgba(131,126,217,1) 18%, rgba(157,157,204,1) 41%, rgba(180,204,233,1) 64%, rgba(67,192,218,1) 84%, rgba(94,191,210,1) 96%); "
                                    class="p-1 w-64 md:w-auto h-12 rounded-lg">
                                <div class="bg-blue-400 h-full w-full rounded-md py-2 px-2 font-bold text-white ">
                                <form action="mymess.php" method="post">
                                    <button class="text-gray-800 font-semibold" name="what" value="'.$id.'">
                                        '.$name.'
                                    </button>
                                    
                                    <input type="hidden" name="name" value="'.$name.'">';
                                if($row["ifRead"]==0)echo ' <img src="assets/newMessage.png" alt="" class="w-8 h-8">';
                               echo '</form>
                            </div>
                        </div>
                    </div>';
                        }
                    }
                }
            }


        }

} 

function showMessages($receiverId,$senderId,$conn){

    $sql = "SELECT ifGroup FROM users WHERE id = '".$senderId."'";

        if($result = @$conn->query($sql)){
            $howManyRows = $result->num_rows;
            if($howManyRows>0){
                while($row = $result->fetch_assoc()) {
                    if($row["ifGroup"]==0){
                        return showMessagesWithUser($receiverId,$senderId,$conn);
                    }
                    else{
                        return showMessagesWithGroup($receiverId,$senderId,$conn);
                    }
                }
            }
        }

}


function showMessagesWithUser($receiverId,$senderId,$conn){

    
        $sql = "SELECT id, id_sender, id_receiver, sendDate, text FROM messages
                WHERE id_sender = '".$senderId."' AND id_receiver = '".$receiverId."'
                OR id_sender = '".$receiverId."' AND id_receiver = '".$senderId."'";

        if($result = @$conn->query($sql)){

            updateIfRead(1,$receiverId,$senderId,$conn);

            $howManyRows = $result->num_rows;

            if($howManyRows>0){
                while($row = $result->fetch_assoc()) {
                    if($row["id_sender"]==$senderId){

                        echo '
                        <div class="inline-flex items-center space-x-3 cursor-pointer">
                            <img src="profPics/'.profPicPath($senderId,$conn).'" alt="" class="w-8 h-8 self-start">
                            <div class="inline-flex space-x-0 items-center">

                                <div onclick="showMessageInfo('.$row["id"].')" class="z-40 w-auto p-4 bg-gray-700 text-white font-semibold rounded-2xl h-auto shadow-xl self-start">
                                    <p class="text-sm">'.$row["text"].'</p>
                                </div>

                                <div class="text-gray-700 text-xs  transform ease-in-out duration-200 -translate-x-full " id="ms'.$row["id"].'">
                                    '. substr($row["sendDate"], 10, 6) .'
                                </div>

                                

                            </div>
                        </div>
                        ';
                        $last = "notYou";
                    }
                    else 
                    {
                        echo '
                        <div class="inline-flex items-center space-x-3 place-self-end cursor-pointer"> <!-- prawa -->
                            <div class="inline-flex space-x-0 items-center">
                                <div id="ms'.$row["id"].'" class="text-gray-700 text-xs  transform ease-in-out duration-200 translate-x-full ">
                                '.substr($row["sendDate"], 10, 6)   .'
                                </div>
                                <div onclick="showMessageInfo('.$row["id"].')" class="z-40 w-auto p-4 bg-purple-700 text-white font-semibold rounded-2xl h-auto shadow-xl self-start">
                                    <p class="text-sm">'.$row["text"].'</p>
                                </div>
                            </div>
                            <img src="profPics/'.profPicPath($receiverId,$conn).'" alt="" class="w-8 h-8 self-start">
                        </div>
                        ';
                        $last = "you";
                    }
                }
                if($last == "you"){
                    $sql = "SELECT ifRead FROM conversations WHERE id_sender='".$receiverId."' AND id_user='".$senderId."'";

                    if($result = @$conn->query($sql)){
                
                        $howManyRows = $result->num_rows;
                
                        if($howManyRows>0){
                            $row = $result->fetch_assoc();
                            if($row["ifRead"]==1){
                            echo '<div class="inline-flex items-center space-x-3 place-self-end">
                                <img style="margin-top: -60px" src="../public/assets/read.png" class="w-6 h-6">
                                </div>';
                            }
                            else{
                                echo '<div class="inline-flex items-center space-x-3 place-self-end">
                                <img style="margin-top: -70px" src="../public/assets/notRead.png" class="w-6 h-6">
                                </div>';
                            }
                        }
                    }
                }
                else{
                    echo '<div class="inline-flex items-center space-x-3">
                            <img style="margin-top: -80px" src="../public/assets/read.png" class="w-6 h-6">
                        </div>';
                }
            }
        }
}

function showMessagesWithGroup($receiverId,$senderId,$conn){

    
    $sql = "SELECT id, sendDate, id_sender, id_receiver, text FROM messages
            WHERE id_sender = '".$senderId."' or id_receiver = '".$senderId."'";

    if($result = @$conn->query($sql)){

        updateIfRead(1,$receiverId,$senderId,$conn);

        $howManyRows = $result->num_rows;

        if($howManyRows>0){
            while($row = $result->fetch_assoc()) {
                if($row["id_sender"]!=$receiverId){

                    echo '
                    <div class="inline-flex items-center space-x-3" style=": -50px">'.userInfo($row["id_sender"],"name",$conn).'</div>
                    <div class="inline-flex items-center space-x-3">
                    <img src="profPics/'.profPicPath($row["id_sender"],$conn).'" alt="" class="w-8 h-8 self-start">
                    <div onclick="showMessageInfo('.$row["id"].')"  class="w-auto p-4 bg-gray-700 text-white font-semibold rounded-2xl h-auto shadow-xl self-start">
                        <p class="text-sm">'.$row["text"].'</p>
                    </div>
                    <div id="ms'.$row["id"].'" style="display: none">'.$row["sendDate"].'</div>
                    </div>
                    
                    ';

                }
                else 
                {
                    echo '
                    <div class="inline-flex items-center space-x-3 place-self-end"> <!-- prawa -->
                    <div id="ms'.$row["id"].'" style="display: none">'.$row["sendDate"].'</div>
                    <div onclick="showMessageInfo('.$row["id"].')"  class="w-auto p-4 bg-purple-700 text-white font-semibold rounded-2xl h-auto shadow-xl self-start">
                        <p class="text-sm">'.$row["text"].'</p>
                    </div>
                    <img src="profPics/'.profPicPath($receiverId,$conn).'" alt="" class="w-8 h-8 self-start">
                    </div>
                    ';

                }
              }
        }
    }
}


function updateIfRead($ifRead,$userId,$senderId,$conn){

    $sql = "UPDATE conversations SET ifRead = '".$ifRead."' WHERE id_user='".$userId."' AND id_sender='".$senderId."'";
    $conn->query($sql);
}


function addConversation($userId,$senderId,$conn){
    $sql = "SELECT * FROM conversations WHERE id_user='".$userId."' AND id_sender='".$senderId."'";

    if($result = @$conn->query($sql)){

        $howManyRows = $result->num_rows;

        if($howManyRows==0){
            $sql = "INSERT INTO conversations (id_user, id_sender, ifRead) VALUES ('".$userId."', '".$senderId."', 1)";
            $conn->query($sql);
        }
    }
}


function profPicPath($userId,$conn){
    $sql = "SELECT prof_pic FROM users WHERE id='".$userId."'";

    if($result = @$conn->query($sql)){

        $howManyRows = $result->num_rows;

        if($howManyRows>0){
            $row = $result->fetch_assoc();
            return $row["prof_pic"];
            
        }
    }
}


function addFriend($code, $user, $conn){
    $sql = "SELECT id FROM users WHERE code='".$code."'";

    if($result = @$conn->query($sql)){

        $howManyRows = $result->num_rows;

        if($howManyRows>0){
            $row = $result->fetch_assoc();
            addConversation($user,$row["id"],$conn);
            addConversation($row["id"],$user,$conn);
            
        }
    }
}


function changeName($userId,$name,$conn){

    if(strlen($name)>2 && strlen($name)<20){

        $sql = "UPDATE users SET name = '".$name."' WHERE id='".$userId."'";
        $conn->query($sql);
    }
}


function genRand($length){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function addGroup($name,$file,$conn){
    $login = genRand(18);
    $password = genRand(18);

    $sql = "INSERT INTO users (login, password, name, code, ifGroup) VALUES ('".$login."','".$password."','".$name."','".genRand(5)."',1)";
    $conn->query($sql);

    $sql = "SELECT id, code FROM users WHERE login = '".$login."' AND password = '".$password."'";

    if($result = @$conn->query($sql)){

        $howManyRows = $result->num_rows;

        if($howManyRows>0){
            $row = $result->fetch_assoc();
            $tmp_name = $file["tmp_name"];
            $name = $file["name"];
            move_uploaded_file($tmp_name, "../public/profPics/".$name);
            $newName=strval($row["id"]).$name;
            if($newName == $row["id"]){$newName = "group.png";}
            rename("../public/profPics/".$name, "../public/profPics/".$newName);
            $sql = 'UPDATE users SET prof_pic = "'.$newName.'" WHERE id='.$row["id"].'';
            $conn -> query($sql);
            addFriend($row["code"],$_SESSION["userId"],$conn);
        }
    }
}


function showGroupCode($id,$conn){
    
    $sql = "SELECT code,ifGroup FROM users WHERE id = '".$id."'";

        if($result = @$conn->query($sql)){
            $howManyRows = $result->num_rows;
            if($howManyRows>0){
                $row = $result->fetch_assoc();
                if($row["ifGroup"]==0){
                    echo "";
                }
                else{
                    echo $row["code"];
                }
            }   
        }
}

function userInfo($userId,$what,$conn){

    $sql = "SELECT ".$what." FROM users WHERE id = '".$userId."'";

    if($result = @$conn->query($sql)){
        $howManyRows = $result->num_rows;
        if($howManyRows>0){
            $row = $result->fetch_assoc();
            return $row[$what];
        }   
    }
}


