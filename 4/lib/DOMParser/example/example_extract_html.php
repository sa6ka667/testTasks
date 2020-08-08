<?php
include_once('../simple_html_dom.php');

// Create DOM from URL or file
$html = file_get_html('https://terrikon.com/football/italy/championship/');
//Получаем таблицу со всеми сезонами
$season = $html->find('div.news',1)->find('dd');
//Получаем один сезон
//season - массив сезонов
$count = count($season);




$seasons = array();
for($i=0;$i<=($count-1);$i++){
    $seasonTitle = explode('">',$season[$i]);
    $seasonLink = str_replace('<a href="', 'https://terrikon.com', $season[$i]);
    $seasonLink = strtok($seasonLink,'"');
    $seasons += [$seasonLink=>$seasonTitle[1]];
}

foreach ($seasons as $link => $title) {
    echo "...$link => $title\n";
}

?>