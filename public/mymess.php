<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyMess</title>

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="fgEmojiPicker.js"></script>
    <script type="text/JavaScript">

    function ajaxRefresh(){   // ###############  AJAX refresh  #################
        setTimeout("timedRefresh(3000)",3000);
        timedRefresh2(6000);
    }


    function timedRefresh(timeoutPeriod) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      document.getElementById("conv").innerHTML = this.responseText;
    }
    xmlhttp.open("GET", "../private/refresh.php");
    xmlhttp.send();

    setTimeout("timedRefresh(3000)",timeoutPeriod);
    }

    function timedRefresh2(timeoutPeriod) {
    const xmlhttp2 = new XMLHttpRequest();
    xmlhttp2.onload = function() {
      document.getElementById("convs").innerHTML = this.responseText;
    }
    xmlhttp2.open("GET", "../private/refreshConvs.php");
    xmlhttp2.send();

    setTimeout("timedRefresh2(6000)",timeoutPeriod);
    }
</script>
    
</head>
<body class="overflow-x-hidden" onload="JavaScript:ajaxRefresh();">

  <!--                                   Okienka dodatkowe          -->
<div class="window z-50" id="addFriend">
    <img class="closeButton" src="assets/cross.png" onclick="closeWindow(this)">
    <form action="mymess.php" method="post">
        <input type="text" name="code" placeholder="kod ..."><br/>
        <input type="submit" name="func" value="dodaj"> 
    </form>
</div>

<div class="window z-50" id="addGroup" style="height: 250px; width: 450px">
    <img class="closeButton" src="assets/cross.png" onclick="closeWindow(this)">
    <form action="mymess.php" method="post" enctype="multipart/form-data">
        <input type="text" name="groupName" placeholder="nazwa grupy ..."><br/>
        <input type="file" name="file" id="file">
        <input type="submit" name="func" value="stworz"> 
    </form>
</div>

<div class="window z-50" id="changeName">
    <img class="closeButton" src="assets/cross.png" onclick="closeWindow(this)">
    <form action="mymess.php" method="post">
        <input type="text" name="newName" placeholder="Nowa Nazwa ... "><br/>
        <input type="submit" name="func" value="zmien nazwe"> 
    </form>
</div>

<div class="window z-50" id="changePhoto" style="width: 450px">
    <img class="closeButton" src="assets/cross.png" onclick="closeWindow(this)">
    <form action="../private/ChoosePhoto.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file" id="file">
        <input type="submit" name="run" id="run" value="ok">
    </form>
</div>


    <?php                   // Zaladowanie potrzebnych rzeczy i bazy danych

    if(!isset($_SESSION["userId"])){
        header("location: index.php");
    }

    require_once "../private/connect.php";

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    
    if($conn->connect_errno!=0){
        echo "Error: ".$conn->connect_errno;
        return false;
    }
    else
    {
    
    require "../private/MessScripts.php";

    ?>


    <div class="bg-blue-500 w-screen h-screen">
     <div class="flex items-center justify-center bg-gray-200 w-full h-full">
        <div class="flex flex-row w-full h-full ">

            <!-- Lewy Panel -->
            <div id="leftPanel" class="w-1/4 h-full">
                <div class="flex flex-col w-full h-full">

                    <!-- logo section -->
                    <div style="height: 10%" class="w-full  bg-gray-800 text-white text-center flex items-center justify-center text-xl font-semibold">
                        <div class="inline-flex flex-row items-center" >
                            <img src="assets/smartphone.png" alt="phone" class="w-8 h-8">
                            MyMess
                        </div>
                    </div>

                    <!-- Sekcja uzytkownikow i konwersacji DO AUTOMATYZACJI -->
                    <div class="w-full h-5/6 bg-gray-700 relative" id="vue-app">
                        <div class="h-full z-10">
                            <div class="flex flex-col h-full items-center justify-center space-y-8 p-3 md:space-y-3">
                                <div class="w-full p-1">
                                    <div class="addFriend" onclick="openWindow('addFriend')">Dodaj przez kod</div>
                                    <input v-model="search" type="text" class="focus:outline-none w-full  md:h-8 rounded-full p-3 text-white bg-gray-600" placeholder="Szukaj konwersacji... ">
                                    
                                </div>


                                <div id="convs" class="flex flex-col items-between p-5 space-y-6 md:space-y-4 h-full overflow-y-auto w-full bg-gray-800 rounded-2xl">
                                    <conversation :conv="search"></conversation>
                                    
                                    <?php

                                        if(isset($_POST["what"])){
                                            $_SESSION["who"] = $_POST["what"];
                                            $_SESSION["name"] = $_POST["name"];
                                        }

                                        if(isset($_POST["func"])){          // Odpalanie funkcji php
                                            if($_POST["func"]=="dodaj"){
                                                addFriend($_POST["code"],$_SESSION["userId"],$conn);
                                            }
                                            if($_POST["func"]=="wyloguj"){
                                                session_destroy();
                                                header("location: index.php");
                                            }
                                            if($_POST["func"]=="zmien nazwe"){
                                                changeName($_SESSION["userId"],$_POST["newName"],$conn);
                                                $_SESSION["userName"] = $_POST["newName"];
                                            }
                                            if($_POST["func"]=="back"){
                                                unset($_SESSION["who"]);
                                            }
                                            if($_POST["func"]=="stworz"){
                                                addGroup($_POST["groupName"],$_FILES["file"],$conn);
                                            }
                                        }

                                    }
                                    ?>
                                </div>
                            </div>
                        </div>


                        <!-- settigns slider -->
                        <div class="flex flex-col w-full absolute slider z-20" id="settingsSection">
                            <div class="w-full h-auto flex flex-col items-center p-5 bg-white  shadow-xl">
                                <button class="focus:outline-none " onclick="openWindow('changePhoto')">
                                    <img src="profPics/<?php echo profPicPath($_SESSION["userId"],$conn); ?>" alt="" class="w-32 h-32" id="profPic">
                                </button>
                                <div class="inline-flex space-x-3 items-baseline">
                                    <p class="text-2xl font-bold text-gray-800" onclick="openWindow('changeName')"><?php echo $_SESSION["userName"]; ?></p>
                                    <i class="fas fa-edit" onclick="openWindow('changeName')"></i>
                                </div>
                                <p ><?php echo $_SESSION["userLogin"]; ?></p>
                            </div>
    
                            <div class="w-full h-96 bg-gray-800 flex flex-col space-y-4 items-start px-5 justify-center">
                                <div class="inline-flex items-center space-x-3 text-white">
                                    <i class="fas fa-phone-square fa-2x"></i>
                                    <p class="text-lg font-semibold">Dodaj numer telefonu</p>
                                </div>
    
                                <div class="inline-flex items-center space-x-3 text-white">
                                    <i class="fas fa-question-circle fa-2x"></i>
                                    <p class="text-lg font-semibold">Centrum Pomocy</p>
                                </div>
    
                                <div class="inline-flex items-center space-x-3 text-white">
                                    <i class="fas fa-moon fa-2x"></i>
                                    <p class="text-lg font-semibold">Tryb ciemny</p>
                                </div>

                                <div class="inline-flex items-center space-x-3 text-white">
                                    <i class="fas fa-moon fa-2x"></i>
                                    <p onclick="openWindow('addGroup')" class="text-lg font-semibold">Stworz grupe</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    

                    <!-- footer section -->
                    <div class="w-full bg-gray-800 text-white flex flex-row items-center justify-between md:justify-around px-2" style="height: 10%">
                            <button class="focus:outline-none " onclick="openWindow('changePhoto')">
                                <img src="profPics/<?php echo profPicPath($_SESSION["userId"],$conn); ?>" alt="profile" class="w-6 h-6">
                            </button>
                            <div class="flex flex-col space-y-0 -ml-20">
                                <p class="text-s lg:text-sm"><?php echo $_SESSION["userName"]; ?></p>
                                <p class="text-gray-400 underline italics" style="font-size: 12px;"><?php echo $_SESSION["userCode"]; ?></a>
                            </div>
                            <button id="settingsBtn" class="focus:outline-none">
                                <i class="fas fa-cog fa-lg"></i>
                            </button>
                            <form action="mymess.php" method="POST"><button type="submit" name="func" value="wyloguj">wyloguj</button></form>
                    </div>
                </div>
            </div>



            <!-- prawa kolumna -->
            <div id="rightPanel" class="w-3/4 h-full bg-blue-300 bg-fixed" style="background-image: url('assets/slanted-gradient.svg');">
                <!-- <p class="text-3xl font-bold text-white">Nie masz z nikim konwersacji :C</p> -->
                <div id="mobileConvSize" class="w-full h-full flex justify-center items-center p-10 ">
                    <div class="w-full h-full rounded-2xl flex flex-col p-5 space-y-4">

                         <!-- PANEL GÓRNY KONWERACJI  -->
                        <?php if(isset($_SESSION["who"])){ ?>
                        <div class="w-full h-16">
                            <div class="flex flex-row items-center justify-between bg-gray-800 text-white rounded-2xl w-full h-16 py-6">
                                <form action="mymess.php" method="post"><button type="submit" name="func" value="back" class="flex-none w-24 h-16">
                                    <i class="fas fa-chevron-left p-6"></i>
                                </button></form>
                                <div class="flex-grow h-16 inline-flex items-center">
                                    <img src="profPics/<?php echo profPicPath($_SESSION["who"],$conn); ?>" alt="" class="w-12 h-12">
                                    <p class="text-lg font-semibold"><?php echo $_SESSION["name"];?></p>
                                    <p class="text-s lg:text-sm" style="margin-left: 10px"><?php showGroupCode($_SESSION["who"],$conn); ?></p>
                                </div>
                                <button id="toggle" class="flex-none w-16 h-16">
                                    <img src="assets/control.png" alt="control" class="w-8 h-8 m-4">
                                </button>

                                <!-- <div id="settingsChat" class="absolute z-20">
                                    <div class="w-64 h-72 bg-gray-900 rounded-2xl">

                                    </div>
                                </div> -->
                            </div>
                        </div>
                        
                        
                         <!-- KONWERSACJA DO AUTOMATYZACJI POZNIEJ -->
                        <div id ="messbody" class="w-full h-full bg-red-200 p-3 rounded-2xl overflow-auto">
                            <div id="conv" class="grid grid-rows-1 gap-y-6">

                                <?php 
                                $_SESSION["howMany"] = showMessages($_SESSION["userId"],$_SESSION["who"],$conn); 
                                ?>

                            </div>
                        </div>
                        

                         <!-- DOLNY PANEL KONWERSACJI  -->
                        <div class="w-full h-32 bg-gray-800 rounded-2xl">
                            <div class="flex flex-row items-center justify-between p-5">
                            <form action="../private/Sending.php" method="POST" enctype="multipart/form-data">
                                <div class="inline-flex items-center text-white space-x-3"> 

                                    <input id="textArea1" type="text" autocomplete="off" name="text" class="focus:outline-none w-32 md:w-64 h-12 lg:w-96 rounded-full p-3 text-black" placeholder="Wyślij wiadomość...">
                                        
                                        <label for="file-upload" class="custom-file-upload">
                                            <i class="fas fa-images fa-2x hover:text-blue-600"></i>
                                        </label><input id="file-upload" class="file-upload-style" type="file" name="pic">

                                        <label for="file-upload2" class="custom-file-upload">
                                            <i class="fas fa-file-alt fa-2x hover:text-blue-600"></i>
                                        </label><input id="file-upload2" class="file-upload-style" type="file" name="file">

                                    <x id="emojiButton" class="fas fa-laugh-squint fa-2x hover:text-blue-600"></x>

                                    <button name="sending"><i class="fas fa-paper-plane fa-2x text-white hover:text-blue-600"></i></button>
                                </div>
                            </form>
                            </div>
                        </div>
                        <?php 
                        }else
                        {
                            echo '<div id="conv"></div>';
                        }
                        ob_end_flush();?>


                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    <script>
        document.getElementById("addFriend").style.display = "none";
        document.getElementById("addGroup").style.display = "none";
        document.getElementById("changePhoto").style.display = "none";
        document.getElementById("changeName").style.display = "none";

                        //   ############################   Mobile Menu    #############################
        if(screen.width<2000){mobileMenu();}

        function mobileMenu() {
            <?php if(isset($_SESSION["who"])){?>
                document.getElementById("leftPanel").style.display = "none";
                document.getElementById("rightPanel").style.width = "100%";
                document.getElementById("mobileConvSize").style.padding = "0.5rem";
                document.getElementById("rightPanelPadding").style.padding = "1px";
            <?php }else{ ?>
                document.getElementById("rightPanel").style.display = "none";
                document.getElementById("leftPanel").style.width = "100%";
            <?php }?>
        }


    </script>

    <script>var chatHistory = document.getElementById("messbody"); chatHistory.scrollTop = chatHistory.scrollHeight;</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="main.js"></script>
    
</body>
</html>