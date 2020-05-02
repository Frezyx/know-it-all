<?php

if(isset($_GET["path"]) && isset($_GET["name"])){
    if(!empty($_GET["path"]) && !empty($_GET["name"])){
        sendData($_GET["name"], $_GET["path"]);
    }
}

function sendData($name, $path){
    require 'connect.php';
    $result = mysqli_query($link,
    "INSERT INTO `links` (`id`, `name`, `path`) VALUES (NULL, '$name', '$path');");
}
?>