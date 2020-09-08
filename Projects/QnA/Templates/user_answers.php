<?php
session_start();
if(!isset($_SESSION["auth_uname"])){
?>
<script>location.href="../"</script>
<?php
}else{
$uname=$_SESSION["auth_uname"];
}
include("stats.php");
include("creds.php");
error_reporting(E_ALL & ~E_NOTICE);

$rel_url="";

$fetchRows=10;
if($_GET["more"]=="yes"){
$curr_pag=$_GET["pag"];
$start_limit=($curr_pag-1)*$fetchRows;
}else{
$curr_pag=1;
$start_limit=0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 
<meta charset="utf-8">
<title>QnA- Answers</title>
<meta name="description" content="<?php echo $site_desc;?>">

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<meta name="author" content="abhi@tech">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="css/skins.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="custom_style.css">
 
<link rel="shortcut icon" href="images/favicon.png">
<script src="js/jquery.js"></script>
<script src="js/jquery.min.js"></script>
<script src="static_tags.js"></script>

<!--Pre Color:#ff7361-->
<style>
a {
    text-decoration: none;
}

a:hover {
    text-decoration: none;
}

a:focus {
    text-decoration: none;
}
#singleQuesTitle{
background:transparent;
color:black;
padding:0px;
font-size:20px;
}

#singleQuesTitle:hover{
color:#34dddd;
}

#singleQuesTitle:focus{
color:#34dddd;
}

</style>
</head>

<body>
<div class="loader"><div class="loader_html"></div></div>
<div id="wrap" class="grid_1200">
<!--------------------------------------------- Header   ------------------------------------------>
<header id="header">
<section class="container clearfix" >
<a href="home.php">
<img src="images/logo.png">
<!--<span class="qna-logo-big" style="">Q</span>
<span class="qna-logo">n</span>
<span class="qna-logo-big">A</span>-->
</a>
<div class="logo"></div>

<script type="text/javascript">
$(document).ready(function(){
var dy_tags="";
for(var i=0;i<static_tags.length;i++){
dy_tags+="<li><a href='tags.php?tag_filter="+static_tags[i]+"'>"+static_tags[i]+"</a></li>";
}

if($(window).width() <=990 && $(window).width() >=768){
$("#nav_dummy").replaceWith('<nav id="menu_list" class="navigation" style="position:absolute;top:10px;right:5px"><ul style="margin-top:10px;margin-left:-160px;width:160px"><li class="current_page_item"><a href="home.php">Home</a></li><li style="cursor:pointer"><a>Tags</a><ul id="tag_list">'+dy_tags+'</ul></li><li><a style="cursor:pointer" href="publish_question.php">Publish Question</a></li><li><a href="user_questions.php">Questions</a></li><li><a href="user_answers.php">Answers</a></li><li><a href="user_favorite_questions.php">Favorites</a></li><li><a id="" style="cursor:pointer" href="maintenance.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Maintenance"><img src="images/maintenance.png"></a></li><li><a id="logout_tab" style="cursor:pointer" href="finish_session.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Logout"><img src="images/log-out.png"></a></li></ul></nav>');
}else if($(window).width() <768){
var mar=$(window).width();
mar=mar-160;
$("#nav_dummy").replaceWith('<nav id="menu_list" class="navigation" style="position:absolute;top:25px;right:5px"><ul style="margin-top:10px;margin-left:'+mar+'px;width:160px"><li class="current_page_item"><a href="home.php">Home</a></li><li style="cursor:pointer"><a>Tags</a><ul id="tag_list">'+dy_tags+'</ul></li><li><a style="cursor:pointer" href="publish_question.php">Publish Question</a></li><li><a href="user_questions.php">Questions</a></li><li><a href="user_answers.php">Answers</a></li><li><a href="user_favorite_questions.php">Favorites</a></li><li><a id="" style="cursor:pointer" href="maintenance.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Maintenance"><img src="images/maintenance.png"></a></li><li><a id="logout_tab" style="cursor:pointer" href="finish_session.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Logout"><img src="images/log-out.png"></a></li></ul></nav>');
}else{ 
$("#nav_dummy").replaceWith('<nav id="menu_list" class="navigation"><ul><li class="current_page_item"><a href="home.php">Home</a></li><li style="cursor:pointer"><a>Tags</a><ul id="tag_list">'+dy_tags+'</ul></li><li><a style="cursor:pointer" href="publish_question.php">Publish Question</a></li><li><a href="user_questions.php">Questions</a></li><li><a href="user_answers.php">Answers</a></li><li><a href="user_favorite_questions.php">Favorites</a></li><li><a id="" style="cursor:pointer" href="maintenance.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Maintenance"><img src="images/maintenance.png"></a></li><li><a id="logout_tab" style="cursor:pointer" href="finish_session.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Logout"><img src="images/log-out.png"></a></li></ul></nav>');
}

});
</script>
<div id="nav_dummy"></div>
</section> 
</header> 
<script>
$('body').click(function(e){
if(e.target.id=="menu_list"||$(e.target).attr('class')=="navigation_mobile_click" || $(e.target).parents("#menu_list").length>0){
return;
}else{
if (jQuery(".navigation_mobile_click").hasClass("navigation_mobile_click_close")) {
                jQuery(".navigation_mobile_click").next().slideUp(500);
                jQuery(".navigation_mobile_click").removeClass("navigation_mobile_click_close");
            } 
}
});
</script>

 
<div class="breadcrumbs">
<section class="container">
<div class="row">
<div class="col-md-12">
<h1>Answers</h1>
</div>
<div class="col-md-12">
<div class="crumbs">
<a href="home.php">Home</a>
<span class="crumbs-span">/</span>
<a>Answers</a>
</div>
</div>
</div> 
</section> 
</div> 
<section class="container main-content">
<div class="row">
<div class="col-md-9">

<?php

$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
?>
<script type="text/javascript">
alert("We're having some problem with our servers.");
</script>
<?php
}
else{
$rs=mysqli_query($con,"select qid from answer_table order by CONVERT(SUBSTR(aid,2),SIGNED INTEGER) DESC;");
if(mysqli_num_rows($rs)>0){
$qid_arr=array();
$i=0;
while($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
$qid_arr[$i]=$data["qid"];
$i++;
}
$unique_qid=array_unique($qid_arr);
$len=count($unique_qid);
$rowsCount=$len;

$new_arr=array();
$i=0;
foreach($unique_qid as $v){
$new_arr[$i]=$v;
$i++;
}
$formid=1;
$iframeids=1;
$ad=1;
for($l=$start_limit,$userAnswers=0;$l<($start_limit+$fetchRows)&&$l<$len;$l++,$userAnswers++){
$val=$new_arr[$l];

//foreach($unique_qid as $val){
$resource=mysqli_query($con,"select qid,title,details,tag,custom_tags,attachment,status,views,post_date from questions_table where qid='".$val."';");

$result=mysqli_fetch_array($resource,MYSQLI_ASSOC);
$title=$result["title"];
$title=htmlentities($title,ENT_QUOTES);
$qid=$result["qid"];
$details=$result["details"];
$details=htmlentities($details,ENT_QUOTES);
$author="abhi";
$status=$result["status"];
$custom_tags=$result["custom_tags"];
$tag=$result["tag"];
$views=$result["views"];
$post_date=$result["post_date"];
$attachment=$result["attachment"];

$res=mysqli_query($con,"select count('".$qid."') as 'count' from answer_table where qid='".$qid."';");
$result1=mysqli_fetch_array($res,MYSQLI_ASSOC);
$user_answers=$result1["count"];

$picture="avatar.png";
$rec_token=substr($qid,1).'sha256';
echo '
<article class="question question-type-normal">
<a href="'.$rel_url.'question.php?token='.$rec_token.'"><h2 style="cursor:pointer">';
if(strlen($title)>60)echo substr($title,0,60)."...";else echo $title;
echo '</h2></a>';
$formid++;
echo '</h2>
<div class="question-author">
<a  original-title="'.$author.'" class="question-author-img tooltip-n"><span></span><img alt="" src="images/'.$picture.'"></a>
</div>
<div class="question-inner">
<div class="clearfix"></div>
<p class="question-desc" style="border:none;padding-bottom:0px">';
if(strlen($details)>230)echo substr($details,0,230)."...";else echo $details;
echo '</p>
</div> 
<div id="commentlist" class="question-inner page-content"  style="box-shadow:none;border:none">
<div class="boxedtitle page-title" ><h2>Answers ( <span class="color">'.$user_answers.'</span> )</h2></div>';

if($user_answers>0){
$rs=mysqli_query($con,"select aid,qid,answer,format,attachment,post_date from answer_table where qid='".$qid."'  order by CONVERT(SUBSTR(aid,2),SIGNED INTEGER) desc;");
while($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){

echo '<ol class="commentlist clearfix">
<li class="comment" style="margin-top:10px">
<div class="comment-body comment-body-answered clearfix">
<div class="avatar"><img alt="" src="images/'.$_SESSION["user_photo"].'"></div>
<div class="comment-text">
<div class="author clearfix">
<div class="comment-author"><a>'.$_SESSION["auth_uname"].'</a></div>';

echo '<div class="comment-meta">
<div class="date" title="Posted On"><i class="icon-time"></i>'.getAnsPostDateTime($data["post_date"]).'</div>
</div>
<!--<a class="comment-reply" ><i class="icon-reply"></i>Reply</a>-->
</div>
<div class="text">';
if($data["format"]=='t'){
echo '<p><pre style="word-break:keep-all;word-wrap:normal;white-space:normal">'.nl2br(htmlentities($data["answer"],ENT_QUOTES)).'</pre></p>';
}else if($data["format"]=='h'){
echo '<iframe id="iframe'.$iframeids.'" src="layout.html" frameborder="0" scrolling="no" style="width:100%;height:10px;background-color:#f5f5f5; border:1px solid #ccc; border-radius:4px; margin-bottom:10px;" onload="loadcontent'.$iframeids.'()"></iframe>
<script> 
function loadcontent'.$iframeids.'(){
var iframeid=document.getElementById("iframe'.$iframeids.'");';
echo "iframeid.contentWindow.document.body.innerHTML='";
$temp= str_replace("'","&apos;",$data["answer"] );
echo str_replace("\\","&#92;",$temp );
echo "';
iframeid.style.height = $(iframeid).contents().height()+20+'px';
        	   }
	       </script>";
$iframeids++;
}

echo '</div>';
$ans_attachment=$data["attachment"];
if($ans_attachment=='n'){}else if(substr($ans_attachment,0,12)=="ans_attach-a"){
echo '<div class="question-answered question-answered-done" style="float:right;margin-top:10px;margin-right:0px;font-size:14px;font-weight:bold;">
<a href="attachments/'.$ans_attachment.'" target="_blank" style="color:#a1a1a1"><i class="glyphicon glyphicon-paperclip"></i>Attachment</a></div>';
}


echo '</div></div></li></ol>';
}
 }

echo '</div>
</article>';

}
}else{
$rowsCount=0;
$userAnswers=0;
?>
<script type="text/javascript">
alert("You haven't answered any questions yet.");
</script>
<?php
}
}
mysqli_close($con);

if($rowsCount>$userAnswers){
echo '<div id="pag_div" class="pagination">';
for($d=1;$d<=ceil($rowsCount/$fetchRows);$d++){
$pag_url="?more=yes&pag=".$d;

if($curr_pag==$d){
echo '<a href="'.$pag_url.'" style="cursor:pointer;background-color:#ff7361;color:#fff;border-radius:100px">'.$d.'</a>';
}else{
echo '<a href="'.$pag_url.'" style="cursor:pointer;border-radius:100px">'.$d.'</a>';
}
}
echo '</div>'; 

}

?>

</div> 

<aside class="col-md-3 sidebar">
<div class="widget widget_stats">
<h3 class="widget_title">Stats</h3>
<div class="ul_list ul_list-icon-ok">
<ul>
<li><i class="icon-question-sign"></i>Questions ( <span><?php $totalQuestions=getQuestionStats();echo $totalQuestions;?></span> )</li>
<li><i class="icon-comment"></i>Answers ( <span><?php echo getAnswerStats();?></span> )</li>
<li><i class="icon-star"></i>Favorites ( <span><?php echo getUserFavQuestionStats();?></span> )</li>
</ul>
</div>
</div>

<div class="widget widget_tag_cloud" >
<h3 class="widget_title">Tags</h3>
<?php
$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
?>
<script type="text/javascript">
alert("We're having some problem with our servers, Reload this page...");
</script>
<?php
}
else{
$rs=mysqli_query($con,"select custom_tags from questions_table order by sno desc;");
if(mysqli_num_rows($rs)>0){
$i=0;
while($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
if($i==0){
$tags_string=$data["custom_tags"];
$i++;
}else{
$tags_string=$tags_string.",".$data["custom_tags"];
}
}
$tag_array=explode(",",$tags_string);
$unique_tags=array_unique($tag_array);
$i=0;
foreach($unique_tags as $val){
if($i==50){
break;
}
if($val!=""){
echo '<a href="tags.php?tag_filter='.$val.'" style="cursor:pointer">'.$val.'</a>';
}
$i++;
}

?>

<?php
}
mysqli_close($con);
}
?>

</div>
</aside>
</div> 
</section> 


<footer id="footer">
<section class="container">
<div class="row">

<div class="col-md-5">
<div class="widget">
<h3 class="widget_title">Unanswered Questions</h3>
<ul class="related-posts">
<?php 
$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
?>
<script type="text/javascript">
alert("We're having some problem with our servers, Reload this page...");
</script>
<?php
}
else{
$rs=mysqli_query($con,"select qid,title,details,post_date from questions_table where status='i' order by sno DESC limit 2;");
if(mysqli_num_rows($rs)>0){
while($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
$title=$data["title"];
$title=htmlentities($title,ENT_QUOTES);
$qid=$data["qid"];
$details=$data["details"];
$details=htmlentities($details,ENT_QUOTES);
$post_date=$data["post_date"];
$pop_token=substr($qid,1).'sha256';
?>
<li class="related-item">
<a href="<?php echo $rel_url; ?>question.php?token=<?php echo $pop_token;?>"><h3 style="font-size:15px;color:white;padding-bottom:5px"><?php echo substr($title,0,60)."...";?></h3></a>
<p><?php echo substr($details,0,70)."...";?></p>
<div class="clear"></div><span><?php echo getRegDate($post_date);?></span>
</li>


<?php
}
}
mysqli_close($con);
}
?>
</ul>
</div>
</div>
<div class="col-md-5">
<div class="widget">
<h3 class="widget_title">Popular Questions</h3>
<ul class="related-posts">
<?php 
$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
?>
<script type="text/javascript">
alert("We're having some problem with our servers, Reload this page...");
</script>
<?php
}
else{
$rs=mysqli_query($con,"select qid,title,details,post_date from questions_table order by views DESC limit 2;");
if(mysqli_num_rows($rs)>0){
while($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
$title=$data["title"];
$title=htmlentities($title,ENT_QUOTES);
$qid=$data["qid"];
$details=$data["details"];
$details=htmlentities($details,ENT_QUOTES);
$post_date=$data["post_date"];
$pop_token=substr($qid,1).'sha256';
?>
<li class="related-item">
<a href="<?php echo $rel_url; ?>question.php?token=<?php echo $pop_token;?>"><h3 style="font-size:15px;color:white;padding-bottom:5px"><?php echo substr($title,0,60)."...";?></h3></a>
<p><?php echo substr($details,0,70)."...";?></p>
<div class="clear"></div><span><?php echo getRegDate($post_date);?></span>
</li>


<?php
}
}
mysqli_close($con);
}
?>
</ul>
</div>
</div>

<div class="col-md-2">
<div class="widget">
<h3 class="widget_title">Frequent Tags</h3>
<div class="related-item" id="freq_tag_div">
<?php 
$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
?>
<script type="text/javascript">
alert("We're having some problem with our servers, Reload this page...");
</script>
<?php
}
else{
$rs=mysqli_query($con,"select count(tag),tag from questions_table group by tag order by count(tag) DESC limit 30;");
if(mysqli_num_rows($rs)>0){
$ci=0;
while($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
if($ci==0){
echo '<a href="'.$rel_url.'tags.php?tag_filter='.$data["tag"].'" style="cursor:pointer">'.ucwords($data['tag']).'</a>';
$ci++;
}else{
echo ', <a href="'.$rel_url.'tags.php?tag_filter='.$data["tag"].'" style="cursor:pointer">'.ucwords($data['tag']).'</a>';
}
}

}
mysqli_close($con);
}
?>

</div>

</div>
</div>
</div>  
</section> 
</footer> 
<footer id="footer-bottom">
<section class="container">
<div class="copyrights f_left">Developed By Abhijeet Singh</div> 
<div class="copyrights f_right">Copyright &#169 2018 QnA</div>
</section> 
</footer> 
</div> 
<div class="go-up" style="border-radius:100px"><i class="icon-chevron-up"></i></div>
 
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/jquery.easing.1.3.min.js"></script>
<script src="js/html5.js"></script>
<script src="js/twitter/jquery.tweet.js"></script>
<script src="js/jflickrfeed.min.js"></script>
<script src="js/jquery.inview.min.js"></script>
<script src="js/jquery.tipsy.js"></script>
<script src="js/tabs.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script src="js/jquery.scrollTo.js"></script>
<script src="js/jquery.nav.js"></script>
<script src="js/tags.js"></script>
<script src="js/jquery.bxslider.min.js"></script>
<script src="js/custom.js"></script>
 <script>
$(function(){$('[data-toggle="popover"]').popover({container:'body'})})
</script>

 
</body>
</html>
