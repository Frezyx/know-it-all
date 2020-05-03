<?php
require "connect.php";
require_once "./simplehtmldom_1_9_1/simple_html_dom.php";

if(isset($_GET["word"])){
    if(!empty($_GET["word"])){

        $word = $_GET["word"];
        $word = html_entity_decode(
            $word, 
            ENT_COMPAT, 
            "UTF-8"
         );
        $word = strtolower($word);
        // echo gettype ($word);

        $query = mysqli_query($link, "SELECT * FROM `links` WHERE `name` LIKE '%$word%'");
        $row = mysqli_fetch_assoc($query); 
        if(isset($row["path"])){
            echo $row["path"]; 
            $path = "https://gufo.me/".$row["path"];
            $data = file_get_html($path);
        }
        else{
            echo "Я не смог найти объяснение этому слову";
        }
    }
    else{
        echo "1";
    }
}
else{
    echo "2";
}

?>