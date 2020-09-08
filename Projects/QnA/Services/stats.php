<?php
function getQuestionStats(){
//get number of questions posted
include("creds.php");

$con1=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con1->connect_error){
return "NA";
}
else{
//echo "connection successful";
$rs=mysqli_query($con1,"select count(qid) as 'count' from questions_table;");
$data=mysqli_fetch_array($rs,MYSQLI_ASSOC);
$count=$data["count"];
mysqli_close($con1);
return $count;

}
}

function getAnswerStats(){
//get number of answers published 
include("creds.php");
$con2=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con2->connect_error){
return "NA";
}
else{
//echo "connection successful";
$rs=mysqli_query($con2,"select count(aid) as 'count' from answer_table;");
$data=mysqli_fetch_array($rs,MYSQLI_ASSOC);
$count=$data["count"];
mysqli_close($con2);
return $count;
}
}

function getUserQuestionStats(){
//get number of questions posted by user

include("creds.php");
$con1=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con1->connect_error){
return "NA";
}
else{
$rs=mysqli_query($con1,"select count(qid) as 'count' from questions_table");
$data=mysqli_fetch_array($rs,MYSQLI_ASSOC);
$count=$data["count"];
mysqli_close($con1);
return $count;
}
}

function getUserAnswerStats(){
//get number of answers published by user

include("creds.php");
$con2=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con2->connect_error){
return "NA";
}
else{
$rs=mysqli_query($con2,"select count(aid) as 'count' from answer_table");
$data=mysqli_fetch_array($rs,MYSQLI_ASSOC);
$count=$data["count"];
mysqli_close($con2);
return $count;
}
}

function getUserFavQuestionStats(){
//get no  of user's favorite questions

include("creds.php");
$con1=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con1->connect_error){
return "NA";
}
else{
$rs=mysqli_query($con1,"select count(*) as 'count' from user_fav_question;");
$data=mysqli_fetch_array($rs,MYSQLI_ASSOC);
$count=$data["count"];
mysqli_close($con1);
return $count;
}
}

function getViewsCount($qid){
//get number of views on given question

include("creds.php");
$con3=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con3->connect_error){
return 0;
}
else{
//echo "connection successful";
if(mysqli_query($con3,"update questions_table set views=views+1 where qid='".$qid."';")){
$res=mysqli_query($con3,"select views from questions_table where qid='".$qid."';");
$data=mysqli_fetch_array($res,MYSQLI_ASSOC);
$count=$data["views"];
mysqli_close($con3);
return $count;
}
}
}

function getLikesCount($qid){
//get number of likes for given question

include("creds.php");
error_reporting(E_ALL & ~E_NOTICE);

$con3=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con3->connect_error){
return 0;
}
else{
//echo "connection successful";
$res1=mysqli_query($con3,"select count(status) as 'likes' from questions_like where qid='".$qid."' and status='l';");
$data1=mysqli_fetch_array($res1,MYSQLI_ASSOC);
mysqli_close($con3);
return $data1["likes"];
}
}

function getDislikesCount($qid){
//get number of dislikes for given question

include("creds.php");
error_reporting(E_ALL & ~E_NOTICE);

$con3=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con3->connect_error){
return 0;
}
else{
//echo "connection successful";
$res1=mysqli_query($con3,"select count(status) as 'dislikes' from questions_like where qid='".$qid."' and status='d';");
$data1=mysqli_fetch_array($res1,MYSQLI_ASSOC);
mysqli_close($con3);
return $data1["dislikes"];
}
}

function getAnsLikesCount($aid){
//get number of likes for given answer

include("creds.php");
error_reporting(E_ALL & ~E_NOTICE);

$con3=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con3->connect_error){
return 0;
}
else{
$res1=mysqli_query($con3,"select count(status) as 'likes' from answer_like where aid='".$aid."' and status='l';");
$data1=mysqli_fetch_array($res1,MYSQLI_ASSOC);
mysqli_close($con3);
return $data1["likes"];
}
}

function getAnsDislikesCount($aid){
//get number of dislikes for given answer

include("creds.php");
error_reporting(E_ALL & ~E_NOTICE);

$con3=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con3->connect_error){
return 0;
}
else{
$res1=mysqli_query($con3,"select count(status) as 'dislikes' from answer_like where aid='".$aid."' and status='d';");
$data1=mysqli_fetch_array($res1,MYSQLI_ASSOC);
mysqli_close($con3);
return $data1["dislikes"];
}
}

function getQuesPostTime($post_datetime){
//get question post date in specific format

include("creds.php");
$con4=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con4->connect_error){
return "NA";
}
else{
$rs=mysqli_query($con4,"select CONVERT_TZ(UTC_TIMESTAMP(),'+0:00','+5:30') as 'datetime';");
$data=mysqli_fetch_array($rs,MYSQLI_ASSOC);
$curr_datetime=$data["datetime"];
mysqli_close($con4);
$diff=date_diff(date_create($post_datetime),date_create($curr_datetime));
$diff_str=$diff->format("%y,%m,%d,%h,%i,%s");
$arr=explode(",",$diff_str);
if($arr[0]=="0"){
if($arr[1]=="0"){
if($arr[2]=="0"){
if($arr[3]=="0"){
if($arr[4]=="0"){
return $arr[5]." secs ago";
}else{
return $arr[4]." minutes ago";
}
}else{
if($arr[3]==1){
$h="hour";
}else{
$h="hours";
}
return $arr[3]." ".$h." ago";
}
}else{
if($arr[2]==1){
$d="day";
}else{
$d="days";
}
return $arr[2]." ".$d." ago";
}
}else{
if($arr[1]==1){
$m="month";
}else{
$m="months";
}
return $arr[1]." ".$m." ago";
}
}else{
if($arr[0]==1){
$y="year";
}else{
$y="years";
}
return $arr[0]." ".$y." ago";

}
}
}

function getAnsPostDateTime($datetime){
//get answer post date in specific format

$arr1=explode(" ",$datetime);
$date=$arr1[0];
$time=$arr1[1];

$arr2=explode("-",$date);
$p_year=$arr2[0];
$p_month=$arr2[1];
$p_day=$arr2[2];

$arr3=explode(":",$time);
$p_hour=$arr3[0];
$p_min=$arr3[1];
$p_sec=$arr3[2];

switch($p_month){
case 1: $month="January";
	break;
case 2: $month="Feburary";
	break;
case 3: $month="March";
	break;
case 4: $month="April";
	break;
case 5: $month="May";
	break;
case 6: $month="June";
	break;
case 7: $month="July";
	break;
case 8: $month="August";
	break;
case 9: $month="September";
	break;
case 10: $month="October";
	break;
case 11: $month="November";
	break;
case 12: $month="December";
	break;
}

if($p_hour>12){
$hour=$p_hour-12;
$format="pm";
}else if($p_hour==0){
$hour=$p_hour+12;
$format="am";
}else if($p_hour==12){
$hour=$p_hour;
$format="pm";
}else{
$hour=$p_hour;
$format="am";
}

return $month." ".$p_day." , ".$p_year." at ".$hour.":".$p_min." ".$format;


}

function getRegDate($datetime){
//get user's registeration date time in specific format

$arr1=explode(" ",$datetime);
$date=$arr1[0];

$arr2=explode("-",$date);
$p_year=$arr2[0];
$p_month=$arr2[1];
$p_day=$arr2[2];

switch($p_month){
case 1: $month="Jan";
	break;
case 2: $month="Feb";
	break;
case 3: $month="Mar";
	break;
case 4: $month="Apr";
	break;
case 5: $month="May";
	break;
case 6: $month="Jun";
	break;
case 7: $month="Jul";
	break;
case 8: $month="Aug";
	break;
case 9: $month="Sep";
	break;
case 10: $month="Oct";
	break;
case 11: $month="Nov";
	break;
case 12: $month="Dec";
	break;
}

return $month." ".$p_day.", ".$p_year;


}

function getFavQuestionStatus($qid){
//return yes if question is favorite otherwise no

include("creds.php");
$con1=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con1->connect_error){
return 'n';
}
else{
$res1=mysqli_query($con1,"select count(*) as 'count' from user_fav_question where qid='".$qid."';");
$cdata=mysqli_fetch_array($res1,MYSQLI_ASSOC);
if($cdata["count"]>0){
mysqli_close($con1);
return 'y';
}else{
mysqli_close($con1);
return 'n';
}
}
}


function get_meta_keywords(){
//get unique tags to be used in meta tag for seo

include("creds.php");
$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
return "android,google,zapsar,questions,answers,category";
}
else{
$rs=mysqli_query($con,"select tag,custom_tags from questions_table;");
$i=0;
while($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
if($i==0){
$tags_string=$data["tag"].",".$data["custom_tags"];
$i++;
}else{
$tags_string=$tags_string.",".$data["tag"].",".$data["custom_tags"];
}
}
$tag_array=explode(",",$tags_string);
$unique_tags=array_unique($tag_array);
$i=0;
foreach($unique_tags as $v){
if($v!=""&&$v!=" "){
if($i==0){$str=$v;$i++;}else{
$str=$str.",".$v;
}
}
}


mysqli_close($con);
return $str;
}
}
?>

