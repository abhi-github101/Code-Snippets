<?php
include("creds.php");
error_reporting(E_ALL & ~E_NOTICE);

$uname=$_POST["uname"];
$pswd=$_POST["pswd"];
if($uname=="Username"||$pswd=="Password"){
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
<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span><strong> Important! </strong>Username or Password Field are empty. 
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
$uname=strtolower($uname);
$uname=mysqli_real_escape_string($con,$uname);

$rs=mysqli_query($con,"select AES_DECRYPT(pswd,'".$mysql_key."') as 'pswd' from user_creds where username=AES_ENCRYPT('".$uname."','".$mysql_key."');");
if(mysqli_num_rows($rs)>0){
$data=mysqli_fetch_array($rs,MYSQLI_ASSOC);
if($data["pswd"]==$pswd){

$picture="avatar.png";

session_start();
$_SESSION["auth_uname"]=$uname;
$_SESSION["user_photo"]=$picture;

mysqli_close($con);

?>
<script type="text/javascript">
location.href="home.php";
</script>
<?php
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
        <h4 class="modal-title">PASSWORD INCORRECT</h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-warning alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span><strong> Important! </strong>Password is incorrect. Please try again... 
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
</body></html>';}
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
        <h4 class="modal-title">USERNAME NOT EXISTS</h4>
      </div>
      <div class="modal-body">
	 <div class="alert alert-warning alert-dismissible fade in" role="alert" style="margin-top:0px">
<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span><strong> Oh! </strong>Username does not exists, if you do not have any account, create and than login.
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
</body></html>';}
}
}
?>
