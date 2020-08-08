<?php
class Parsing{
    public static function getLinksAndTitles(){
        include_once('./lib/DOMParser/simple_html_dom.php');

        // Create DOM from URL or file
        $html = file_get_html('https://terrikon.com/football/italy/championship/');
        //Получаем таблицу со всеми сезонами
        $season = $html->find('div.news',1)->find('dd');
        //Получаем один сезон
        //season - массив сезонов
        $count = count($season);
        //Создаём массив вида [link => title]
        $seasons = array();
        for($i=0;$i<=($count-1);$i++){
            $seasonTitle = explode('">',$season[$i]);
            $seasonLink = explode('"',$season[$i]);
            $seasonLink = "https://terrikon.com" . $seasonLink[1];
            $seasons += [$seasonLink=>$seasonTitle[1]];
        }
        return $seasons;
    }
    public static function parseOneSeason($teamName,$link,$title){
        $html = file_get_html($link);
        $rows = $html->find("table.colored.big tr a[!class]");
        // echo $rows;
        for($i=0; $i<=count($rows)-1;$i++){
            $pos = strstr($rows[$i], $teamName);
            if($pos){
                $place = $i+1;
                $message = "$title : Команда $teamName заняла $place Место<br>";
                return $message;
            }
        }
    }
    public static function allParse($teamName){
        $seasons = Parsing::getLinksAndTitles();
        $message = '';
        foreach ($seasons as $link => $title){
            $seasonInfo = Parsing::parseOneSeason($teamName,$link, $title);
            $message = $message . $seasonInfo;
        }
        return $message;
    }

    
}

