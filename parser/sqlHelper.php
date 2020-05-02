<?php

if(isset($_GET["path"]) && isset($_GET["name"]) && isset($_GET["nextLink"])){
    if(!empty($_GET["path"]) && !empty($_GET["name"]) && !empty($_GET["nextLink"])){
        sendData($_GET["name"], $_GET["path"], $_GET["nextLink"]);
    }
}

function sendData($name, $path, $linkToNext){
    require 'connect.php';

    $query = mysqli_query($link, "SELECT * FROM links ORDER BY id DESC LIMIT 1");
    $data = mysqli_fetch_array($query);
    $charNum = $data['charNum'];

    $result = mysqli_query($link,
    "INSERT INTO `links` (`id`, `name`, `path`, `linkToNext`, `charNum`) 
        VALUES (NULL, '$name', '$path', '$linkToNext', '$charNum');");
}

function getPathFromSql(){
    require 'connect.php';
    $query = mysqli_query($link, "SELECT * FROM links ORDER BY id DESC LIMIT 1");
    $count = mysqli_num_rows($query);
    if($count != 1){
        $path = "https://gufo.me/dict/kuznetsov";
    }
    else{
        $data = mysqli_fetch_array($query);
        $path = "https://gufo.me".$data["linkToNext"];
    }
    return $path;
}
?>