<?php

require_once "./simplehtmldom_1_9_1/simple_html_dom.php";
require_once "./sqlHelper.php";

$data = file_get_html('https://gufo.me/dict/kuznetsov?page=19&letter=а');

$charPanel = $data->find('#abc table tbody tr td');
$panel = str_get_html($charPanel[0]);
echo str_get_html($panel->find("a")[0]);

?>
