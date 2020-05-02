<?php

if(
isset($_GET["path"]) 
&& isset($_GET["name"]) 
&& isset($_GET['charNum']) 
&& isset($_GET['pageIndex'])
){
        sendData($_GET["name"], $_GET["path"], $_GET['charNum'], $_GET['pageIndex']);
}

function sendData($name, $path, $charNum, $pageIndex){
    require 'connect.php';

    $result = mysqli_query($link,
    "INSERT INTO `links` (`id`, `name`, `path`, `charNum`, `pageIndex`) 
        VALUES (NULL, '$name', '$path', '$charNum', '$pageIndex');");
    if($result){
        echo "sss";
    }
    else{
        echo "sssssssss";
    }
}

// function getPathFromSql(){
//     require 'connect.php';
//     $query = mysqli_query($link, "SELECT * FROM links ORDER BY id DESC LIMIT 1");
//     $count = mysqli_num_rows($query);
//     if($count != 1){
//         $path = "https://gufo.me/dict/kuznetsov";
//     }
//     else{
//         $data = mysqli_fetch_array($query);
//         $path = "https://gufo.me".$data["linkToNext"];
//     }
//     return $path;
// }
// ?>