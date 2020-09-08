<?php session_start();
if(!isset($_SESSION["auth_uname"])){
?>
<script>location.href="../"</script>
<?php
}else{
include("creds.php");

$qid=$_POST["single_ques_pri_id"];
$title=$_POST["question_title"];
$custom_tags=$_POST["question_custom_tags"];
$tag=$_POST["question_tag"];
$details=$_POST["question_details"];
$oldAttachment=$_POST["oldAttachment"];
$newAttachment=$_POST["newAttachment"];


if($title==""||$tag==""||$details==""){
echo '<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css" >
<script src="js/jquery.js" ></script>
<script src="bootstrap/js/bootstrap.js" ></script>
</head>
<body onclick="window.history.back();">
<div id="show_alert" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EMPTY FIELDS</h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span><strong> Important! </strong>Required fields are empty. 
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
}else if(!preg_match('/[A-Za-z]/',$title)){
echo '<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<script src="js/jquery.js" ></script>
<script src="bootstrap/js/bootstrap.js" ></script>
</head>
<body onclick="window.history.back();">
<div id="show_alert" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">TITLE NOT OK</h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span><strong> Important! </strong>Your title does not contain any alphabets, please provide a title that can easily be understood by others and keep it short. 
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
}else if(!preg_match('/[A-Za-z]/',$details)){
echo '<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<script src="js/jquery.js" ></script>
<script src="bootstrap/js/bootstrap.js" ></script>
</head>
<body onclick="window.history.back();">
<div id="show_alert" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">QUESTION\'S DETAILS TOO SHORT</h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span><strong> Important! </strong>Your question\'s details does not contain any alphabets, please provide proper question\'s details. 
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
$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
echo '<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css" >
<script src="js/jquery.js" ></script>
<script src="bootstrap/js/bootstrap.js" ></script>
</head>
<body onclick="window.history.back();">
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
}
else{
$custom_tags=mysqli_real_escape_string($con,$custom_tags);
$title=mysqli_real_escape_string($con,$title);
$details=mysqli_real_escape_string($con,$details);
//echo "connection successful";
if($custom_tags!=""){
$custom_tags=strtolower($custom_tags);
$tag_array=explode(",",$custom_tags);//store in array
$unique_tag_array=str_replace($tag,"",$tag_array);//replace primary tag with ""
$unique_custom_tag=array();//form unique custom tag array
$i=0;
foreach($unique_tag_array as $v){
if($v!=""){
$unique_custom_tag[$i]=$v;
$i++;
}
}
$custom_tags=implode(",",$unique_custom_tag);// construct unique custom tag array into custom tag string
}else{
$custom_tags="";
//ucfirst() ucwords()
}

$attachment=$oldAttachment;
if($oldAttachment!='n'&&$oldAttachment!=$newAttachment){
	unlink("attachments/".$oldAttachment);
}

if($newAttachment!='n'&&$oldAttachment!=$newAttachment){
$target_dir = "attachments/";
$target_file = $target_dir . basename($_FILES["attach_file"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if (move_uploaded_file($_FILES["attach_file"]["tmp_name"],$target_dir."attach-q".substr($qid,1).".".$imageFileType)) {
        $attachment= "attach-q".substr($qid,1).".".$imageFileType;
    } else {
        $attachment= 'n';
    }
}
if($newAttachment=='n'){
	$attachment='n';
}

$rs=mysqli_query($con,"update questions_table set title='".$title."', tag='".$tag."', custom_tags='".$custom_tags."', details='".$details."', attachment='".$attachment."', post_date=CONVERT_TZ(UTC_TIMESTAMP(),'+0:00','+5:30') where qid='".$qid."';");
if($rs){
$rel_token=substr($qid,1).'sha256';

mysqli_close($con);
echo '<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css" >
<script src="js/jquery.js" ></script>
<script src="bootstrap/js/bootstrap.js" ></script>
</head>
<body onclick="load_page()">
<div id="show_alert" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">QUESTION UPDATED</h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-success-sign" aria-hidden="true"></span><strong> Awesome! </strong>Your question updated successfully. 
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
function load_page(){
location.href="question.php?token='.$rel_token.'";
}
</script>
</body></html>';
}else{
echo '<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css" >
<script src="js/jquery.js" ></script>
<script src="bootstrap/js/bootstrap.js" ></script>
</head>
<body onclick="window.history.back();">
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
}
}

}
}


?>
