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
        // $word = strtolower($word);
        $path = "https://gufo.me/dict/kuznetsov/".$word;

        $data = file_get_html($path);
        foreach ($data->find('#dictionary-acticle article') as $table) {
            $column = str_get_html($table);
            foreach ($column->find('p') as $line) {
                echo str_get_html($line);
            }
        }

        #dictionary-acticle > article

        // $query = mysqli_query($link, "SELECT * FROM `links` WHERE `name` = '$word'");
        // $row = mysqli_fetch_assoc($query); 
        // echo $row["path"]; 


        // if($count < 1){
        //     echo "Я не смог найти объяснение этому слову";
        // }
        // else{ 
        // echo $data["path"]; 
        // }

    }
    else{
        echo "1";
    }
}
else{
    echo "2";
}

?>