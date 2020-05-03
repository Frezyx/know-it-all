<?php

if(isset($_GET["path"]) && isset($_GET["name"]) && isset($_GET['charNum']) && isset($_GET['pageIndex'])){
        sendData($_GET["name"], $_GET["path"], $_GET['charNum'], $_GET['pageIndex']);
}

function sendData($name, $path, $charNum, $pageIndex){
    require 'connect.php';

    $result = mysqli_query($link,
    "INSERT INTO `links` (`id`, `name`, `path`, `charNum`, `pageIndex`) 
        VALUES (NULL, '$name', '$path', '$charNum', '$pageIndex');");
    if($result){
        echo "Записали";
    }
    else{
        echo "Ошибка";
    }
}
?>