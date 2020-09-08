<?php
session_start();
if(!isset($_SESSION["auth_uname"])){
?>
<script>location.href="../"</script>
<?php
}else{

include("creds.php");

$qid=$_POST["single_ques_pri_id"];
$answer=$_POST["comment"];
$aid=$_POST["aid"];
$format=$_POST["single_ques_pri_format"];
$oldAttachment=$_POST["oldAttachment"];
$newAttachment=$_POST["newAttachment"];

if($answer=="" || !preg_match('/[A-Za-z]/',$answer)){
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
        <h4 class="modal-title">ANSWER NOT SPECIFIED</h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span><strong> Important! </strong>You have not specified any answer, please provide a brief explanation if your answer is too short. 
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
$answer=mysqli_real_escape_string($con,$answer);

$attachment=$oldAttachment;
if($oldAttachment!='n'&&$oldAttachment!=$newAttachment){
	unlink("attachments/".$oldAttachment);
}

if($newAttachment!='n'&&$oldAttachment!=$newAttachment){
$target_dir = "attachments/";
$target_file = $target_dir . basename($_FILES["attach_file"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if (move_uploaded_file($_FILES["attach_file"]["tmp_name"],$target_dir."ans_attach-a".substr($aid,1).".".$imageFileType)) {
        $attachment= "ans_attach-a".substr($aid,1).".".$imageFileType;
    } else {
        $attachment= 'n';
    }
}
if($newAttachment=='n'){
	$attachment='n';
}

if(mysqli_query($con,"update answer_table set answer='".$answer."',format='".$format."',attachment='".$attachment."',post_date=CONVERT_TZ(UTC_TIMESTAMP(),'+0:00','+5:30') where aid='".$aid."';")){
$rel_token=substr($qid,1)."sha256";

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
        <h4 class="modal-title">ANSWER UPDATED</h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-success-sign" aria-hidden="true"></span><strong> AWESOME! </strong>Your answer updated successfully. 
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
mysqli_close($con);
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
