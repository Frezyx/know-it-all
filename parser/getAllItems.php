<?php
ini_set("max_execution_time", 1000);
set_time_limit(1000);

require_once "./simplehtmldom_1_9_1/simple_html_dom.php";
require_once "./sqlHelper.php";

$server_link = "http://localhost/know-it-all/parser/";
$main = "getAllItems.php";

$chars = ['а', 'б', 'в', 'г', 'д', 'е', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'э', 'ю', 'я'];

$sendData = "sqlHelper.php";

if(isset($_GET['charNum'])&& isset($_GET['pageIndex'])){
    $pageNum = (int)$_GET['pageIndex'];
    $charIndex = (int)$_GET['charNum'];
}
else{
    require "connect.php";
    $query = mysqli_query($link, "SELECT * FROM links ORDER BY id DESC LIMIT 1");
    $count = mysqli_num_rows($query);
    if($count != 1){
        $pageNum = 0;
        $charIndex = 0;
    }
    else{
        $data = mysqli_fetch_array($query);
        $pageNum = (int)$data['pageIndex'];
        $charIndex = (int)$data['charNum'];
    }
}


//TODO: Сохранять в бд значения страницы и буквы


$path = "https://gufo.me/dict/kuznetsov?page=".$pageNum."&letter=".$chars[$charIndex];

$data = file_get_html($path);

if($data->innertext!='' and count($data->find('div #all_words'))){
    $pageNum += 1;
    $linkToNext = "https://gufo.me/dict/kuznetsov?page=".$pageNum."&letter=".$chars[$charIndex];
        foreach ($data->find('div #all_words') as $table) {

            $column1 = str_get_html($table->find("div .col-sm-12")[0]);
            if( count( $table->find( "div .col-sm-12")) > 1 ) {
                $column2 = str_get_html($table->find("div .col-sm-12")[1]);
            }
            else{
                $charIndex += 1;
                $pageNum = 0;
                file_get_contents($server_link.$main."?charNum=".$charIndex."&pageIndex=".$pageNum);
            }

            foreach ($column1->find("ul li a") as $line) {
                file_get_contents($server_link.$sendData."?name=".$line->innertext."&path=".$line->href."&charNum=".$charIndex."&pageIndex=".$pageNum);
            }

            foreach ($column2->find("ul li a") as $line) {
                file_get_contents($server_link.$sendData."?name=".$line->innertext."&path=".$line->href."&charNum=".$charIndex."&pageIndex=".$pageNum);
            }
        }
        sleep(5);

    file_get_contents($server_link.$main."?charNum=".$charIndex."&pageIndex=".$pageNum);
}

// function getLink($data, $path){
//     $links = $data->find('#next-page-control div a');
//     if(count($links) == 1 && ($links[0]->innertext == "Назад" || $links[0]->rel == "prev")){
        
//         require 'connect.php';
//         $query = mysqli_query($link, "SELECT * FROM links ORDER BY id DESC LIMIT 1");
//         $data = mysqli_fetch_array($query);

//         $charNum = 1 + (int)$data["charNum"];

//         $nowId = $data['id'];
//         mysqli_query($link, "UPDATE `links` SET `charNum` = '$charNum' WHERE `links`.`id` = '$nowId';");

//         $data2 = file_get_html($path);
//         $charPanel = $data2->find('#abc table tbody tr td');

//         $panel = str_get_html($charPanel[0]);
//         $linkToNext = $panel->find("a")[$charNum - 1]->href;
//         header('Location: '.$server_link.$main."?path=".$linkToNext);
//         die();
//     }
//     else{
//         $nexLink = count($links) == 1? $links[0]->href: $links[1]->href;
//     }
//     return $nexLink;
// }

?>
