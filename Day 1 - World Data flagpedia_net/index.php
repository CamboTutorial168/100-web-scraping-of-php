<?php
include("simple_html_dom.php");
set_time_limit(500);
$html = file_get_html("https://flagpedia.net/index#t");
$arr=[];
foreach($html->find(".flag-grid li") as $li)
{
    $tmp=[];
    $name_flag = trim($li->find("a",0)->text());
    $area = $li->find("a",0)->attr["data-area"];
    $population = $li->find("a",0)->attr["data-population"];
    $link_flag = "https://flagpedia.net".$li->find("a img",0)->src;
    $link = "https://flagpedia.net".$li->find("a",0)->href;

    $detail_html = file_get_html($link);

    $arr_detail = [];
    foreach($detail_html->find(".table-dl tr") as $tr)
    {
        $key = $tr->find("th",0)->text();
        $value = $tr->find("td",0)->text();
        $arr_detail[$key] = $value;
    }

    $tmp["name"] = $name_flag;
    $tmp["area"] = $area;
    $tmp["pop"] = $population;
    $tmp["link_flag"] = $link_flag;
    $tmp["detail"] = $arr_detail;
    $arr[] = $tmp;
}

var_dump($arr);
?>