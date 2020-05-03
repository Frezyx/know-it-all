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

$path = "https://gufo.me/dict/kuznetsov?page=".$pageNum."&letter=".$chars[$charIndex];
$data = file_get_html($path);

if($data->innertext!='' and count($data->find('div #all_words'))){
    $pageNum += 1;
    $linkToNext = "https://gufo.me/dict/kuznetsov?page=".$pageNum."&letter=".$chars[$charIndex];
        foreach ($data->find('div #all_words') as $table) {

            $column1 = str_get_html($table->find("div .col-sm-12")[0]);

            foreach ($column1->find("ul li a") as $line) {
                file_get_contents($server_link.$sendData."?name=".$line->innertext."&path=".$line->href."&charNum=".$charIndex."&pageIndex=".$pageNum);
            }

            if( count( $table->find( "div .col-sm-12")) > 1 ) {
                $column2 = str_get_html($table->find("div .col-sm-12")[1]);
                foreach ($column2->find("ul li a") as $line) {
                    file_get_contents($server_link.$sendData."?name=".$line->innertext."&path=".$line->href."&charNum=".$charIndex."&pageIndex=".$pageNum);
                }
            }
            else if(count($column2->find("ul li a"))< 50){
                $charIndex += 1;
                $pageNum = 0;
                file_get_contents($server_link.$sendData."?name=".$line->innertext."&path=".$line->href."&charNum=".$charIndex."&pageIndex=".$pageNum);
            }
            else{
                $charIndex += 1;
                $pageNum = 0;
            }
        }

    file_get_contents($server_link.$main."?charNum=".$charIndex."&pageIndex=".$pageNum);
}
?>
