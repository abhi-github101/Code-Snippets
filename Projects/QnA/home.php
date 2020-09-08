<?php
session_start();
if(!isset($_SESSION["auth_uname"])){
?>
<script>location.href="../"</script>
<?php
}else{
$uname=$_SESSION["auth_uname"];
}
$rel_url="";
include($rel_url."creds.php");
include($rel_url."stats.php");
include($rel_url."refine_tags.php");
error_reporting(E_ALL & ~E_NOTICE);

if(isset($_GET["search_text"])){
$search_text=$_GET["search_text"];
$tag=refine_tags(strtolower($search_text));
$tag_arr=explode(" ",$tag);
$cc=0;
foreach($tag_arr as $val){
if($cc==0){
$search_title_AND1="title LIKE '%".$val."%'";
$search_tag1="tag LIKE '%".$val."%'";
$search_custom_tags1="custom_tags LIKE '%".$val."%'";
$search_title_OR1="title LIKE '%".$val."%'";
$cc++;
}else{
$search_title_AND1=$search_title_AND1."AND title LIKE '%".$val."%'";
$search_tag1=$search_tag1." OR tag LIKE '%".$val."%'";
$search_custom_tags1=$search_custom_tags1." OR custom_tags LIKE '%".$val."%'";
$search_title_OR1=$search_title_OR1."OR title LIKE '%".$val."%'";

}
}
}

$fetchRows=15;
if($_GET["more"]=="yes"){

$curr_pag1=$_GET["pag1"];
$curr_pag2=$_GET["pag2"];
$curr_pag3=$_GET["pag3"];
$curr_pag4=$_GET["pag4"];

$start_limit1=($curr_pag1-1)*$fetchRows;
$start_limit2=($curr_pag2-1)*$fetchRows;
$start_limit3=($curr_pag3-1)*$fetchRows;
$start_limit4=($curr_pag4-1)*$fetchRows;

}else{
$curr_pag1=1;
$curr_pag2=1;
$curr_pag3=1;
$curr_pag4=1;

$start_limit1=0;
$start_limit2=0;
$start_limit3=0;
$start_limit4=0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 
<meta charset="utf-8"/>
<title><?php echo $site_title;?></title>
<meta name="description" content="<?php echo $site_desc;?>">
<meta name="keywords" content="QnA,Question,Tag,Custom,Answer,Category,<?php echo get_meta_keywords();?>" />

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<meta name="author" content="abhi@tech">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="<?php echo $rel_url; ?>css/style.css">
<link rel="stylesheet" href="<?php echo $rel_url; ?>style.css">
<link rel="stylesheet" href="<?php echo $rel_url; ?>css/skins.css">
<link rel="stylesheet" href="<?php echo $rel_url; ?>css/responsive.css">
<link rel="shortcut icon" href="<?php echo $rel_url; ?>images/favicon.png">
<script src="<?php echo $rel_url; ?>js/jquery.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.min.js"></script>
<script src="<?php echo $rel_url; ?>static_tags.js"></script>
<script src="<?php echo $rel_url; ?>bootstrap/js/bootstrap.js"></script> 
<link rel="stylesheet" href="<?php echo $rel_url; ?>css/autocomplete.css">
<script src="<?php echo $rel_url; ?>js/autocomplete.js"></script> 
<link rel="stylesheet" href="<?php echo $rel_url; ?>custom_style.css">

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
.none{

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
<script>
</script>
</head>

<body>
<div class="loader"><div class="loader_html"></div></div>
<div id="wrap" class="grid_1200">
<!-------------------------------   Header       -------------------------------------->
<header id="header">
<section class="container clearfix" >
<a  href="">
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
dy_tags+="<li><a href='<?php echo $rel_url; ?>tags.php?tag_filter="+static_tags[i]+"'>"+static_tags[i]+"</a></li>";
}
if($(window).width() <=990 && $(window).width() >=768){
$("#nav_dummy").replaceWith('<nav id="menu_list" class="navigation" style="position:absolute;top:10px;right:5px"><ul style="margin-top:10px;margin-left:-160px;width:160px"><li class="current_page_item"><a href="">Home</a></li><li style="cursor:pointer"><a>Tags</a><ul id="tag_list">'+dy_tags+'</ul></li><li><a style="cursor:pointer" href="publish_question.php">Publish Question</a></li><li><a href="user_questions.php">Questions</a></li><li><a href="user_answers.php">Answers</a></li><li><a href="user_favorite_questions.php">Favorites</a></li><li><a id="" style="cursor:pointer" href="maintenance.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Maintenance"><img src="images/maintenance.png"></a></li><li><a id="logout_tab" style="cursor:pointer" href="finish_session.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Logout"><img src="images/log-out.png"></a></li></ul></nav>');
}else if($(window).width() <768){
var mar=$(window).width();
mar=mar-160;
$("#nav_dummy").replaceWith('<nav id="menu_list" class="navigation" style="position:absolute;top:25px;right:5px"><ul style="margin-top:10px;margin-left:'+mar+'px;width:160px"><li class="current_page_item"><a href="">Home</a></li><li style="cursor:pointer"><a>Tags</a><ul id="tag_list">'+dy_tags+'</ul></li><li><a style="cursor:pointer" href="publish_question.php">Publish Question</a></li><li><a href="user_questions.php">Questions</a></li><li><a href="user_answers.php">Answers</a></li><li><a href="user_favorite_questions.php">Favorites</a></li><li><a id="" style="cursor:pointer" href="maintenance.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Maintenance"><img src="images/maintenance.png"></a></li><li><a id="logout_tab" style="cursor:pointer" href="finish_session.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Logout"><img src="images/log-out.png"></a></li></ul></nav>');
}else{ 
$("#nav_dummy").replaceWith('<nav id="menu_list" class="navigation"><ul><li class="current_page_item"><a href="">Home</a></li><li style="cursor:pointer"><a>Tags</a><ul id="tag_list">'+dy_tags+'</ul></li><li><a style="cursor:pointer" href="publish_question.php">Publish Question</a></li><li><a href="user_questions.php">Questions</a></li><li><a href="user_answers.php">Answers</a></li><li><a href="user_favorite_questions.php">Favorites</a></li><li><a id="" style="cursor:pointer" href="maintenance.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Maintenance"><img src="images/maintenance.png"></a></li><li><a id="logout_tab" style="cursor:pointer" href="finish_session.php" role="button" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Logout"><img src="images/log-out.png"></a></li></ul></nav>');
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
//console.log($(e.target).text());
if(e.target.id!="share_link"&&e.target.id!="share_link_body"&&e.target.id!="share_link_img"&&$(e.target).attr('class')!="popover-title"){
$('[data-toggle="popover"]').popover('hide');
}
});
        
</script>

<!-------------------------------------------          Search Panel    ------------------------------------------>
<div id="search-panel" class="section-warp zapsar">
<div class="container clearfix">
<div class="box_icon box_warp box_no_border box_no_background" box_border="transparent" box_background="transparent" box_color="#FFF">
<div class="site-header__search" style="margin-bottom:60px;">
                    <div class="ht-container">
                        <form id="search_form1" class="hkb-site-search" method="get" action="">
                            <label class="hkb-screen-reader-text" for="hkb-search">Search For</label>
							<input id="hkb-search" class="hkb-site-search__field" data-multiple type="text" style="color:#000;" value="<?php echo $search_text;?>" placeholder="Search here... " name="search_text" autocomplete="off">
                            <button class="hkb-site-search__button" type="submit" title="Search">
							</button>
							<!--<input type="hidden" name="ht-kb-search" value="1"/>
                            <input type="hidden" name="search_enabled" value="true">-->
                        </form>
                    </div>
                </div>

</div> 
</div> 
</div>
<script>
function matchTag(input) {
  var reg = new RegExp(input.split('').join('\\w*').replace(/\W/, ""), 'i');
  return tag.filter(function(tag) {
    if (tag.match(reg)) {
      return tag;
    }
  });
}

function changeInput(val){
	 if(val==""||val==" "){
	 return;
	 }else{
	 var ind=val.lastIndexOf(" ");
	 if(ind!=-1){
     var autoCompleteResult = matchTag(val.substr(ind));
     }else{
	 var autoCompleteResult = matchTag(val);
     }
	 console.log("Input:"+val+"|| Matched:"+autoCompleteResult);
  }
}
</script>
<section class="container main-content" style="z-index:0">
<div class="row">
<div class="col-md-9">
<div class="tabs-warp question-tab">
<ul class="tabs">
<li class="tab"><a class="current">Recent Questions</a></li>
<li class="tab"><a>Most Responses</a></li>
<li class="tab"><a>Recently Answered</a></li>
<li class="tab"><a>No Answers</a></li>
</ul>

<!--            Recent Questions  Tab     -->
<div class="tab-inner-warp">
<div class="tab-inner">

<?php

$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
?>
<script type="text/javascript">
alert("We're having some problem with our servers, Please Reload this page...");
</script>
<?php
}
else{
if(isset($_GET["search_text"])){

$cres=mysqli_query($con,"select count(*) as 'count' from questions_table where (".$search_title_AND1.") ;");
$cdat=mysqli_fetch_array($cres,MYSQLI_ASSOC);
$rowsCount1=$cdat["count"];

$rs=mysqli_query($con,"select qid,title,details,status,views,post_date from questions_table where (".$search_title_AND1.") order by CONVERT(SUBSTR(qid,2),SIGNED INTEGER) desc limit ".$start_limit1.",".$fetchRows.";");

if(mysqli_num_rows($rs)==0){
$cres=mysqli_query($con,"select count(*) as 'count' from questions_table where (".$search_tag1.") OR (".$search_custom_tags1.") ;");
$cdat=mysqli_fetch_array($cres,MYSQLI_ASSOC);
$rowsCount1=$cdat["count"];
$rs=mysqli_query($con,"select qid,title,details,status,views,post_date from questions_table where (".$search_tag1.") OR (".$search_custom_tags1.") order by CONVERT(SUBSTR(qid,2),SIGNED INTEGER) desc limit ".$start_limit1.",".$fetchRows.";");

if(mysqli_num_rows($rs)==0){
$cres=mysqli_query($con,"select count(*) as 'count' from questions_table where (".$search_title_OR1.") ;");
$cdat=mysqli_fetch_array($cres,MYSQLI_ASSOC);
$rowsCount1=$cdat["count"];
$rs=mysqli_query($con,"select qid,title,details,status,views,post_date from questions_table where (".$search_title_OR1.") order by CONVERT(SUBSTR(qid,2),SIGNED INTEGER) desc limit ".$start_limit1.",".$fetchRows.";");
}
}
}else{
$cres=mysqli_query($con,"select count(*) as 'count' from questions_table;");
$cdat=mysqli_fetch_array($cres,MYSQLI_ASSOC);
$rowsCount1=$cdat["count"];

$rs=mysqli_query($con,"select qid,title,details,status,attachment,views,post_date from questions_table order by CONVERT(SUBSTR(qid,2),SIGNED INTEGER) desc limit ".$start_limit1.",".$fetchRows." ;");
}

$recentQuestions=mysqli_num_rows($rs);
if($recentQuestions>0){
$formid=1;
while($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
$title=$data["title"];
$title=htmlentities($title,ENT_QUOTES);
$qid=$data["qid"];
$details=$data["details"];
$details=htmlentities($details,ENT_QUOTES);
$author="abhi";
$status=$data["status"];
$post_date=$data["post_date"];
$views=$data["views"];
$attachment=$data["attachment"];
$rec_token=substr($qid,1).'sha256';
$fav=getFavQuestionStatus($qid);
$res=mysqli_query($con,"select count('".$qid."') as 'count' from answer_table where qid='".$qid."';");
$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
$answers=$result["count"]; 
$picture="avatar.png";

?>
<article class="question question-type-normal">
<a href="<?php echo $rel_url; ?>question.php?token=<?php echo $rec_token;?>"><h2 style="cursor:pointer"><?php if(strlen($title)>60)echo substr($title,0,60)."...";else echo $title;?>
</h2></a>

<div class="question-author">
<a  original-title="<?php echo $author;?>" class="question-author-img tooltip-n"><span></span><img alt="" src="<?php echo $rel_url."images/".$picture;?>"></a>
</div>
<div class="question-inner">
<div class="clearfix"></div>
<p class="question-desc"><?php if(strlen($details)>230) echo substr($details,0,230)."...";else echo $details;?></p>
<div class="question-details">
<?php if($status=='i'){ 
echo '<span class="question-answered"><i class="icon-ok"></i> In Progress</span>';
}else{
echo '<span class="question-answered question-answered-done"><i class="icon-ok"></i> Solved</span>';}
if(substr($attachment,0,8)=="attach-q"){
echo '<span class="question-comment" title="1 Attachment"><a href="attachments/'.$attachment.'" target="_blank" style="cursor:pointer"><i class="icon-paper-clip" ></i> Attachment</a></span>';
}
if($fav=='y'){
echo '<span class="question-favorite" title="Favorite"><i class="icon-star"></i> Favorite</span>';
}else{
echo '<span class="question-favorite" title="Not Favorite" style="color:#2f3239"><i class="icon-star" style="color:#dedede"></i> Not Favorite</span>';
}

?>
</div>
<span class="question-date" title="Question's Post Duration"><i class="icon-time"></i><?php echo getQuesPostTime($post_date);?></span>
<span class="question-comment" style=""><a style="cursor:pointer" href="<?php echo $rel_url; ?>question.php?token=<?php echo $rec_token;?>"><i class="icon-comment"></i><?php echo $answers;?> Answer</a></span>
<span class="question-view" style="margin-right:20px"><i class="icon-user"></i><?php echo $views;?> views</span>
<?php
$share_link=$c_site_address."share_ques.php?token_id=".uniqid(substr($qid,1).'sha256',true);
?>
<span class="question-comment"><a id='share_link' role="button" data-html="true" data-toggle="popover" data-trigger="click" data-placement="bottom" title="Copy Share Link<image id='share_link_img' src='<?php echo $rel_url; ?>images/ic_copy.png' title='copy' style='height:20px;width:20px;float:right;cursor:pointer' onclick='na_copyLink<?php echo $formid;?>()'>" data-content="<div id='share_link_body' style='white-space:nowrap;padding-bottom:15px;overflow-x:auto'><?php echo $share_link;?></div>"><i class="icon-share-alt" ></i>Share</a></span>
<script>
function na_copyLink<?php echo $formid;?>() {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val("<?php echo $share_link;?>").select();
  document.execCommand("copy");
  $temp.remove();
  //$('#share_link<?php echo $formid;?>').trigger('click');
}
</script>

<?php $formid++;?>
<div class="clearfix"></div>
</div>
</article>
<?php
}
mysqli_close($con);

}
}

if($rowsCount1>$recentQuestions){
echo '<div id="pag_div1" class="pagination" style="margin-bottom:20px;">';
for($d=1;$d<=ceil($rowsCount1/$fetchRows);$d++){
if(isset($_GET["search_text"])){
$pag_url="?search_text=".$search_text."&more=yes&pag1=".$d."&pag2=".$curr_pag2."&pag3=".$curr_pag3."&pag4=".$curr_pag4;
}else{
$pag_url="?more=yes&pag1=".$d."&pag2=".$curr_pag2."&pag3=".$curr_pag3."&pag4=".$curr_pag4;
}

if($curr_pag1==$d){
echo '<a href="'.$pag_url.'" style="cursor:pointer;background-color:#ff7361;color:#fff;border-radius:100px">'.$d.'</a>';
}else{
echo '<a href="'.$pag_url.'" style="cursor:pointer;border-radius:100px">'.$d.'</a>';
}
}
echo '</div>'; 

}
?>

</div>
</div>

<!--           Most Responses  Tab  ---------->
<div class="tab-inner-warp">
<div class="tab-inner">

<?php

$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
?>
<script type="text/javascript">
alert("We're having some problem with our servers, Please Reload this page...");
</script>
<?php
}
else{ 
$rs=mysqli_query($con,"select qid,count(qid) as 'count' from answer_table group by qid order by COUNT(qid) DESC, CONVERT(SUBSTR(aid,2),SIGNED INTEGER) DESC;");
if(mysqli_num_rows($rs)>0){
$qid_arr=array();
$count_arr=array();
$i=0;
while($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
$qid_arr[$i]=$data["qid"];
$count_arr[$i]=$data["count"];
$i++;
}

if(isset($_GET["search_text"])){
//if searching is enabled, create a new array that only contains qids that satisfy the search otherwise use all qids
$new_qid_arr=array();
$new_count_arr=array();

for($i=0,$ind=0;$i<count($qid_arr);$i++){

$resource=mysqli_query($con,"select sno from questions_table where qid='".$qid_arr[$i]."' and (".$search_title_AND1.")");

if(mysqli_num_rows($resource)==0){
$resource=mysqli_query($con,"select sno from questions_table where qid='".$qid_arr[$i]."' and ((".$search_tag1.") OR (".$search_custom_tags1."));");

if(mysqli_num_rows($resource)==0){
	$resource=mysqli_query($con,"select sno from questions_table where qid='".$qid_arr[$i]."' and (".$search_title_OR1.");");
	if(mysqli_num_rows($resource)>0){
		$new_qid_arr[$ind]=$qid_arr[$i];
		$new_count_arr[$ind]=$count_arr[$i];
		$ind++;
		}
}else{
$new_qid_arr[$ind]=$qid_arr[$i];
$new_count_arr[$ind]=$count_arr[$i];
$ind++;
}
}else{
$new_qid_arr[$ind]=$qid_arr[$i];
$new_count_arr[$ind]=$count_arr[$i];
$ind++;
}
}
$rowsCount2=count($new_qid_arr);
}else{
$rowsCount2=count($qid_arr);
}
$formid=1;

for($l=$start_limit2,$mostResponses=0;$l<($start_limit2+$fetchRows)&&$l<$rowsCount2;$l++,$mostResponses++){

if(isset($_GET["search_text"])){
$mr_qid=$new_qid_arr[$l];
$mr_count=$new_count_arr[$l];
}else{
$mr_qid=$qid_arr[$l];
$mr_count=$count_arr[$l];
}

$resource=mysqli_query($con,"select qid,title,details,status,attachment,views,post_date from questions_table where qid='".$mr_qid."';");

if(mysqli_num_rows($resource)>0){
$answers=$mr_count;

$result=mysqli_fetch_array($resource,MYSQLI_ASSOC);
$title=$result["title"];
$title=htmlentities($title,ENT_QUOTES);
$qid=$result["qid"];
$details=$result["details"];
$details=htmlentities($details,ENT_QUOTES);
$author="abhi";
$status=$result["status"];
$post_date=$result["post_date"];
$views=$result["views"];
$attachment=$result["attachment"];
$picture="avatar.png";
$mos_token=substr($qid,1).'sha256';
$fav=getFavQuestionStatus($qid);
 ?>
<article class="question question-type-normal">
<a href="<?php echo $rel_url; ?>question.php?token=<?php echo $mos_token;?>"><h2 style="cursor:pointer" ><?php if(strlen($title)>60)echo substr($title,0,60)."...";else echo $title;?>
</h2></a>
<div class="question-author">
<a  original-title="<?php echo $author;?>" class="question-author-img tooltip-n"><span></span>
<img alt="" src="<?php echo $rel_url."images/".$picture;?>
"></a>
</div>
<div class="question-inner">
<div class="clearfix"></div>
<p class="question-desc"><?php if(strlen($details)>230)echo substr($details,0,230)."...";else echo $details;?></p>
<div class="question-details">
<?php if($status=='i'){ 
echo '<span class="question-answered"><i class="icon-ok"></i> In Progress</span>';
}else{
echo '<span class="question-answered question-answered-done"><i class="icon-ok"></i> Solved</span>';}
if(substr($attachment,0,8)=="attach-q"){
echo '<span class="question-comment" title="1 Attachment"><a href="attachments/'.$attachment.'" target="_blank" style="cursor:pointer"><i class="icon-paper-clip" ></i> Attachment</a></span>';
}
if($fav=='y'){
echo '<span class="question-favorite" title="Favorite"><i class="icon-star"></i> Favorite</span>';
}else{
echo '<span class="question-favorite" title="Not Favorite" style="color:#2f3239"><i class="icon-star" style="color:#dedede"></i> Not Favorite</span>';
}

?>

</div>
<span class="question-date" title="Question's Post Duration"><i class="icon-time"></i><?php echo getQuesPostTime($post_date);?></span>
<span class="question-comment"><a style="cursor:pointer" href="<?php echo $rel_url; ?>question.php?token=<?php echo $mos_token;?>"><i class="icon-comment"></i><?php echo $answers;?> Answer</a></span>
<span class="question-view" style="margin-right:20px"><i class="icon-user"></i><?php echo $views;?> views</span>
<?php
$share_link=$c_site_address."share_ques.php?token_id=".uniqid(substr($qid,1).'sha256',true);
?>
<span class="question-comment"><a id='share_link' role="button" data-html="true" data-toggle="popover" data-trigger="click" data-placement="bottom" title="Copy Share Link<image id='share_link_img' src='<?php echo $rel_url; ?>images/ic_copy.png' title='copy' style='height:20px;width:20px;float:right;cursor:pointer' onclick='mr_copyLink<?php echo $formid;?>()'>" data-content="<div id='share_link_body' style='white-space:nowrap;padding-bottom:15px;overflow-x:auto'><?php echo $share_link;?></div>"><i class="icon-share-alt" ></i>Share</a></span>
<script>
function mr_copyLink<?php echo $formid;?>() {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val("<?php echo $share_link;?>").select();
  document.execCommand("copy");
  $temp.remove();
  //$('#share_link<?php echo $formid;?>').trigger('click');
}
</script>
<?php $formid++;?>

<div class="clearfix"></div>
</div>
</article>

<?php
}
}
}else{
$rowsCount2=0;
$mostResponses=0;
}
mysqli_close($con);
}
if($rowsCount2>$mostResponses){
echo '<div id="pag_div2" class="pagination" style="margin-bottom:20px">';
for($d=1;$d<=ceil($rowsCount2/$fetchRows);$d++){
if(isset($_GET["search_text"])){
$pag_url="?search_text=".$search_text."&more=yes&pag1=".$curr_pag1."&pag2=".$d."&pag3=".$curr_pag3."&pag4=".$curr_pag4;
}else{
$pag_url="?more=yes&pag1=".$curr_pag1."&pag2=".$d."&pag3=".$curr_pag3."&pag4=".$curr_pag4;
}

if($curr_pag2==$d){
echo '<a href="'.$pag_url.'" style="cursor:pointer;background-color:#ff7361;color:#fff;border-radius:100px">'.$d.'</a>';
}else{
echo '<a href="'.$pag_url.'" style="cursor:pointer;border-radius:100px">'.$d.'</a>';
}
}
echo '</div>'; 
}
?>
</div>
</div>

<!--           Recently  Answered  Tab   --------------->
<div class="tab-inner-warp">
<div class="tab-inner">

<?php

$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
?>
<script type="text/javascript">
alert("We're having some problem with our servers, Please Reload this page...");
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

if(isset($_GET["search_text"])){
//if searching is enabled, create a new array that only contains qids that satisfy the search otherwise use all qids
$new_arr=array();
$i=0;
foreach($unique_qid as $v){

$resource=mysqli_query($con,"select sno from questions_table where qid='".$v."' and (".$search_title_AND1.")");

if(mysqli_num_rows($resource)==0){
$resource=mysqli_query($con,"select sno from questions_table where qid='".$v."' and ((".$search_tag1.") OR (".$search_custom_tags1."));");

if(mysqli_num_rows($resource)==0){
	$resource=mysqli_query($con,"select sno from questions_table where qid='".$v."' and (".$search_title_OR1.");");
	if(mysqli_num_rows($resource)>0){
		$new_arr[$i]=$v;
		$i++;
		}
}else{
$new_arr[$i]=$v;
$i++;
}
}else{
$new_arr[$i]=$v;
$i++;
}
}
$rowsCount3=count($new_arr);
}else{
$rowsCount3=$len;
$new_arr=array();
$i=0;
foreach($unique_qid as $v){
$new_arr[$i]=$v;
$i++;
}
}
$formid=1;

for($l=$start_limit3,$recentAnswers=0;$l<($start_limit3+$fetchRows)&&$l<$rowsCount3;$l++,$recentAnswers++){
$val=$new_arr[$l];
$resource=mysqli_query($con,"select qid,title,details,status,attachment,views,post_date from questions_table where qid='".$val."';");

if(mysqli_num_rows($resource)>0){
$result=mysqli_fetch_array($resource,MYSQLI_ASSOC);
$title=$result["title"];
$title=htmlentities($title,ENT_QUOTES);
$qid=$result["qid"];
$details=$result["details"];
$details=htmlentities($details,ENT_QUOTES);
$author="abhi";
$status=$result["status"];
$post_date=$result["post_date"];
$views=$result["views"];
$attachment=$result["attachment"];
$fav=getFavQuestionStatus($qid);
$res=mysqli_query($con,"select count('".$qid."') as 'count' from answer_table where qid='".$qid."';");
$result1=mysqli_fetch_array($res,MYSQLI_ASSOC);
$answers=$result1["count"];

$picture="avatar.png";
$ans_token=substr($qid,1).'sha256';

 ?>
<article class="question question-type-normal">
<a href="<?php echo $rel_url; ?>question.php?token=<?php echo $ans_token;?>"><h2 style="cursor:pointer" ><?php if(strlen($title)>60)echo substr($title,0,60)."...";else echo $title;?>
</h2></a>
<div class="question-author">
<a  original-title="<?php echo $author;?>" class="question-author-img tooltip-n"><span></span>
<img alt="" src="<?php echo $rel_url."images/".$picture;?>
"></a>
</div>
<div class="question-inner">
<div class="clearfix"></div>
<p class="question-desc"><?php if(strlen($details)>230)echo substr($details,0,230)."...";else echo $details;?></p>
<div class="question-details">
<?php if($status=='i'){ 
echo '<span class="question-answered"><i class="icon-ok"></i> In Progress</span>';
}else{
echo '<span class="question-answered question-answered-done"><i class="icon-ok"></i> Solved</span>';}
if(substr($attachment,0,8)=="attach-q"){
echo '<span class="question-comment" title="1 Attachment"><a href="attachments/'.$attachment.'" target="_blank" style="cursor:pointer"><i class="icon-paper-clip" ></i> Attachment</a></span>';
}
if($fav=='y'){
echo '<span class="question-favorite" title="Favorite"><i class="icon-star"></i> Favorite</span>';
}else{
echo '<span class="question-favorite" title="Not Favorite" style="color:#2f3239"><i class="icon-star" style="color:#dedede"></i> Not Favorite</span>';
}

?>

</div>
<span class="question-date" title="Question's Post Duration"><i class="icon-time"></i><?php echo getQuesPostTime($post_date);?></span>
<span class="question-comment"><a style="cursor:pointer" href="<?php echo $rel_url; ?>question.php?token=<?php echo $ans_token;?>"><i class="icon-comment"></i><?php echo $answers;?> Answer</a></span>
<span class="question-view" style="margin-right:20px"><i class="icon-user"></i><?php echo $views;?> views</span>
<?php
$share_link=$c_site_address."share_ques.php?token_id=".uniqid(substr($qid,1).'sha256',true);
?>
<span class="question-comment"><a id='share_link' role="button" data-html="true" data-toggle="popover" data-trigger="click" data-placement="bottom" title="Copy Share Link<image id='share_link_img' src='<?php echo $rel_url; ?>images/ic_copy.png' title='copy' style='height:20px;width:20px;float:right;cursor:pointer' onclick='ra_copyLink<?php echo $formid;?>()'>" data-content="<div id='share_link_body' style='white-space:nowrap;padding-bottom:15px;overflow-x:auto'><?php echo $share_link;?></div>"><i class="icon-share-alt" ></i>Share</a></span>
<script>
function ra_copyLink<?php echo $formid;?>() {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val("<?php echo $share_link;?>").select();
  document.execCommand("copy");
  $temp.remove();
  //$('#share_link<?php echo $formid;?>').trigger('click');
}
</script>
<?php $formid++;?>

<div class="clearfix"></div>
</div>
</article>

<?php
}
}
}else{
$rowsCount3=0;
$recentAnswers=0;
}
mysqli_close($con);
}

if($rowsCount3>$recentAnswers){
echo '<div id="pag_div3" class="pagination" style="margin-bottom:20px">';
for($d=1;$d<=ceil($rowsCount3/$fetchRows);$d++){
if(isset($_GET["search_text"])){
$pag_url="?search_text=".$search_text."&more=yes&pag1=".$curr_pag1."&pag2=".$curr_pag2."&pag3=".$d."&pag4=".$curr_pag4;
}else{
$pag_url="?more=yes&pag1=".$curr_pag1."&pag2=".$curr_pag2."&pag3=".$d."&pag4=".$curr_pag4;
}

if($curr_pag3==$d){
echo '<a href="'.$pag_url.'" style="cursor:pointer;background-color:#ff7361;color:#fff;border-radius:100px">'.$d.'</a>';
}else{
echo '<a href="'.$pag_url.'" style="cursor:pointer;border-radius:100px">'.$d.'</a>';
}
}
echo '</div>'; 
}
?>

</div>
</div>
<!--            No Answers Tab --------------->
<div class="tab-inner-warp">
<div class="tab-inner">

<?php

$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
?>
<script type="text/javascript">
alert("We're having some problem with our servers, Please Reload this page...");
</script>
<?php
}
else{
if(isset($_GET["search_text"])){

$cres=mysqli_query($con,"select count(*) as 'count' from questions_table where status='i' and (".$search_title_AND1.");");
$cdat=mysqli_fetch_array($cres,MYSQLI_ASSOC);
$rowsCount4=$cdat["count"];
$rs=mysqli_query($con,"select qid,title,details,status,views,post_date from questions_table where status='i' and (".$search_title_AND1.") order by CONVERT(SUBSTR(qid,2),SIGNED INTEGER) desc limit ".$start_limit4.",".$fetchRows."");

if(mysqli_num_rows($rs)==0){
$cres=mysqli_query($con,"select count(*) as 'count' from questions_table where status='i' and ((".$search_tag1.") OR (".$search_custom_tags1."));");
$cdat=mysqli_fetch_array($cres,MYSQLI_ASSOC);
$rowsCount4=$cdat["count"];
$rs=mysqli_query($con,"select qid,title,details,status,views,post_date from questions_table where status='i' and ((".$search_tag1.") OR (".$search_custom_tags1.")) order by CONVERT(SUBSTR(qid,2),SIGNED INTEGER) desc limit ".$start_limit4.",".$fetchRows.";");

if(mysqli_num_rows($rs)==0){
$cres=mysqli_query($con,"select count(*) as 'count' from questions_table where status='i' and (".$search_title_OR1.");");
$cdat=mysqli_fetch_array($cres,MYSQLI_ASSOC);
$rowsCount4=$cdat["count"];
$rs=mysqli_query($con,"select qid,title,details,status,views,post_date from questions_table where status='i' and (".$search_title_OR1.") order by CONVERT(SUBSTR(qid,2),SIGNED INTEGER) desc limit ".$start_limit4.",".$fetchRows.";");
}
}
}else{
$cres=mysqli_query($con,"select count(*) as 'count' from questions_table where status='i';");
$cdat=mysqli_fetch_array($cres,MYSQLI_ASSOC);
$rowsCount4=$cdat["count"];

$rs=mysqli_query($con,"select qid,title,details,status,attachment,views,post_date from questions_table where status='i' order by CONVERT(SUBSTR(qid,2),SIGNED INTEGER) desc limit ".$start_limit4.",".$fetchRows.";");
}
$noAnswers=mysqli_num_rows($rs);
if($noAnswers>0){
$formid=1;

while($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
$title=$data["title"];
$title=htmlentities($title,ENT_QUOTES);
$qid=$data["qid"];
$details=$data["details"];
$details=htmlentities($details,ENT_QUOTES);
$author="abhi";
$status=$data["status"];
$post_date=$data["post_date"];
$views=$data["views"];
$attachment=$data["attachment"];
$fav=getFavQuestionStatus($qid);
$res=mysqli_query($con,"select count('".$qid."') as 'count' from answer_table where qid='".$qid."';");
$result=mysqli_fetch_array($res,MYSQLI_ASSOC);
$answers=$result["count"];

$picture="avatar.png";
$no_token=substr($qid,1).'sha256';

 ?>
<article class="question question-type-normal">
<a href="<?php echo $rel_url; ?>question.php?token=<?php echo $no_token;?>"><h2 style="cursor:pointer" ><?php if(strlen($title)>60)echo substr($title,0,60)."...";else echo $title;?>
</h2></a>
<div class="question-author">
<a  original-title="<?php echo $author;?>" class="question-author-img tooltip-n"><span></span><img alt="" src="<?php echo $rel_url."images/".$picture;?>"></a>
</div>
<div class="question-inner">
<div class="clearfix"></div>
<p class="question-desc"><?php if(strlen($details)>230)echo substr($details,0,230)."...";else echo $details;?></p>
<div class="question-details">
<?php if($status=='i'){ 
echo '<span class="question-answered"><i class="icon-ok"></i> In Progress</span>';
}else{
echo '<span class="question-answered question-answered-done"><i class="icon-ok"></i> Solved</span>';}
if(substr($attachment,0,8)=="attach-q"){
echo '<span class="question-comment" title="1 Attachment"><a href="attachments/'.$attachment.'" target="_blank" style="cursor:pointer"><i class="icon-paper-clip" ></i> Attachment</a></span>';
}
if($fav=='y'){
echo '<span class="question-favorite" title="Favorite"><i class="icon-star"></i> Favorite</span>';
}else{
echo '<span class="question-favorite" title="Not Favorite" style="color:#2f3239"><i class="icon-star" style="color:#dedede"></i> Not Favorite</span>';
}

?>

</div>
<span class="question-date" title="Question's Post Duration"><i class="icon-time"></i><?php echo getQuesPostTime($post_date);?></span>
<span class="question-comment"><a style="cursor:pointer" href="<?php echo $rel_url; ?>question.php?token=<?php echo $no_token;?>"><i class="icon-comment"></i><?php echo $answers;?> Answer</a></span>
<span class="question-view" style="margin-right:20px"><i class="icon-user"></i><?php echo $views;?> views</span>
<?php
$share_link=$c_site_address."share_ques.php?token_id=".uniqid(substr($qid,1).'sha256',true);
?>
<span class="question-comment"><a id='share_link' role="button" data-html="true" data-toggle="popover" data-trigger="click" data-placement="bottom" title="Copy Share Link<image id='share_link_img' src='<?php echo $rel_url; ?>images/ic_copy.png' title='copy' style='height:20px;width:20px;float:right;cursor:pointer' onclick='na_copyLink<?php echo $formid;?>()'>" data-content="<div id='share_link_body' style='white-space:nowrap;padding-bottom:15px;overflow-x:auto'><?php echo $share_link;?></div>"><i class="icon-share-alt" ></i>Share</a></span>
<script>
function na_copyLink<?php echo $formid;?>() {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val("<?php echo $share_link;?>").select();
  document.execCommand("copy");
  $temp.remove();
  //$('#share_link<?php echo $formid;?>').trigger('click');
}
</script>
<?php $formid++;?>

<div class="clearfix"></div>
</div>
</article>

<?php
}
}
mysqli_close($con);
}
if($rowsCount4>$noAnswers){
echo '<div id="pag_div4" class="pagination" style="margin-bottom:20px">';
for($d=1;$d<=ceil($rowsCount4/$fetchRows);$d++){
if(isset($_GET["search_text"])){
$pag_url="?search_text=".$search_text."&more=yes&pag1=".$curr_pag1."&pag2=".$curr_pag2."&pag3=".$curr_pag3."&pag4=".$d;
}else{
$pag_url="?more=yes&pag1=".$curr_pag1."&pag2=".$curr_pag2."&pag3=".$curr_pag3."&pag4=".$d;
}

if($curr_pag4==$d){
echo '<a href="'.$pag_url.'" style="cursor:pointer;background-color:#ff7361;color:#fff;border-radius:100px">'.$d.'</a>';
}else{
echo '<a href="'.$pag_url.'" style="cursor:pointer;border-radius:100px">'.$d.'</a>';
}
}
echo '</div>'; 
}

?>
<?php
if($recentQuestions==0&&$mostResponses==0&&$recentAnswers==0&&$noAnswers==0){
?>
<script type="text/javascript">
if(confirm("SORRY, nothing found.\nPublish this Question and save its Answer for later purpose.")==true){
//setTimeout(function(){$("#login-panel").trigger('click');},500);
$(document).ready(function (){setTimeout(function(){$("#login-panel").trigger('click');},1500);});
}
</script>
<?php
}
?>
</div>
</div>
<div style="padding:10px"></div>
<div style="padding:15px"></div>
</div> 

<?php if(preg_match('/[A-Za-z]/',$search_text)||preg_match('/[0-9]/',$search_text)){
echo'
<!--<hr style="border-color:#ff7361;margin-top:20px;margin-bottom:50px">-->
<div class="" >
<div class="tab-inner">
<article class="question question-type-normal">
<h2>Found what you\'re looking for?</h2>
<div class="question-author">
<a original-title="Help" class="question-author-img tooltip-n"><span></span><img alt="" src="'.$rel_url.'images/ic_help.png"></a>
</div>
<div class="question-inner" align="center">
<div class="clearfix"></div>
<p class="question-desc" align="left">If you didn\'t find your question, login to publish your question.</p>
<button style="background-color:#ff7361;color:#fff" onclick="$(\'#side-login\').trigger(\'click\')">Publish Question</button>
</div></article></div></div>';
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
echo '<a href="'.$rel_url.'tags.php?tag_filter='.$val.'" style="cursor:pointer">'.$val.'</a>';
}
$i++;
}

//populating datalist form autocomplete
$rs=mysqli_query($con,"select distinct(tag) as 'tag' from questions_table order by tag;");
$datalist="[";
$i=0;
while($data=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
if($i==0){
$datalist.='"'.$data['tag'].'"';
$i++;
}else{
$datalist.=',"'.$data['tag'].'"';
}
}
foreach($unique_tags as $val){
if($val!=""){
$datalist.= ',"'.$val.'"';
}
}
$datalist.="];";
?>
<script type="text/javascript">

tagdata=<?php echo $datalist;?>
var input = document.getElementById("hkb-search");
var awesomplete = new Awesomplete('input[data-multiple]', {
	filter: function(text, input) {
		return Awesomplete.FILTER_CONTAINS(text, input.match(/[^ ]*$/)[0]);
	},

	item: function(text, input) {
		return Awesomplete.ITEM(text, input.match(/[^ ]*$/)[0]);
	},

	replace: function(text) {
		var before = this.input.value.match(/^.+ \s*|/)[0];
		this.input.value = before + text;
	}
});
awesomplete.list=tagdata;
</script>
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

<script src="<?php echo $rel_url; ?>js/tabs.js"></script>
<script src="<?php echo $rel_url; ?>js/custom.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.easing.1.3.min.js"></script>
<script src="<?php echo $rel_url; ?>js/html5.js"></script>
<script src="<?php echo $rel_url; ?>js/twitter/jquery.tweet.js"></script>
<script src="<?php echo $rel_url; ?>js/jflickrfeed.min.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.inview.min.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.tipsy.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.flexslider.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.prettyPhoto.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.scrollTo.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.nav.js"></script>
<script src="<?php echo $rel_url; ?>js/tags.js"></script>
<script src="<?php echo $rel_url; ?>js/jquery.bxslider.min.js"></script>
<script>
$(function(){$('[data-toggle="popover"]').popover()})
</script>

</body>
</html>
