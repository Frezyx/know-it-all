<?php
ini_set("max_execution_time", 10000);
set_time_limit(10000);

require_once "./simplehtmldom_1_9_1/simple_html_dom.php";
require_once "./sqlHelper.php";

$server_link = "http://localhost/know-it-all/parser/";
$main = "getAllItems.php";
$sendData = "sqlHelper.php";

if(isset($_GET['path'])){
    $path = "https://gufo.me".$_GET['path'];
}
else{
    $path = "https://gufo.me/dict/kuznetsov";
}

$data = file_get_html($path);

$srcs = array();
if($data->innertext!='' and count($data->find('div #all_words'))){
        foreach ($data->find('div #all_words') as $table) {

            $column1 = str_get_html($table->find("div .col-sm-12")[0]);
            $column2 = str_get_html($table->find("div .col-sm-12")[1]);

            foreach ($column1->find("ul li a") as $line) {
                // $srcs[$line->innertext] = 'https://gufo.me'.$line->href;
                $linkToNext = getLink($data);
                file_get_contents($server_link.$sendData."?name=".$line->innertext."&path=".$line->href);
            }

            foreach ($column2->find("ul li a") as $line) {
                // $srcs[$line->innertext] = 'https://gufo.me'.$line->href;
                $linkToNext = getLink($data);
                file_get_contents($server_link.$sendData."?name=".$line->innertext."&path=".$line->href);
            }
        }
        sleep(10);
        file_get_contents($server_link.$main."?path=".$nexLink);
}

function getLink($data){
    $links = $data->find('#next-page-control div a');
    $nexLink = count($links) == 1? $links[0]->href: $links[1]->href;
    return $nexLink;
}
?>