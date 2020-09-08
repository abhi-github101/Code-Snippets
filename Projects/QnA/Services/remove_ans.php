<?php
session_start();
if(!isset($_SESSION["auth_uname"])){
?>
<script>location.href="../"</script>
<?php
}else{

include("creds.php");

$ansToken=$_GET["ansToken"];
$qToken=$_GET["qToken"];
if(!isset($_GET["ansToken"])||!isset($_GET["qToken"])){
?>
<script>window.history.back();</script>
<?php
}else if(strpos($ansToken,"sha128")){
$aid="A".substr($ansToken,0,strpos($ansToken,"sha128"));
$qid="Q".substr($qToken,0,strpos($qToken,"sha256"));
$attachment=$_GET["attach"];
$rel_token=substr($qid,1)."sha256";
$op=$_GET["op"];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<script src="js/jquery.js" ></script>
<script src="bootstrap/js/bootstrap.js" ></script>
</head>
<body>
<div id="show_alert" class="modal" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CONFIRM REMOVE ANSWER</h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span><strong> Important! </strong>Are you sure you want to remove the answer. 
</div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="removeAns()">Remove</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="cancel()">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div id="error_alert" class="modal" role="dialog">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="cancel()">Retry</button>
      </div>
    </div>
  </div>
</div>

<div id="remove_success" class="modal" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ANSWER REMOVED</h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-success-sign" aria-hidden="true"></span><strong> HURRAY! </strong>Your answer removed successfully. 
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="location.href='<?php echo "question.php?token=".$rel_token."sha256";?>';">Reload</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
<?php
if($op=="confirm"){
echo '$("#show_alert").modal();';

}else if($op=="remove"){

$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db,$mysql_port);
if($con->connect_error){
echo '$("#error_alert").modal();';
}else{
if(mysqli_query($con,"delete from answer_table where aid='".$aid."';")){
	if($attachment!='n'){
		unlink("attachments/".$attachment);
	}
	
$rs=mysqli_query($con,"select * from answer_table where qid='".$qid."';");
$count=mysqli_num_rows($rs);	
if($count==0){
	mysqli_query($con,"update questions_table set status='i' where qid='".$qid."' ;");
}
mysqli_close($con);
echo '$("#remove_success").modal();';
}else{
echo '$("#error_alert").modal();';
}
}
}
?>
function cancel(){
window.history.back();	
}

function removeAns(){
location.href="<?php echo "remove_ans.php?ansToken=".$ansToken."&qToken=".$qToken."&attach=".$attachment."&op=remove";?>";
}
</script>
</body>
</html>
<?php

}
?>	
