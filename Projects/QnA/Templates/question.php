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

$token=$_GET["token"];
if(!isset($_GET["token"])){
?>
<script>window.history.back();</script>
<?php
}else if(strpos($token,"sha256")){

$token_qid="Q".substr($token,0,strpos($token,"sha256"));
$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
echo '<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css" >
<script src="js/jquery.js" ></script>
<script src="bootstrap/js/bootstrap.js" ></script>
</head>
<body onclick="location.href=\'home.php\'">
<div id="show_alert" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">SERVER PROBLEM</h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-info alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span><strong> Oh Snap! </strong>We are having problem with our server, Please try again... 
</div>
<div class="alert alert-info alert-dismissible fade in" role="alert" style="margin-top:0px">
If Confirm Form Resubmission page occurs, try to reload again. <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$("#show_alert").modal();
</script>
</body></html>';
}else{

$rs=mysqli_query($con,"select qid,title,details,attachment,tag,custom_tags,status,views,post_date from questions_table where qid='".$token_qid."' ;");

if($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
$single_ques_title=$data["title"];
$single_ques_title=htmlentities($single_ques_title,ENT_QUOTES);
$single_ques_id=$data["qid"];
$single_ques_details=$data["details"];
$single_ques_details=htmlentities($single_ques_details,ENT_QUOTES);
$single_ques_author="abhi";
$single_ques_status=$data["status"];
$single_ques_custom_tags=$data["custom_tags"];
$single_ques_tag=$data["tag"];
$single_ques_post_date=$data["post_date"];
$single_ques_views=$data["views"];
$single_ques_attachment=$data["attachment"];
$fav=getFavQuestionStatus($single_ques_id);

$res=mysqli_query($con,"select count('".$single_ques_id."') as 'count' from answer_table where qid='".$single_ques_id."';");
$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
$single_ques_answers=$result["count"]; 

$single_ques_picture="avatar.png";

$_SESSION["single_ques_pri_id"]=$single_ques_id;
$_SESSION["single_ques_pri_fav"]=$fav;
}else{
?>
<script>location.href="home.php";</script>
<?php

}
}
}else{
?>
<script>location.href="home.php";</script>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<title>QnA- <?php echo $single_ques_title;?></title>
<meta name="description" content="<?php echo $single_ques_details." Primary Tag: ".$single_ques_tag." , User's Tag: ".$single_ques_custom_tags;?>"/>
<meta name="keywords" content="QnA,Question,Answer,Tag,Custom,Category,<?php echo $single_ques_tag.",".$single_ques_custom_tags;?>" />

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
<script src="bootstrap/js/bootstrap.js"></script> 

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
font-size:20px;}

#singleQuesTitle:hover{
color:#34dddd;
}

#singleQuesTitle:focus{
color:#34dddd;
}
.single-question-vote-up:hover {
    background-color: #eee;
	color:#666;
}
.single-question-vote-down:hover {
    background-color: #eee;
	color:#666;
}
.fluidMedia {
    position: relative;
    padding-bottom: 56.25%; /* proportion value to aspect ratio 16:9 (9 / 16 = 0.5625 or 56.25%) */
    padding-top: 30px;
    height: 0;
    overflow: hidden;
}

.fluidMedia iframe {
    position: absolute;
    top: 0; 
    left: 0;
    width: 100%;
    height: 100%;
}
</style>
</head>

<body>
<div class="loader"><div class="loader_html"></div></div>
<div id="wrap" class="grid_1200">
<!-------------------------------   Header       -------------------------------------->
<header id="header"   >

<section class="container clearfix" >
<a  href="home.php">
<img src="images/logo.png">
<!--<span class="qna-logo-big" style="">Q</span>
<span class="qna-logo">n</span>
<span class="qna-logo-big">A</span>-->
</a>
<div class="logo">
</div>
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
if(e.target.id!="share_link"&&e.target.id!="share_link_body"&&e.target.id!="share_link_img"&&$(e.target).attr('class')!="popover-title"){
$('[data-toggle="popover"]').popover('hide');
}

});
</script>



<div class="breadcrumbs">
<section class="container">
<div class="row">
<div class="col-md-12">
<h1><?php if(strlen($single_ques_title)>50)echo substr($single_ques_title,0,50)."...";else echo $single_ques_title;?></h1>
</div>
<div class="col-md-12">
<div class="crumbs">
<a href="home.php">Home</a>
<span class="crumbs-span">/</span>
<a >Question</a>
</div>
</div>
</div> 
</section> 
</div> 
<section class="container main-content">
<div class="row">
<div class="col-md-9">
<article class="question single-question question-type-normal">
<h2 style="padding-right:20px">
<?php echo $single_ques_title;?>
</h2>
<!--<div class="question-type-main"><i class="icon-question-sign"></i>Question</div>-->
<div class="question-inner">
<div class="clearfix"></div>
<div class="question-desc">
<p> <?php echo nl2br($single_ques_details);?></p>
</div>

<?php if($single_ques_status=='i'){ 
echo '<span class="question-answered"><i class="icon-ok"></i> In Progress</span>';
} else {
echo '<span class="question-answered question-answered-done"><i class="icon-ok"></i> Solved</span>';
}

if($fav=='y'){
echo '<span class="question-date" onclick="toggle_fav()" style="cursor:pointer"><i class="icon-star tooltip-n" original-title="Favorite" style="color:#dfaa63;cursor:pointer"></i> Favorite</span>';
}else{
echo '<span class="question-date" style="color:#2f3239;cursor:pointer" onclick="toggle_fav()"><i class="icon-star tooltip-n" original-title="Not Favorite" style="color:#dedede;cursor:pointer" ></i> Not Favorite</span>';
}
?>
<script type="text/javascript">
function toggle_fav(){
location.href="set_fav_question.php?token=<?php echo substr($single_ques_id,1).'sha256';?>";
}
</script>

<span class="question-date" title="Question's Post Duration"><i class="icon-time"></i><?php echo getQuesPostTime($single_ques_post_date);?></span>
<span class="question-comment"><a href="#answers_div"><i class="icon-comment"></i><?php echo $single_ques_answers;?> Answer</a></span>
<span class="question-view" style="margin-right:20px"><i class="icon-user"></i><?php echo getViewsCount($single_ques_id);?> views</span>
<?php
$share_link=$c_site_address."share_ques.php?token_id=".uniqid(substr($single_ques_id,1).'sha256',true);
?>
<span class="question-comment"><a id='share_link' role="button" data-html="true" data-toggle="popover" data-trigger="click" data-placement="bottom" title="Copy Share Link<image id='share_link_img' src='images/ic_copy.png' title='copy' style='height:20px;width:20px;float:right;cursor:pointer' onclick='copyLink()'>" data-content="<div id='share_link_body' style='white-space:nowrap;padding-bottom:15px;overflow-x:auto'><?php echo $share_link;?></div>"><i class="icon-share-alt" ></i>Share</a></span>
<script>
function copyLink() {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val("<?php echo $share_link;?>").select();
  document.execCommand("copy");
  $temp.remove();
  //$('#share_link').trigger('click');
}
</script>
<span class="single-question-vote-result" style="cursor:pointer" title="Update Question"><a href="update_question.php?token=<?php echo substr($single_ques_id,1)."sha256";?>"><i class="icon-edit"> Edit</i></a></span>
<div class="clearfix"></div>
</div>
</article>

<?php 
$attachment=$single_ques_attachment;
if($attachment=='n'){

}else if(substr($attachment,0,8)=="attach-q"){
echo '<div class="share-tags page-content" style="margin-bottom:10px">
<div class="share-inside" title="Attachment File"><a href="attachments/'.$attachment.'" target="_blank"><i class="glyphicon glyphicon-paperclip"></i>
<span style="color:#000">Attachment</span></a>
</div>
<div class="clearfix"></div>
</div>';
}
?> 

<div class="share-tags page-content">
<?php 
if($single_ques_custom_tags!=""){
$tag_arr=explode(",",$single_ques_custom_tags);
echo '<div class="question-tags" title="User\'s Tags"><i class="icon-tags"></i><span id="tag_div3">';
$ci=0;
foreach($tag_arr as $tag_val){
if($ci==0){
echo '<a href="tags.php?tag_filter='.$tag_val.'" style="cursor:pointer;color:#fff;border-radius:3px;padding:3px">'.$tag_val.'</a>';
$ci++;
}else{
echo ' <a href="tags.php?tag_filter='.$tag_val.'" style="cursor:pointer;color:#fff;border-radius:3px;padding:3px">'.$tag_val.'</a>';
}
}
echo '</span>
</div>';
}
?>
<div class="share-inside" title="Primary Tag"><i class="glyphicon glyphicon-tasks"></i>
<?php echo '<span ><a href="tags.php?tag_filter='.$single_ques_tag.'" style="color:#000">'.ucwords($single_ques_tag).'</a></span>';
?>
</div>

<div class="clearfix"></div>
</div> 

<a name="answers_div"></a>
<div id="commentlist" class="page-content">
<div class="boxedtitle page-title"><h2>Answers ( <span class="color"><?php echo $single_ques_answers;?></span> )</h2></div>
<?php if($single_ques_answers>0){

$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
?>
<script type="text/javascript">
alert("We're having some trouble to retrive answers, Please Reload this page...");
</script>
<?php
}
else{
$rs=mysqli_query($con,"select aid,qid,answer,format,attachment,post_date from answer_table where qid='".$single_ques_id."' order by CONVERT(SUBSTR(aid,2),SIGNED INTEGER) desc;");
$iframeids=1;
while($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
$user_picture="avatar.png";
$ans_attachment=$data["attachment"];

echo '<ol class="commentlist clearfix">
<li class="comment" style="margin-top:10px">
<div class="comment-body comment-body-answered clearfix">
<div class="avatar"><img alt="" src="images/'.$user_picture.'"></div>
<div class="comment-text">
<div class="author clearfix">
<div class="comment-author"><a>abhi</a></div>';
echo '<div class="comment-meta">
<div class="date" title="Posted On"><i class="icon-time"></i>'.getAnsPostDateTime($data["post_date"]).'</div>
</div>
<a href="remove_ans.php?ansToken='.substr($data["aid"],1).'sha128&qToken='.substr($single_ques_id,1).'sha256&attach=';
if($ans_attachment=='n'){
echo 'n';
}else{
echo $ans_attachment;
}	
echo '&op=confirm" class="comment-reply" style="cursor:pointer;color:#2f3239;margin-left:15px"><i class="icon-trash" style="color:#2f3239"></i>Remove</a>
<a href="ueditor.php?ansToken='.substr($data["aid"],1).'sha128&qToken='.substr($single_ques_id,1).'sha256&attach=';
if($ans_attachment=='n'){
echo 'n';
}else{
echo $ans_attachment;
}	
echo '&op=update" target="_blank" class="comment-reply" style="cursor:pointer;color:#2f3239;"><i class="icon-edit" style="color:#2f3239"></i>Edit</a>
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
if($ans_attachment=='n'){}else if(substr($ans_attachment,0,12)=="ans_attach-a"){
echo '<div class="question-answered question-answered-done" style="float:right;margin-top:10px;margin-right:0px;font-size:14px;font-weight:bold;">
<a href="attachments/'.$ans_attachment.'" target="_blank" style="color:#a1a1a1"><i class="glyphicon glyphicon-paperclip"></i>Attachment</a></div>';
}

echo '</div></div></li></ol>';

}
mysqli_close($con);
 }
 }
?>
</div>
<?php
$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
}else{

if($single_ques_custom_tags!=""){
$pri_tag_str="tag= '".$single_ques_tag."'";
$custom_tag_str="custom_tags LIKE '%".$single_ques_tag."%'";
$new_custom_tag_arr=explode(",",$single_ques_custom_tags);
foreach($new_custom_tag_arr as $t){
$pri_tag_str=$pri_tag_str." OR tag = '".$t."'";
$custom_tag_str=$custom_tag_str." OR custom_tags LIKE '%".$t."%'";
}
$tag_query="( ".$pri_tag_str.") OR (".$custom_tag_str." )";
}else{
$tag_query="tag= '".$single_ques_tag."' OR custom_tags LIKE '%".$single_ques_tag."%'";
}
$rs=mysqli_query($con,"select qid,title from questions_table where ( ".$tag_query." ) and qid!='".$single_ques_id."' order by CONVERT(SUBSTR(qid,2),SIGNED INTEGER) desc limit 5;");
if(mysqli_num_rows($rs)>0){
echo '<div id="related-posts"><h2>Related questions</h2><ul class="related-posts">';
while($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
$title=$data["title"];
$title=htmlentities($title,ENT_QUOTES);
$qid=$data["qid"];
$rel_token=substr($qid,1).'sha256';

echo '<li class="related-item"><a href="question.php?token='.$rel_token.'"><h3 style="cursor:pointer" >
<i class="icon-double-angle-right"></i>';
if(strlen($title)>=90)echo substr($title,0,90)."...";else echo $title;
echo '</h3></a></li>'; 

}
mysqli_close($con);
echo '</ul></div>';
}
}
?>  
<div id="respond" class="comment-respond page-content clearfix">
<div class="boxedtitle page-title"><h2>Answer this Question</h2></div>
<div id="respond-textarea" align="center">
<div id="respond-textarea" class="clearfix">
<p>
<label class="required" ><a href="editor.php?op=new&token=<?php echo substr($single_ques_id,1).'sha256';?>" target="_blank">Use Our QnA &lt;editor/&gt;</a><span></span></label>
</p></div>
<div id="respond-textarea" class="clearfix">
<p>
<label class="required" style="cursor:auto">OR<span></span></label>
</p></div>
<div id="respond-textarea" class="clearfix">
<p>
<label class="required" style="cursor:auto;border-bottom:1px solid #dedede;margin-bottom:30px;padding-bottom:20px">Answer Below<span></span></label>
</p></div>
</div>
<form action="post_answer.php" method="post" enctype="multipart/form-data" id="commentform" class="comment-form">
<div id="respond-textarea">
<p>
<label class="required" for="comment">Your Answer<span>*</span></label>
<textarea id="comment" name="comment" aria-required="true" cols="58" rows="8"></textarea>
</p>
</div>
<div id="respond-textarea" class="clearfix">
<p>
<label>Attachment</label>
<div class="fileinputs" style="width:100%">
<input type="file" class="file" accept="*" id="file_input" name="attach_file">
<div class="fakefile">
<button type="button" id="file_btn" class="button small margin_0">No file selected</button>
<span><i class="icon-arrow-up"></i>Browse</span>
</div>
<div style="margin-top:5px;float:left;color:#848991;font-size:12px">Select .pdf, .jpg, .png or .jpeg file of upto 3MB size.</div>
</div>
<div id="showAttachment"></div>
<script type="text/javascript">
function remove(){
	document.getElementById("file_input").value="";
			  document.getElementById("file_btn").innerHTML="No file selected";
			 $("#showAttachment").html("");
}

function readURL(input){
    if (input.files && input.files[0]) {
		if(!hasExtension('file_input', ['.jpg','.png','.jpeg','.JPEG','.JPG','.pdf'])){
				remove();
				$("#modal_title").html("FILE EXTENSION UNKNOWN");
			   $("#modal_content").html("<strong> Important! </strong>Please upload file of .pdf, .png, .jpg or .jpeg extensions.");
			   $("#show_alert").modal();
		}else{
		     if(input.files[0].size>3072000){
		    remove();
			$("#modal_title").html("FILE SIZE EXCEEDED");
			$("#modal_content").html("<strong> Important! </strong>File size is greater than 3MB.");
			$("#show_alert").modal();
		}else{
        document.getElementById("file_btn").innerHTML=input.files[0].name;
		$("#showAttachment").html('<span class="question-comment" title="1 Attachment"  style="padding:20px;padding-top:5px"><a><i class="icon-paper-clip" ></i> '+input.files[0].name+'</a><a onclick="remove()"><i class="icon-remove" title="Remove" style="margin-left:20px;cursor:pointer"></i></a></span>');
		}
	}
	}
}
function hasExtension(inputID, exts) {
    var fileName = document.getElementById(inputID).value;
    return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
}
$("#file_input").change(function(){
    readURL(this);
});
</script>

</p>
</div>

<input type="hidden" name="single_ques_pri_format" value="t">
<input type="hidden" name="single_ques_pri_id" value="<?php echo $single_ques_id;?>">
<p class="form-submit">
<input name="submit" type="submit" id="submit" value="Post your Answer" class="button small color">
</p>
</form>

<div>
</div>

</div>
<!--<div class="row">
        <div class="col-centered">
           <textarea id="comment"></textarea>
        </div>
</div>-->

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

<div id="show_alert" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal_title"></h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-remove-sign" aria-hidden="true" id="modal_content"></span> 
</div>
<div id="modal_extra" style="margin-left:15px;font-family:'Glyphicons Halflings'"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 
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

$(function(){$('[data-toggle="popover"]').popover()})
$(function(){$('#share_link').popover({container:'#share_link'})})
</script>
 </body>
</html>
