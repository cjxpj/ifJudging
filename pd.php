<?php
/*
* 星空★Super小啤酒
* QQ：2960965389
*/

class jsqpd{
public static function str_split_unicode($str, $l = 0) {
if ($l > 0) {
$ret = array();
$len = mb_strlen($str, "UTF-8");
for ($i = 0; $i < $len; $i += $l) {
$ret[] = mb_substr($str, $i, $l, "UTF-8");
}
return $ret;
}
return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}



public static function run($s){
$Str=[
"J"=>1,
"one"=>"false",
"G"=>0
];
$array=self::str_split_unicode($s);
$array_num=sizeof($array)?:0;

for($i=0;$i<=($array_num-1);$i++){
$val=$array[$i];
$Val=@$array[($i+1)];
if($Str["G"]>=3){
$Str["J"]++;
$Str["G"]=0;
}
switch ($val.$Val) {
case '==':
$Str["one"]="false";
$Str["G"]++;
$Str[($Str["J"])]["two"]=$val.$Val;
break;
case '!=':
$Str["one"]="false";
$Str["G"]++;
$Str[($Str["J"])]["two"]=$val.$Val;
break;
case '>=':
$Str["one"]="false";
$Str["G"]++;
$Str[($Str["J"])]["two"]=$val.$Val;
break;
case '<=':
$Str["one"]="false";
$Str["G"]++;
$Str[($Str["J"])]["two"]=$val.$Val;
break;
default:
switch($val){
case '>':
$Str["G"]++;
$Str["one"]="true";
$Str[($Str["J"])]["two"]=$val;
break;
case '<':
$Str["G"]++;
$Str["one"]="true";
$Str[($Str["J"])]["two"]=$val;
break;
case '|':
$Str["one"]="true";
$Str["G"]++;
$Str[($Str["J"])]["jump"]=$val;
break;
case '&':
$Str["one"]="true";
$Str["G"]++;
$Str[($Str["J"])]["jump"]=$val;
break;
default:
if($Str["G"]==1){
if($Str["one"]=="true"){
$Str["one"]="false";
$Str[($Str["J"])]["three"].=$val;
}
$Str["G"]++;
}elseif($Str["G"]==0){
$Str[($Str["J"])]["one"].=$val;
}elseif($Str["G"]==2) {
$Str[($Str["J"])]["three"].=$val;
}

}
   
break;
}
}
return $Str;
}


//运行传入
public static function pd($msg){
$start=new \Thesaurus\Robot\run;
$sj=self::run($msg);
// print_r($sj);
$num=$sj["J"];
$data="";
for($i=1;$i<=$num;$i++){
// echo($sj[$i]["one"]);
$one=$start->Variable_information_conversion($sj[$i]["one"],"1");
$three=$start->Variable_information_conversion($sj[$i]["three"],"1");
if(preg_match('/^(-?[0-9]+(\.[0-9])?)$/',$one)&&preg_match('/^(-?[0-9]+(\.[0-9])?)$/',$three)){
$one=floatval($one);
$three=floatval($three);
}
// echo($one." ".$three);
switch($sj[$i]["two"]){
case "==":
if($one==$three){
$data.="true";
}else{
$data.="false";
}
break;
case "!=":
if($one!=$three){
$data.="true";
}else{
$data.="false";
}
break;
case ">=":
if($one>=$three){
$data.="true";
}else{
$data.="false";
}
break;
case "<=":
if($one<=$three){
$data.="true";
}else{
$data.="false";
}
break;
case ">":
if($one>$three){
$data.="true";
}else{
$data.="false";
}
break;
case "<":
if($one<$three){
$data.="true";
}else{
$data.="false";
}
break;
default:
switch($sj[$i]["jump"]){
case "|":
case "&":
//if($sj[$i]["one"]){
if((is_numeric($one)&$one>"0"&$one)|$one=="true"){
$data.="true";
}else{
$data.="false";
}
$data.=$sj[$i]["jump"];
if($sj[$i]["three"]=="true"){
$data.="true";
}else{
$data.="false";
}
break;//

default:
//if($sj[$i]["one"]){
if((is_numeric($one)&$one>"0"&$one)|$one=="true"){
$data.="true";
}else{
$data.="false";
}
}
}
if(($i+1)<=$num){
switch($sj[$i]["jump"]){
case "|":
$data.="|";
break;
case "&":
$data.="&";
break;
}
}

}//preg_replace("/(\&|\|)\$/","",$data)
return $data;
}

}



