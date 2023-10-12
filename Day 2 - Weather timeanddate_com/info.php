<?php
include("simple_html_dom.php");
$link = $_GET["loc"];

$html = file_get_html($link);

$el_overview = $html->find("#qlook",0);

$img = $el_overview->find("#cur-weather",0)->src;


$temp = $el_overview->find(".h2",0)->text();

$desc = $el_overview->find("p",0)->text();

$info =[];

$info["img"] = $img;
$info["temp"] = html_entity_decode($temp);
$info["desc"] = $desc;

foreach($html->find(".bk-focus__info tbody tr") as $item)
{
    $key = trim(str_replace(":","",$item->find("th",0)->text()));
    $key = strtolower(str_replace(" ","_",$key));
    $val = html_entity_decode(trim($item->find("td",0)->text()));
    $info[$key]=$val;
}


$arr_info = explode("\n",$el_overview->find("p",1)->text());
$info["wind"]= trim(str_replace("Wind: ","",explode("↑",$arr_info[2])[0]));

echo json_encode($info);

