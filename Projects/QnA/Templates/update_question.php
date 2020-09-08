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

$rs=mysqli_query($con,"select qid,title,details,attachment,tag,custom_tags from questions_table where qid='".$token_qid."' ;");

if($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
$title=$data["title"];
//$title=htmlentities($title,ENT_QUOTES);
$qid=$data["qid"];
$details=$data["details"];
//$details=htmlentities($details,ENT_QUOTES);
$custom_tags=$data["custom_tags"];
$primary_tag=$data["tag"];
$attachment=$data["attachment"];

}else{
?>
<script>window.history.back();</script>
<?php
}
}
}else{
?>
<script>window.history.back();</script>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 
<meta charset="utf-8">
<title>QnA- Update Question</title>
<meta name="description" content="<?php echo $site_desc;?>">
<meta name="robot" content="no index, no follow"/>

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
font-size:20px;}

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
<header id="header" style="background:#34dddd">
<section class="container clearfix" >
<a href="home.php">
<span class="qna-logo-big" style="">Q</span>
<span class="qna-logo">n</span>
<span class="qna-logo-big">A</span>
</a>
<div class="logo"></div>
<script type="text/javascript">
$(document).ready(function(){
var dy_tags="",select_tag="";
for(var i=0;i<static_tags.length;i++){
dy_tags+="<li><a href='tags.php?tag_filter="+static_tags[i]+"'>"+static_tags[i]+"</a></li>";
select_tag+="<option value='"+static_tags[i].toLowerCase()+"'>"+static_tags[i]+"</option>";
}
$("#tag_select").html(select_tag);

if($(window).width() <=990 && $(window).width() >=768){
$("#nav_dummy").replaceWith('<nav id="menu_list" class="navigation" style="position:absolute;top:10px;right:5px"><ul style="margin-top:10px;margin-left:-160px;width:160px"><li class="current_page_item"><a href="home.php">Home</a></li><li style="cursor:pointer"><a>Tags</a><ul id="tag_list">'+dy_tags+'</ul></li><li><a style="cursor:pointer" href="publish_question.php">Publish Question</a></li><li><a href="user_questions.php">Questions</a></li><li><a href="user_answers.php">Answers</a></li><li><a href="user_favorite_questions.php">Favorites</a></li><li><a id="" style="cursor:pointer" href="maintenance.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Maintenance"><img src="images/maintenance.png"></a></li><li><a id="logout_tab" style="cursor:pointer" href="finish_session.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Logout"><img src="images/log-out.png"></a></li></ul></nav>');
}else if($(window).width() <768){
var mar=$(window).width();
mar=mar-160;
$("#nav_dummy").replaceWith('<nav id="menu_list" class="navigation" style="position:absolute;top:25px;right:5px"><ul style="margin-top:10px;margin-left:'+mar+'px;width:160px"><li class="current_page_item"><a href="home.php">Home</a></li><li style="cursor:pointer"><a>Tags</a><ul id="tag_list">'+dy_tags+'</ul></li><li><a style="cursor:pointer" href="publish_question.php">Publish Question</a></li><li><a href="user_questions.php">Questions</a></li><li><a href="user_answers.php">Answers</a></li><li><a href="user_favorite_questions.php">Favorites</a></li><li><a id="" style="cursor:pointer" href="maintenance.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Maintenance"><img src="images/maintenance.png"></a></li><li><a id="logout_tab" style="cursor:pointer" href="finish_session.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Logout"><img src="images/log-out.png"></a></li></ul></nav>');
}else{ 
$("#nav_dummy").replaceWith('<nav id="menu_list" class="navigation"><ul><li class="current_page_item"><a href="home.php">Home</a></li><li style="cursor:pointer"><a>Tags</a><ul id="tag_list">'+dy_tags+'</ul></li><li><a style="cursor:pointer" href="publish_question.php">Publish Question</a></li><li><a href="user_questions.php">Questions</a></li><li><a href="user_answers.php">Answers</a></li><li><a href="user_favorite_questions.php">Favorites</a></li><li><a id="" style="cursor:pointer" href="maintenance.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Maintenance"><img src="images/maintenance.png"></a></li><li><a id="logout_tab" style="cursor:pointer" href="finish_session.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Logout"><img src="images/log-out.png"></a></li></ul></nav>');
}

//SET VALUES OF ELEMENTS
setTimeout(function(){document.getElementById("question-title").value="<?php echo $title;?>"},100);
document.getElementById("tag_select").value="<?php echo $primary_tag;?>";
document.getElementById("question-details").value="<?php echo $details;?>";

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

<!-------------------------------------------   Breadcrums Panel--------------------------------->
<div class="breadcrumbs">
<section class="container">
<div class="row">
<div class="col-md-12">
<h1>Update Question</h1>
</div>
<div class="col-md-12">
<div class="crumbs">
<a href="home.php">Home</a>
<span class="crumbs-span">/</span>
<a>Update Question</a>
</div>
</div>
</div> 
</section> 
</div> 
<section class="container main-content">
<div class="row">
<div class="col-md-9">
<div class="page-content ask-question">
<div class="boxedtitle page-title"><h2>Update Question</h2></div>
<p>Update question's title, details, tags or attachment. </p>
<div class="form-style form-style-3" id="question-submit">
<form action="update_ques.php" method="POST" enctype="multipart/form-data">
<div class="form-inputs clearfix">
<p>
<label class="required">Question Title<span>*</span></label>
<input name="question_title" type="text" id="question-title" value=""></input>
<span class="form-description">Please make appropriate changes, so that your question still solves existing answer.</span>
</p>
<p>
<label class="required">Primary Tag<span>*</span></label>
<span class="styled-select">
<select id="tag_select" name="question_tag" >
</select>
</span>
<span class="form-description" >Change primary tag so that your question can be searched easily.</span>
</p>
<p>
<label class="required">Custom Tags<span></span></label>
<input type="text" class="input" name="question_custom_tags" id="question_tags" data-seperator="," value="<?php echo $custom_tags;?>">
<span class="form-description">Choose suitable Keywords Ex: computer, programming. Use comma (,) to separate two tags.</span>
</p>
<label>Attachment</label>
<?php 
if($attachment=='n'){
	echo '<div class="fileinputs"><input type="file" class="file" accept="image/*" id="file_input1" name="attach_file"><div class="fakefile"><button type="button" id="attach_file1" class="button small margin_0">No file selected</button><span><i class="icon-arrow-up"></i>Browse</span></div><div style="margin-top:5px;float:left;color:#848991;font-size:12px">Select .jpg, .png or .jpeg file of upto 3MB size.</div></div><div id="showAttachment" style="margin-left:136px"></div>';
}else{
	echo '<div id="attachDiv"><span class="question-comment" title="1 Attachment"  style="padding:0px;padding-bottom:40px;padding-top:10px"><a href="attachments/'.$attachment.'" target="_blank" style="cursor:pointer"><i class="icon-paper-clip" ></i> Attachment</a> <a onclick="removeAttachment()"><i class="icon-remove" title="Remove" style="margin-left:20px;cursor:pointer"></i></a></span></div>';
}
?>
<script type="text/javascript">
function removeAttachment(){
$("#attachDiv").replaceWith('<div class="fileinputs"><input type="file" class="file" accept="image/*" id="file_input1" name="attach_file"><div class="fakefile"><button type="button" id="attach_file1" class="button small margin_0">No file selected</button><span><i class="icon-arrow-up"></i>Browse</span></div><div style="margin-top:5px;float:left;color:#848991;font-size:12px">Select .jpg, .png or .jpeg file of upto 3MB size.</div></div><div id="showAttachment" style="margin-left:136px"></div>');
document.getElementById("postAttach").value="n";
$("#file_input1").change(function(){
    readURL(this);
});
}
function remove(){
	document.getElementById("file_input1").value="";
			  document.getElementById("attach_file1").innerHTML="No file selected";
			  document.getElementById("postAttach").value="n";
			 $("#showAttachment").html("");
			 
}

function readURL(input){
    if (input.files && input.files[0]) {
		if(!hasExtension('file_input1', ['.jpg','.png','.jpeg','.JPEG','.JPG'])){
				remove();
			   $("#modal_title").html("IMAGE EXTENSION UNKNOWN");
			   $("#modal_content").html("<strong> Important! </strong>Please upload image of .png, .jpg or .jpeg extensions.");
			   $("#modal_extra").html("Use <a href='http://www.picresize.com' target='_blank'>picresize.com</a> to edit image online.");
			   $("#show_alert").modal();
			   
				
		}else{
		     if(input.files[0].size>3072000){
		      remove();
			 $("#modal_title").html("IMAGE SIZE EXCEEDED");
			 $("#modal_content").html("<strong> Important! </strong>Image size is greater than 3MB.");
			 $("#modal_extra").html("Use <a href='http://www.picresize.com' target='_blank'>picresize.com</a> to resize image online.");
			 $("#show_alert").modal();
			   
		}else{
        document.getElementById("attach_file1").innerHTML=input.files[0].name;
		document.getElementById("postAttach").value=input.files[0].name;
		$("#showAttachment").html('<span class="question-comment" title="1 Attachment"  style="padding:20px;padding-top:5px"><a><i class="icon-paper-clip" ></i> '+input.files[0].name+'</a><a onclick="remove()"><i class="icon-remove" title="Remove" style="margin-left:20px;cursor:pointer"></i></a></span>');
		}
	}
	}
}
function hasExtension(inputID, exts) {
    var fileName = document.getElementById(inputID).value;
    return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
}
$("#file_input1").change(function(){
    readURL(this);
});
</script>

</div>
<div id="form-textarea">
<p>
<label class="required">Details<span>*</span></label>
<textarea name="question_details" id="question-details" aria-required="true" cols="58" rows="8"></textarea>
<span class="form-description">Type the description thoroughly and in detail.</span>
</p>
</div>
<p class="form-submit">
<input type="submit" id="publish-question" value="Update Your Question" class="button color small submit">
</p>
<input type="hidden" name="single_ques_pri_id" value="<?php echo $qid;?>">
<input type="hidden" name="oldAttachment" value="<?php echo $attachment;?>">
<input type="hidden" name="newAttachment" id="postAttach" value="<?php echo $attachment;?>">
</form>
<a type="button" onclick="confirmRemove()" class="button color small submit" style="width:100%;text-align:center;background-color:#a94442;margin-top:20px">Delete This Question</a>
<script>
function confirmRemove(){
			 $("#remove_alert").modal();
}
</script>
</div>
</div> 

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

<div class="widget widget_tag_cloud">
<h3 class="widget_title">Tags</h3>
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
if($i==30){
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

<div id="remove_alert" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" >CONFIRM QUESTION REMOVE</h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"> Question and its data will be removed permanently.</span> 
</div>
      </div>
      <div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal" onclick="location.href='remove_ques.php?token=<?php echo substr($token_qid,1);?>sha256&op=remove'">Remove</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 
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
