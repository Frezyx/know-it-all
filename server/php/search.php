<?php
require "connect.php";
require_once "./simplehtmldom_1_9_1/simple_html_dom.php";

if(isset($_GET["word"])){
    if(!empty($_GET["word"])){

        $word = $_GET["word"];
        $word = html_entity_decode(
            $word, ENT_COMPAT, "UTF-8");

        $path = "https://gufo.me/dict/kuznetsov/".$word;

        $data = file_get_html($path);
        foreach ($data->find('#dictionary-acticle article') as $table) {
            $column = str_get_html($table);
            foreach ($column->find('p') as $line) {
                echo str_get_html($line);
            }
        }

        //Now Not used

        // $query = mysqli_query($link, "SELECT * FROM `links` WHERE `name` = '$word'");
        // $row = mysqli_fetch_assoc($query); 
        // echo $row["path"]; 

    }
    else{
        echo "Что-то не так";
    }
}
else{
    echo "Что-то не так";
}

?>